<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
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
