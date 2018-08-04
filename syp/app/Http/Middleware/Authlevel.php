<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Authlevel
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


        $user = Auth::user();

        if($user == null){


            return redirect('/');

        }





        if (Auth::user()->level > 1 )
        {
            return $next($request);
        }else if (Auth::user()->level == ''){


            Auth::logout();
            return redirect('/');
        }

        return redirect('/user');
    }




}
