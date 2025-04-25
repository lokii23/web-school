<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Teacher
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->usertype != 'teacher'){
            return redirect('dashboard');
        }
        return $next($request);
    }
}
