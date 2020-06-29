<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;

class CodeApiController extends Controller{

	public function getCode(Request $Request){
		$res = [ 'success' => false ];
		$user = Users::where('email', $Request->email)->first();
		if (empty($user)) {
			$res['msg'] = 'Email or password wrong';
		}else if (Hash::check($Request->password, $user->password)){
			$code = Str::random(32);
			$time = strtotime(Carbon::now()->addHours(10));
			$user->code_of_api = $code;
			$user->code_of_api_time = $time;
			$user->save();
			$res['msg'] = 'Success sign in '.$user->name;
			$res['code'] = $code;
			$res['time'] = $time;
			$res['url'] = 'file:///E:/xampp-7/htdocs/try-Js/fProject/main.html';
		}
		return response()->json($res, 200);
	}

	public function checking(Request $Request){
		$Request->code;
		$res = [ 'success' => false ];
		$user = Users::where('code_of_api', $Request->code)->first();
		$time = strtotime(Carbon::now());
		if (!empty($user)) {
			$res['msg'] = 'Email or password wrong';
		}else if ($user->code_of_api_time > $time){
			$user->save();
			$res['success'] = true;
			$res['msg'] = $user->name.' you alerdy login';
			$res['code'] = $Request->code;
			$res['time'] = $user->code_of_api_time;
			$res['url'] = 'file:///E:/xampp-7/htdocs/try-Js/fProject/main.html';
		}
		return response()->json($res, 200);
	}
}
