<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::items();
        $total = Cart::total();

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        Cart::add($product, (int) $request->input('qty', 1));

        return redirect()->route('cart.index');
    }

    public function remove(int $id)
    {
        Cart::remove($id);

        return redirect()->route('cart.index');
    }
}
