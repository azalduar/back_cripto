<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccountActived
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
        if (! $request->user()->is_activated) {
            return response()->json([
                'message'=>'The account is not active'
            ], 403);
        }

        return $next($request);
    }
}
