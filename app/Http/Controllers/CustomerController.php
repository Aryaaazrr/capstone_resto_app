<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        $id_customer = Auth::id();
        $subcategory = Subcategory::all();
        $product = Product::with('subcategory')->get();
        return view(
            'pages.home.index',
            [
                'id_customer' => $id_customer,
                'subcategory' => $subcategory,
                'product' => $product
            ]
        );
    }

    public function create()
    {
        $subcategory = Subcategory::where('name', 'Menu Paket Reservasi')->first();
        $products = Product::where('id_subcategory', $subcategory->id_subcategory)
            ->with('subcategory')
            ->get();

        $products->each(function ($product) {
            if (stripos($product->description, 'ijen') !== false) {
                $product->packageType = 'Paket Ijen';
            } elseif (stripos($product->description, 'kembulan') !== false) {
                $product->packageType = 'Paket Kembulan';
            } else {
                $product->packageType = 'Paket tidak diketahui';
            }
        });

        return view('pages.home.reservation', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|min:9',
            'date' => 'required|date',
            'time' => 'required',
            'people' => 'required|integer|min:1',
            'paket_*' => 'sometimes|required|integer',
            'qty_*' => 'sometimes|required|integer|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();


        try {
            $cekRiwayat = Transaction::with('id_user', Auth::id())->where('status_payment', 'pending')->count();

            if ($cekRiwayat > 0) {
                throw new Exception("Terjadi Kesalahan, Anda memiliki pesanan yang belum dibayar");
            }

            $grandTotal = $this->calculateTotal($request->all());
            $receipt = 'TR-' . strtoupper(Str::random(8)) . '-' . date('dmY');

            $transaction = new Transaction();
            $transaction->id_user = Auth::id();
            $transaction->no_receipt = $receipt;
            $transaction->grand_total = $grandTotal;
            $transaction->no_telp = $request->phone;
            $transaction->reservation_date = $request->date;
            $transaction->reservation_time = $request->time;
            $transaction->reservation_people = $request->people;
            $transaction->reservation_message = $request->message;

            if ($transaction->save()) {
                foreach ($request->all() as $key => $value) {
                    if (Str::startsWith($key, 'qty_') && !is_null($value) && $value > 0) {
                        $productId = substr($key, 4);
                        $product = Product::find($productId);
                        if ($product) {
                            $detail_transaction = new TransactionDetails();
                            $detail_transaction->id_transaction = $transaction->id_transaction;
                            $detail_transaction->id_product = $productId;
                            $detail_transaction->quantity = $value;
                            $detail_transaction->price = $product->price;
                            $detail_transaction->total = $product->price * $value;
                            if (!$detail_transaction->save()) {
                                throw new Exception("Terjadi Kesalahan, Gagal mendaftar reservasi");
                            }
                        } else {
                            throw new Exception("Terjadi Kesalahan, Product tidak ditemukan");
                        }
                    }
                }
            } else {
                throw new Exception("Terjadi Kesalahan, Gagal membuat reservasi");
            }

            DB::commit();

            return view('pages.home.order');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Request $request)
    {
        $transaction = Transaction::where('id_user', Auth::id())->with('user')->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($transaction as $row) {
                $rowData[] = [
                    'id_transaction' => $row->id_transaction,
                    'no_receipt' => $row->no_receipt,
                    'grand_total' => $row->grand_total,
                    'reservation_date' => $row->reservation_date,
                    'reservation_time' => $row->reservation_time,
                    'reservation_people' => $row->reservation_people,
                    'status_transaction' => $row->status_transaction,
                    'status_payment' => $row->status_payment,
                    'token_payment' => $row->token_payment,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.home.order');
    }


    public function calculateTotal(array $items)
    {
        $total = 0;

        foreach ($items as $key => $value) {
            if (str_contains($key, 'paket_') && $value) {
                $productId = str_replace('paket_', '', $key);
                $qty = $items['qty_' . $productId] ?? 0;
                $product = Product::find($productId);
                if ($product) {
                    $total += $product->price * $qty;
                }
            }
        }

        return $total;
    }

    public function getSnapToken($transaction)
    {
        try {
            $transaction = Transaction::find($transaction);

            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->no_receipt,
                    'gross_amount' => $transaction->grand_total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => $transaction->no_telp,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction->token_payment = $snapToken;
            $transaction->save();

            return $snapToken;
        } catch (\Exception $e) {
            throw new Exception("Error getting Snap token: " . $e->getMessage());
        }
    }

    // public function getSnapToken(Request $request)
    // {
    //     Log::info('Request received', $request->all());

    //     $request->validate([
    //         'id_transaction' => 'required|exists:transactions,id_transaction',
    //     ]);

    //     $transaction = Transaction::find($request->id_transaction);

    //     if (!$transaction) {
    //         Log::error('Transaction not found', ['id_transaction' => $request->id_transaction]);
    //         return response()->json(['error' => 'Transaction not found'], 404);
    //     }

    //     Log::info('Transaction found', ['transaction' => $transaction]);

    //     return response()->json(['snap_token' => $transaction->token_payment]);
    // }
}
