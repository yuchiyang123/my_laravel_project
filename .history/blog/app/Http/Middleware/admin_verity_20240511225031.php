<?php

namespace App\Http\Middleware;

use Closure;
use GPBMetadata\Google\Api\Auth as ApiAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class admin_verity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = Auth::user();

        if($user && $user->id != '9'){
            return redirect('/admin_login')->with('error', '你沒有權限進入此頁面');
        }
        
        return $next($request);
    }

}
