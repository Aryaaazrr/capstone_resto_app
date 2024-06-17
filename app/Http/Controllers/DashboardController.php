<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();
        $yearStart = Carbon::now()->startOfYear();

        $transactionsThisMonth = Transaction::where('status_transaction', '==', 'Completed')->whereBetween('created_at', [$monthStart, $today])->count();

        $totalProducts = Product::count();
        $revenueThisMonth = Transaction::whereBetween('created_at', [$monthStart, $today])->sum('grand_total');

        $formattedrevenueThisMonth = "Rp. " . number_format($revenueThisMonth, 0, ',', '.');
        $chartData = $this->getChartData();

        return view('pages.admin.dashboard.index', compact('formattedrevenueThisMonth', 'transactionsThisMonth', 'revenueThisMonth', 'chartData', 'totalProducts'));
    }
    private function getChartData()
    {
        $revenueData = [];
        $chartCategories = [];

        $revenues = Transaction::selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        foreach ($revenues as $revenue) {
            $chartCategories[] = $revenue->date;
            $revenueData[] = $revenue->total;
        }

        return [
            'revenue' => $revenueData,
            'categories' => $chartCategories,
        ];
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
        //
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
