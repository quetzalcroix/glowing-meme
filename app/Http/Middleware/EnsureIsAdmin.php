<?php

namespace App\Http\Middleware;

use App\meta;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $api = new meta();
        if (Auth::guard('admin')->check()) {
            //ddecode
            $res = $api->verify_license();
            if ($res['status'] != true) {
                die("
          <h3>Sorry for interrupting! Please check back later.</h3>
          ");
            }
            return $next($request);
        } else {
            return redirect()->route('validate_admin');
        }
    }
}
