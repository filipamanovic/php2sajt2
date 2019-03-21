<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->has('user')) {
            Log::critical('User with IP: '.$request->ip().'tried to access unautorized');
            return redirect('/');
        }
        $user = $request->session()->get('user');
        if($user->uloga != 'admin') {
            Log::critical('User with IP: ' . $request->ip() . 'tried to access unautorized');
            return redirect('/');
        }

        return $next($request);
    }
}
