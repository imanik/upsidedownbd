<?php

namespace App\Http\Middleware;

use App\Helpers;
use Closure;

use function GuzzleHttp\json_decode;

class CheckPermission
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
        // $start_time = microtime(true);

        // $end_time = microtime(true);
        // echo end_time - $start_time;
        // dd($current_route, $valid_routes);
        if (Helpers::isRouteValid()) {
            return $next($request);
        } else {
            abort(401);
            // return redirect()->route('dashboard')->with('fail', "You don't have access.");
        }
    }
}
