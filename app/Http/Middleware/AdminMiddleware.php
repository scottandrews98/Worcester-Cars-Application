<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    // Stops level 2 users accessing admin pages
    public function handle($request, Closure $next){
        if ($request->User() && $request->User()->userLevel_id != 2){
            return $next($request);
        }else{
            return redirect()->route('home');
        }
    }
}