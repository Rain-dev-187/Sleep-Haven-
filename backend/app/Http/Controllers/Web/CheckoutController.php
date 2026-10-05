<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Support\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::count() === 0) {
            return redirect()->route('catalog.index');
        }

        return view('checkout.index', [
            'total' => Cart::total(),
            'count' => Cart::count(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|max:100',
            'phone' => 'required|max:20',
            'address' => 'required',
            'payment_method' => 'required|in:transfer,cod',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        if (Cart::count() === 0) {
            return redirect()->route('catalog.index');
        }

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('proofs', 'public');
        }

        $order = Order::create([
            'customer_name' => $data['customer_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'payment_method' => $data['payment_method'],
            'payment_proof' => $data['payment_proof'] ?? null,
            'status' => Order::STATUS_PENDING,
            'total' => Cart::total(),
        ]);

        foreach (Cart::items() as $item) {
            $order->items()->create([
                'product_id' => $item['product']->id,
                'quantity' => $item['qty'],
                'price' => $item['product']->price,
            ]);
            $p = $item['product'];
            $p->stock = max(0, $p->stock - $item['qty']);
            $p->save();
        }

        Cart::clear();

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
