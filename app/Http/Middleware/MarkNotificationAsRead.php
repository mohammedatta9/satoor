<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationAsRead
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
        $notificationId = $request->query('notification_id');
        if ($notificationId) {
            $notification = $request->user()->notifications()->find($notificationId);
            if ($notification && !$notification->read_at) {
                $notification->markAsRead(); // جعل الإشعار مقروءًا
            }
        }
        return $next($request);
    }
}
