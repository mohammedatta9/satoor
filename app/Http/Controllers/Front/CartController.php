<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartModelRepository;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug){
        $data = User::where('slug', $slug)->firstOrFail()->makeHidden(['password','email','name']);

        return view('store_front.cart', [
            'cart' => $this->cart,
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product = Product::findOrFail($request->post('product_id'));

        $this->cart->add($product, User::where('slug', $slug)->firstOrFail()->id , $request->post('quantity'));

        if ($request->expectsJson()) {

            return response()->json([
                'message' => 'Item added to cart!',
            ], 201);
        }
        notify()->success(__('Added successfully'));
        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $id)
    {
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);
         $product = Product::findOrFail($request->post('product_id'));

        // if ($product->quantity <= $request->post('quantity')) {
        //     return [

        //         'message' => 1,
        //     ];
        // }

       $this->cart->update($id, $request->post('quantity'));
        return [
            'message' => 'Item a!',
            'totalx' => $this->cart->total(User::where('slug', $slug)->firstOrFail()->id),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $this->cart->delete($id);

        return [
            'message' => 'Item deleted!',
            'totala' => $this->cart->total(User::where('slug', $slug)->firstOrFail()->id),
        ];
    }

}
