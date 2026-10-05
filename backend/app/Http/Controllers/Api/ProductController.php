<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category:id,name')
            ->where('is_active', true)
            ->latest()
            ->get();

        return response()->json($products->map(fn ($p) => $this->format($p)));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json($this->format($product));
    }

    private function format(Product $p): array
    {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'slug' => $p->slug,
            'description' => $p->description,
            'price' => $p->price,
            'stock' => $p->stock,
            'image_url' => $p->image_url,
            'category' => $p->category?->name,
        ];
    }
}
