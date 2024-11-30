<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            // dd($request->route('slug').'-'.$request->user()->user->slug);
        if(strtolower($request->route('slug')) == strtolower($request->user()->user->slug)){
            return $next($request);
        }
        $notification = trans('dash.you dont have permission to access this resource');
        $notification = array('messege'=>$notification,'alert-type'=>'warning');
        return redirect()->route('store.show',$request->user()->user->slug)->with($notification);
    }
}
