<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Users;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ApiCodeMiddleware
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
        $res['msg'] = 'fail, your session code has expired';
        if (!empty($request->header('Authorization'))) {
            $token = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $token);
            $Users = Users::where('code_of_api', $token)->first();
            if (!empty($Users)) {
                $time = strtotime(Carbon::now());
                if ($Users->code_of_api_time > $time) {
                    $indetity = [
                        'id' => $Users->id,
                        'name' => $Users->name,
                        'mail' => $Users->email
                    ];
                    $request->request->add(['indetity' => $indetity]);
                    return $next($request);
                }
            }
        }
        return response()->json($res);
    }
}
