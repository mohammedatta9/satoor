<?php

namespace App\Http\Controllers\User;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->owner_orders()->latest()->get();
        return view('user.orders.orders',compact('orders' ));
    }

    public function getOrderModal($id)
    {

        $order  = Order::find($id);
        if($order && $order->owner_id == Auth::user()->id || 'admin' == Auth::user()->role ){
            // جلب محتوى المودال من ملف Blade
            $modalContent = view('user.orders.order_edit', compact('order'))->render();

            return response()->json(['modalContent' => $modalContent]);
        }



    }

    public function getOrderShipping($id)
    {

        $order  = Order::find($id);
         // جلب محتوى المودال من ملف Blade
        $modalContent = view('user.orders.shipping_edit', compact('order'))->render();

        return response()->json(['modalContent' => $modalContent]);

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'address'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'status.required' => trans('dash.status is required'),
            'address.required' => trans('dash.address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $order  = Order::find($id);

        $order->address = $request->address;
        $order->status = $request->status;
        $order->nots = $request->nots;
        $order->save();

        $notification = trans('dash.Updated Successfully');

        return response()->json(['message' => $notification]);
    }


}
