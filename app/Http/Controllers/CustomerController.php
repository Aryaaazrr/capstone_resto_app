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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CustomerController extends Controller
{
    public function index()
    {
        $id_customer = Auth::id();
        if ($id_customer) {
            return view('pages.home.index', ['id_customer' => $id_customer]);
        }
        return view('pages.home.index');
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
        dd($request->all());
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
            $grandTotal = $this->calculateTotal($request->all());
            $receipt = 'TR-' . strtoupper(Str::random(8)) . '-' . time();

            $transaction = new Transaction();
            $transaction->no_receipt = $receipt;
            $transaction->grand_total = $grandTotal;

            if ($transaction->save()) {
                foreach ($request->all() as $key => $value) {
                    if (str_contains($key, 'paket_') && $value) {
                        $productId = str_replace('paket_', '', $key);
                        $qty = $request->input('qty_' . $productId);
                        $product = Product::find($productId);
                        if ($product) {
                            $detail_transaction = new TransactionDetails();
                            $detail_transaction->id_transaction = $transaction->id_transaction;
                            $detail_transaction->id_product = $productId;
                            $detail_transaction->quantity = $qty;
                            $detail_transaction->price = $product->price;
                            $detail_transaction->total = $product->price * $qty;
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

            // Konfigurasi Midtrans
            // Config::$serverKey = config('midtrans.server_key');
            // Config::$isProduction = config('midtrans.is_production');
            // Config::$isSanitized = config('midtrans.is_sanitized');
            // Config::$is3ds = config('midtrans.is_3ds');

            // $params = [
            //     'transaction_details' => [
            //         'order_id' => $transaction->no_receipt,
            //         'gross_amount' => $grandTotal,
            //     ],
            //     'customer_details' => [
            //         'first_name' => Auth::user()->username,
            //     ],
            // ];

            // Dapatkan token transaksi Midtrans
            $snapToken = $this->getSnapToken();
            // $transaction->token_payment = $snapToken;
            // $transaction->save();

            DB::commit();

            return view('pages.home.payment', compact('snapToken'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Customer',
                'last_name' => '1',
                'email' => 'customer@gmail.com',
                'phone' => '088876563565',
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
