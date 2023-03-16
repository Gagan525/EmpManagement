<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->path() == "employee/login" && $request->session()->has('employee'))
        {
            return redirect('/employee/inbox');
        }elseif($request->path() == "employee/inbox" && !$request->session()->has('employee'))
        {
            return redirect('employee/login');
        }
        return $next($request);
    }
}
