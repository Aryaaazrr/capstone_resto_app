<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transaction = Transaction::with('user')->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($transaction as $row) {
                $user = $row->user;
                $rowData[] = [
                    'id_transaction' => $row->id_transaction,
                    'name' => $user->name,
                    'no_receipt' => $row->no_receipt,
                    'grand_total' => $row->grand_total,
                    'no_telp' => $row->no_telp,
                    'reservation_date' => $row->reservation_date,
                    'reservation_time' => $row->reservation_time,
                    'reservation_people' => $row->reservation_people,
                    'status_transaction' => $row->status_transaction,
                    'status_payment' => $row->status_payment,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function confirm(String $id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->status_transaction = 'Process';
            if ($transaction->save()) {
                return response()->json(['message' => 'Data deleted successfully.']);
            }
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cancel(String $id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->status_transaction = 'Cancel';
            if ($transaction->save()) {
                return response()->json(['message' => 'Data deleted successfully.']);
            }
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, String $id)
    {
        $transaction = Transaction::where('id_transaction', $id)->with('user')->first();
        $transaction_details = TransactionDetails::where('id_transaction', $id)->with(['product', 'transaction'])->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($transaction_details as $row) {
                $product = $row->product;
                $transaction = $row->transaction;

                $rowData[] = [
                    'id_transaction' => $transaction->id_transaction,
                    'image' => $product->image,
                    'product' => $product->name,
                    'quantity' => $row->quantity,
                    'price' => $row->price,
                    'total' => $row->total,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.transaction.show', ['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
