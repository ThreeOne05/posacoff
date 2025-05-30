<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show POS page.
     */
    public function pos()
    {
        // Pendapatan hari ini (otomatis untuk hari berjalan)
        $today_income = Order::whereDate('created_at', Carbon::today())->sum('total');

        // Pendapatan bulan ini
        $monthly_income = Order::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->sum('total');

        // Data grafik penjualan bulanan (per hari)
        $daysInMonth = now()->daysInMonth;
        $chart_labels = [];
        $chart_data = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::now()->startOfMonth()->addDays($day - 1);
            $chart_labels[] = $date->format('d');
            // Pastikan hasil sum bertipe float, tidak string/null
            $income = Order::whereDate('created_at', $date)->sum('total');
            $chart_data[] = (float) $income;
        }

        return view('orders.pos', compact(
            'today_income',
            'monthly_income',
            'chart_labels',
            'chart_data'
        ));
    }

    /**
     * Add item to the cart.
     */
    public function addItem(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return back()->withErrors('Produk tidak ditemukan.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += 1;
        } else {
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Complete the order transaction.
     */
    public function complete(Request $request)
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        if ($total == 0) {
            return redirect()->route('pos')->with('error', 'Keranjang kosong.');
        }

        $order = new \App\Models\Order();
        $order->order_number = 'ORD-' . time();
        $order->user_id = Auth::id();
        $order->subtotal = $total;
        $order->tax = 0;
        $order->total = $total;
        $order->status = 'completed';

        if (!$order->save()) {
            dd('GAGAL SIMPAN ORDER');
        }

        foreach ($cart as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');
        session(['last_order_id' => $order->id]);
        return redirect()->route('pos.checkout');
    }

    public function removeItem($key)
    {
        $cart = session('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]);
            return back()->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        return back()->withErrors('Item tidak ditemukan di keranjang.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Semua item berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        $orderId = session('last_order_id');
        if (!$orderId) {
            return redirect()->route('pos')->with('error', 'Tidak ada transaksi yang bisa dicetak.');
        }

        $order = \App\Models\Order::with('items.product')->findOrFail($orderId);
        return view('orders.checkout', compact('order'));
    }
}