<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
{
    if (!in_array(auth()->user()->role, ['admin', 'employee'])) {
        return redirect('/')->with('error', 'Brak uprawnień.');
    }

    $orders = Order::with('product', 'user')->latest()->get();
    return view('orders.index', compact('orders'));
}
    public function stats()
{
    // 1. Top 5 produktów wg ilości sprzedanych sztuk
    $topProducts = Order::with('product')
        ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
        ->groupBy('product_id')
        ->orderBy('total_sold', 'DESC')
        ->limit(5)
        ->get();

    // 2. Liczba zamówień z ostatnich 7 dni
    $dailyOrders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    return view('admin.stats', compact('topProducts', 'dailyOrders'));
}
}