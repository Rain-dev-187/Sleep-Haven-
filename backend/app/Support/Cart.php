<?php

namespace App\Support;

use App\Models\Product;

/** Keranjang belanja sederhana berbasis session (tanpa login). */
class Cart
{
    public static function all(): array
    {
        return session('cart', []);
    }

    public static function save(array $cart): void
    {
        session(['cart' => $cart]);
    }

    public static function add(Product $product, int $qty = 1): void
    {
        $cart = self::all();
        $current = $cart[$product->id] ?? 0;
        $cart[$product->id] = min($current + max(1, $qty), $product->stock);
        self::save($cart);
    }

    public static function remove(int $id): void
    {
        $cart = self::all();
        unset($cart[$id]);
        self::save($cart);
    }

    public static function clear(): void
    {
        session()->forget('cart');
    }

    /** @return array<int, array{product: Product, qty: int, subtotal: int}> */
    public static function items(): array
    {
        $cart = self::all();
        if (empty($cart)) {
            return [];
        }
        $products = Product::whereIn('id', array_keys($cart))
            ->where('is_active', true)->get()->keyBy('id');
        $items = [];
        foreach ($cart as $id => $qty) {
            if (isset($products[$id]) && $qty > 0) {
                $p = $products[$id];
                $items[] = ['product' => $p, 'qty' => $qty, 'subtotal' => $p->price * $qty];
            }
        }
        return $items;
    }

    public static function total(): int
    {
        return array_sum(array_column(self::items(), 'subtotal'));
    }

    public static function count(): int
    {
        return array_sum(self::all());
    }
}
