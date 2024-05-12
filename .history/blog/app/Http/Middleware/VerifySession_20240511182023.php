<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifySession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // 清除无效的会话数据等任何必要的操作
            // 例如：清除会话数据
            $request->session()->invalidate();
            
            // 重新登录用户或执行其他操作
            // 例如：重定向到登录页面
            return redirect()->route('login');
        }

        return $next($request);
    }
}
