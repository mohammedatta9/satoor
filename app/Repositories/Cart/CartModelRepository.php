<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get($owner_id = null) : Collection
    {
        if (!$this->items->count()) {
            $this->items = Cart::where('owner_id',$owner_id)->with('product')->get();
        }

        return $this->items;
    }

    public function add(Product $product, $owner_id = null , $quantity = 1)
    {
        $item =  Cart::where('product_id', '=', $product->id)
            ->first();

        if (!$item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'owner_id' => $owner_id,
            ]);
            $this->get($owner_id)->push($cart);
            return $cart;
        }

        return $item->increment('quantity', $quantity);
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total($owner_id = null) : float
    {
        /*return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');*/

        return $this->get($owner_id)->sum(function($item) {
            if($item->product->price_alternative ) {
                return $item->quantity * $item->product->price_alternative;
            }else{
                return $item->quantity * $item->product->price;
            }

        });
    }
}
