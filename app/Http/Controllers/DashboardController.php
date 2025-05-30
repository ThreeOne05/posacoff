<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{


public function index()
{
    $today = now()->format('Y-m-d');
    
    $stats = [
        'total_products' => \App\Models\Product::count(),
        'today_income' => \App\Models\Order::whereDate('created_at', $today)->sum('total'),
        'today_orders' => \App\Models\Order::whereDate('created_at', $today)->count(),
        'total_cashiers' => \App\Models\User::where('role', 'cashier')->count(),
    ];

    // Data lain untuk dashboard, misal data kasir
    $cashiers = \App\Models\User::where('role', 'cashier')
        ->withCount(['orders' => function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        }])
        ->get();

    return view('dashboard', compact('stats', 'cashiers'));
}

}
