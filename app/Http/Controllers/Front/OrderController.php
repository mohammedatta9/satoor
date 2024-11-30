<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Cart\CartModelRepository;
use App\Notifications\OrderCreatedNotification;

class OrderController extends Controller
{
    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }


    public function index(Request $request , $slug)
    {
        if($this->cart->total(User::where('slug', $slug)->firstOrFail()->id) == 0){
            $notification = array('messege'=> 'The cart is empty','alert-type'=>'warning');
            return redirect()->route('store.show',$slug)->with($notification);
        }
        $data = User::where('slug', $slug)->firstOrFail()->makeHidden(['password','email','name']);
            return view('store_front.order', [
                'cart' => $this->cart,
                'data' => $data
            ]);
    }


    public function store(Request $request, $slug)
    {

        if($this->cart->total(User::where('slug', $slug)->firstOrFail()->id) == 0){

            $notification = array('messege'=> 'The cart is empty','alert-type'=>'warning');

            return redirect()->route('store.show',$slug)->with($notification);
        }

        $this->validate($request, [
            'email' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required' , 'numeric'],
            'payment_method' => ['required'],

        ] );

        $owner= User::where('slug', $slug)->firstOrFail();
             //register
            if(isset($request->make_user)){

              $this->validate($request, [
                'email' => ['required', 'string', 'email','email:rfc' , 'max:255', 'unique:users'],
                'password' => ['required','confirmed', Rules\Password::defaults()],
                //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            ] );
            $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => 'agent',
            'user_id' => $owner->id,
            'password' => Hash::make($request->password),
        ]);

        }
            try{


        $order = new Order();
        if ($order) {
            // try {
                if(Auth::user()){
                    $order->user_id = Auth::user()->id;
                }
                if(isset($user)){
                    $order->user_id = $user->id;
                }
                $order->owner_id = $owner->id;
                $order->name = $request->name;
                $order->email = $request->email;
                $order->phone = $request->phone;
                $order->nots = $request->nots;
                $order->address = $request->address;
                $order->payment_method = $request->payment_method;
                $order->total = $this->cart->total(User::where('slug', $slug)->firstOrFail()->id) + 8;
                $order->save();

                foreach($this->cart->get(User::where('slug', $slug)->firstOrFail()->id) as $cart){

                    $item = new OrderItem();

                    $item->order_id = $order->id;
                    $item->product_id = $cart->product->id;
                    $item->product_name =$cart->product->name;
                    $item->price = $cart->product->price;
                    $item->quantity = $cart->quantity;
                    $item->save();
                }

                // $this->cart->empty();
                $email = $request->email;
                if($email){
                    $owner->notify(new OrderCreatedNotification($order));
                }

                // if($request->payment_method == "check"){
                //     $order= $data1;
                //     notify()->success( __('The request has been sent, please check the email for details'));

                //     return redirect()->route('orders.payments.create', $order->id);
                // }

                //  if(isset($user)){
                //     event(new Registered($user));
                //     Auth::login($user);

                //     $notification = array('messege'=> 'The request has been sent, please check the email for details','alert-type'=>'success');
                //     return redirect()->route('agent.dashboard', ['slug' => $slug])->with($notification);
                // }else{
                //     $notification = array('messege'=> 'The request has been sent, please check the email for details','alert-type'=>'success');
                //  return redirect()->route('store.show',$slug)->with( $notification);
                // }
        } else {
            $notification = array('messege'=> 'error','alert-type'=>'error');
            return redirect()->back()->with( $notification);
        }
            } catch (\Exception $e){

                return   $e->getMessage() ;
            }

    }

    public function showorder($id)
    {

        $order = Order::find($id);
        if($order){
            return view('site.homePage.ordershow', [
                 'order' =>  $order,
            ]);
        }else{
            return redirect()->back();
        }



    }
     public function delevorder($id)
    {

        $order = Order::find($id);
        if($order){
            $order->status = 3 ;
            $order->save();
            notify()->success(__('Request received'));
            return redirect()->route('viewHomePage');

        }else{
            return redirect()->route('viewHomePage');
        }



    }

    public function delete_order(Request $request)
    {
        $order = Order::find($request->id);

        $order->delete();

        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }


    public function cartempty( )
    {

        $this->cart->empty();
        notify()->success(__('The cart has been emptied'));
        return redirect()->route('viewHomePage');

    }

    public function discount(Request $request)
    {
       $discount = Discount::where('code', $request->code)->get()->first();
       if($discount){
        $rate = $discount->rate / 100;
        $cities = City::get();
         if($request->address_id){
           $this->address = Address::find($request->address_id);
            $add =1;
            return view('site.homePage.order', [
                'cart' => $this->cart,
                'address' =>  $this->address,
                'add' =>  $add,
                'cities' =>  $cities,
                'rate' =>  $rate,

            ]);
        }else{
            $add =2;
            return view('site.homePage.order', [
                'cart' => $this->cart,
                'add' =>  $add,
                'rate' =>  $rate,
                'cities' =>  $cities,

            ]);
        }
       }else{
        return redirect()->back();

       }

    }

    public function numberorder(Request $request)
    {
          $order = Order::where('number', $request->number)->first();
          if($order){
            return view('site.homePage.ordershow', [
                 'order' =>  $order,
            ]);
        }else{
            notify()->error( __('Verify the order number'));

            return redirect()->back();
        }

    }

}
