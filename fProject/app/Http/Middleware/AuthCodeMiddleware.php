<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Carbon\Carbon;

class AuthCodeMiddleware
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
        $res = [];
        $res['success'] = false;
        $res['respnType'] = 'info';
        $res['respnReload'] = false;
        $res['msg'] = 'fail, your session code has expired';
        if ($request->session()->has('authCode')) {
            $authCode = $request->session()->get('authCode');
            $time = strtotime(Carbon::now());
            if ($authCode['codeTmMe'] > $time) {
                return $next($request);
            }
        }
        return response()->json($res);
    }
}
