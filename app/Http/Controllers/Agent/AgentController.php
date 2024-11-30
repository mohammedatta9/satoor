<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    //
    public function dashboard($slug){
        $data = User::where('slug', $slug)->firstOrFail()->makeHidden(['password','email','name']);
        $user = Auth::user();

        return view('store_front.agent.dashboard', compact('data','user'));
      }
}
