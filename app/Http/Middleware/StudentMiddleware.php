<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // التأكد من تسجيل الدخول وأن الدور هو student
        if (Auth::check() && Auth::user()->role === 'student') {
            return $next($request);
        }

        // إذا كان أدمن وحاول دخول صفحة الطالب يوجه للداشبورد الخاصة بالأدمن
        if (Auth::check() && Auth::user()->role === 'teacher') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
