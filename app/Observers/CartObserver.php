<?php

namespace App\Observers;

use App\Models\cart;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "created" event.
     *
     * @param  \App\Models\cart  $cart
     * @return void
     */
    // الObserver باختصار كانه ايفنت يعني عند حدوث حذف او تعديل ... اعملي هاد الكود
    // created عندا ينتهي من الكريات
    // creating عند عمليه الكريات
    public function creating(cart $cart)
    {
        $cart->id = Str::uuid();
        $cart->cookie_id = Cart::getCookieId();
    }

    /**
     * Handle the cart "updated" event.
     *
     * @param  \App\Models\cart  $cart
     * @return void
     */
    public function updated(cart $cart)
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     *
     * @param  \App\Models\cart  $cart
     * @return void
     */
    public function deleted(cart $cart)
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     *
     * @param  \App\Models\cart  $cart
     * @return void
     */
    public function restored(cart $cart)
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     *
     * @param  \App\Models\cart  $cart
     * @return void
     */
    public function forceDeleted(cart $cart)
    {
        //
    }
}
