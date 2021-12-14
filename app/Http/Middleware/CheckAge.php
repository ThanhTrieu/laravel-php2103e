<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $param = null)
    {
        // $param : tham so truyen len middleware neu co
        $age = $request->age; // lay duoc param
        if($age > 18 || $param === 'admin'){
            return $next($request); // tiep tuc 
        }
        // cho vao trang ko dc phep xem
        return redirect()->route('not-watching-film');
        // return redirect(route('not-watching-film'))
    }
}
