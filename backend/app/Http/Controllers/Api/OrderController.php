<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|max:100',
            'phone' => 'required|max:20',
            'address' => 'required',
            'payment_method' => 'required|in:transfer,cod',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $lines = [];
        $total = 0;
        foreach ($data['items'] as $row) {
            $product = Product::where('is_active', true)->findOrFail($row['product_id']);
            $qty = min($row['qty'], $product->stock);
            if ($qty < 1) {
                continue;
            }
            $lines[] = ['product' => $product, 'qty' => $qty];
            $total += $product->price * $qty;
        }

        abort_if(empty($lines), 422, 'Keranjang kosong atau stok habis.');

        $order = Order::create([
            'customer_name' => $data['customer_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'payment_method' => $data['payment_method'],
            'status' => Order::STATUS_PENDING,
            'total' => $total,
        ]);

        foreach ($lines as $line) {
            $order->items()->create([
                'product_id' => $line['product']->id,
                'quantity' => $line['qty'],
                'price' => $line['product']->price,
            ]);
            $p = $line['product'];
            $p->stock = max(0, $p->stock - $line['qty']);
            $p->save();
        }

        return response()->json([
            'order_id' => $order->id,
            'total' => $order->total,
            'status' => $order->status,
        ], 201);
    }
}
