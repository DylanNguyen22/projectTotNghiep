<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class checkLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::get('hfre') !== NULL) {
            return $next($request);
        } else {
            if ($request->path() != 'dangnhap') {
                return redirect('/dangnhap');
            }else{
                return $next($request);
            }
        }

    }
}