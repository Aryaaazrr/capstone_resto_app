<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $subcategory = Subcategory::where('name', 'Paket Reservasi')->first();
        $product = Product::where('id_subcategory', $subcategory->id_subcategory)->with('subcategory')->get();

        return view('pages.home.reservation', ['product' => $product]);
    }

    public function store(Request $request)
    {
        // dd($request->all());/
        // Validasi input
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        //     'phone' => 'required|string|min:9',
        //     'date' => 'required|date',
        //     'time' => 'required',
        //     'people' => 'required|integer',
        // ]);

        // Simpan reservasi
        DB::beginTransaction();

        try {
            // Hitung total transaksi
            // $grandTotal = $this->calculateTotal($request->all());

            // // Simpan transaksi
            // $transaction = Transaction::create([
            //     'id_user' => auth()->id(),
            //     'no_receipt' => 'T' . date('YmdHis'), // Format nomor transaksi yang benar
            //     'grand_total' => $grandTotal,
            //     'token_payment' => null, // Inisialisasi dengan null
            //     'url_payment' => null, // Inisialisasi dengan null
            // ]);

            // Simpan detail transaksi
            // foreach ($request->all() as $key => $value) {
            //     if (str_contains($key, 'paket_') && $value) {
            //         $productId = str_replace('paket_', '', $key);
            //         $qty = $request->input('qty_' . $productId);
            //         $product = Product::find($productId);
            //         if ($product) {
            //             TransactionDetails::create([
            //                 'id_transaction' => $transaction->id_transaction,
            //                 'id_product' => $productId,
            //                 'quantity' => $qty,
            //                 'price' => $product->price,
            //                 'total' => $product->price * $qty,
            //             ]);
            //         }
            //     }
            // }

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
