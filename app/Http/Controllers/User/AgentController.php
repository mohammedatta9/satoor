<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Auth::user()->users()->latest()->get();
        return view('user.agents.agents',compact('agents' ));
    }

    public function changeStatus($id){
        $agent = User::find($id);
        if($agent->user_id != Auth::user()->id){
            $notification = trans('dash.you dont have permission to access this resource');
            $notification = array('messege'=>$notification,'alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }
        if($agent->status==1){
            $agent->status=0;
            $agent->save();
            $message = trans('dash.Inactive Successfully');
        }else{
            $agent->status=1;
            $agent->save();
            $message= trans('dash.Active Successfully');
        }
        return response()->json($message);
    }
}
