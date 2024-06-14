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
use Illuminate\Support\Facades\Http;
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

    public function getSnapToken(Request $request)
    {
        $request->validate([
            'id_transaction' => 'required|exists:tbl_transactions,id_transaction'
        ]);

        $transaction = Transaction::where('id_transaction', $request->id_transaction)->with(['transaction_details', 'user'])->first();
        $details = TransactionDetails::where('id_transaction', $request->id_transaction)->with('product')->get();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        $items = $details->map(function ($detail) {
            return [
                'id' => $detail->product->id_product,
                'price' => $detail->product->price,
                'quantity' => $detail->quantity,
                'name' => $detail->product->name,
            ];
        })->toArray();

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id_transaction,
                'gross_amount' => $transaction->grand_total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
                'phone' => $transaction->no_telp,
            ],
        ];

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY') . ':');

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth",
            ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

            $response = json_decode($response->body());

            if (isset($response->token)) {
                $transaction->token_payment = $response->token;
                $transaction->link_payment = $response->redirect_url;
                $transaction->save();

                return response()->json(['snap_token' => $response->token, 'redirect_url' => $response->redirect_url]);
            } else {
                return response()->json(['error' => 'Error generating Snap token'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        try {
            $payload = $request->json()->all();

            if (!isset($payload['order_id'])) {
                return response()->json(['error' => 'Invalid payload: order_id is missing'], 400);
            }

            $transactionId = $payload['order_id'];

            $transaction = Transaction::where('id_transaction', $transactionId)->first();

            if (!$transaction) {
                return response()->json(['error' => 'Transaction not found'], 404);
            }

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY') . ':');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth",
            ])->get("https://api.sandbox.midtrans.com/v2/$transactionId/status");

            $response = json_decode($response->body());

            if ($transaction->status_payment === 'settlement' || $transaction->status_payment === 'capture') {
                return response()->json('Payment has been already processed');
            }

            switch ($response->transaction_status) {
                case 'capture':
                case 'settlement':
                    $transaction->status_payment = 'Settlement';
                    break;
                case 'pending':
                    $transaction->status_payment = 'Pending';
                    break;
                case 'deny':
                    $transaction->status_payment = 'Deny';
                    break;
                case 'expire':
                    $transaction->status_payment = 'Expire';
                    break;
                case 'cancel':
                    $transaction->status_payment = 'Cancel';
                    break;
                default:
                    $transaction->status_payment = 'Failure';
                    break;
            }

            if ($transaction->save()) {
                return response()->json('success');
            } else {
                return response()->json(['error' => 'Failed to update payment status'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
