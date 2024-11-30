<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    //
    public function home($slug){
        $data = User::where('slug', $slug)->firstOrFail()->makeHidden(['password','email','name']);

        return view('store_front.home', compact('data'));

      }
}
