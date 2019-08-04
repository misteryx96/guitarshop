<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
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
        if($request->session()->has('user')){
            $korisnik = $request->session()->get('user')[0];
            if($korisnik->username == 'adminko'){
                return $next($request);
            } else {
                return redirect()->back()->with('error','Nemate pravo pristupa ovoj stranici!');
            }
        }

        return redirect()->back()->with('error','Nemate pravo pristupa ovoj stranici!');
    }
}
