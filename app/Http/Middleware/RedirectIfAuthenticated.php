<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard($guard)->check()) {
            //            return redirect('/home');
            if(Auth::user()->status == "close"){
                Auth::logout();
                return redirect()->intended('login')->with('error', 'Account inactive contact administrator!');
                    } 
                        // Authentication passed...
                    else if(Auth::user()->role == "admin"){ 
                            return redirect()->intended('admin/add_user');
                    } 
                    else if(Auth::user()->role == "backoffice"){ 
                        return redirect()->intended('backoffice/add_user');
                    } 
                    else if(Auth::user()->role == "supervisor"){
                        return redirect()->intended('upervisor/assign-user');
                    }   
                    else if(Auth::user()->role == "student"){
                        return redirect()->intended('student/assigned-task');
                    }    
                        
            else{
                Auth::logout();
                        return redirect()->back()->with('error', 'Incorrect User or Password!');
                }
            }

        return $next($request);
    }
}
