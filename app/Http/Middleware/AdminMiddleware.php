<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // التأكد من تسجيل الدخول وأن الدور هو admin
        if (Auth::check() && Auth::user()->role === 'teacher') {
            return $next($request);
        }

        // إذا كان طالب وحاول دخول صفحة الأدمن يوجه لصفحة الكورسات الخاصة بالطالب
        if (Auth::check() && Auth::user()->role === 'student') {
            return redirect()->route('students.index');
        }

        return redirect()->route('login');
    }
}
