<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check() || auth()->user()->level === 'Administrator' || auth()->user()->level === 'Accounting' || auth()->user()->level === 'Media' || auth()->user()->level === 'Marketing' || auth()->user()->level === 'Owner' || auth()->user()->level === 'Workshop'){
            return $next($request);
        } else {
            abort(403);
        }
        
        
    }
}
