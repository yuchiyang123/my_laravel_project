<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class sessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            // 已登入,返回下一個request不生成新session
            return $next($request);  
          }
       
          // 未登入,生成新的session再去做後續流程
          session()->regenerate();
       
          return $next($request);
    }
}
