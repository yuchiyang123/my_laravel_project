<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScoreFormMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function score_form(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error','你必須登入才能填寫評分表單');
        }
        return $next($request);
    }
}
