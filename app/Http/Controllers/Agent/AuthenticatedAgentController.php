<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedAgentController extends Controller
{
    /**
     * Display the login view.
     */
    public function create($slug)
    {
        $data = User::where('slug', $slug)->firstOrFail()->makeHidden(['password','email','name']);
        return view('store_front.agent.login', compact('data'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request , $slug): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($slug.'/dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     *
     */
//     لماذا يُستخدم RedirectResponse؟
// توضيح نوع البيانات: يوضح نوع البيانات المتوقع الذي سيتم إرجاعه من الدالة، مما يسهل فهم الكود.
// التوافق مع الأنواع الصارمة: إذا كنت تستخدم كتابة الأنواع الصارمة (strict typing) في PHP، يُصبح هذا ضروريًا لضمان تطابق نوع الإرجاع مع ما هو محدد في تعريف الدالة.
// أفضل ممارسات البرمجة: يعزز من قابلية الصيانة والفهم السريع للكود بالنسبة للمطورين الآخرين.

    public function destroy(Request $request , $slug): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'.$slug);
    }
}
