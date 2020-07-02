<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use App\Models\Config;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Hash;

class CodeApiController extends Controller{

	public function getCode(Request $Request){
		$res = [ 'success' => false ];
		$res['msg'] = 'Email or password wrong';
		$user = Users::where('email', $Request->email)->first();
		if (!empty($user) and Hash::check($Request->password, $user->password)){
			$code = Str::random(32);
			$time = strtotime(Carbon::now()->addHours(10));
			$user->code_of_api = $code;
			$user->code_of_api_time = $time;
			$user->save();
			$res['success'] = true;
			$res['msg'] = 'Success sign in '.$user->name;
			$res['code'] = $code;
			$res['time'] = $time;
			$res['type'] = 'administrator';
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
		}
		return response()->json($res, 200);
	}

	public function menuCall(Request $Request){
		$res = [];
        $res['success'] = false;
		$accKey = 'menuCall'.$Request->userType;
		$Config = Config::where('accKey', $accKey)->first();
		if (!empty($Config)) {
			$res['success'] = true;
			$res['data'] = $Config;
		}
		return response()->json($res);
	}

	public function viewData(Request $Request){
		$res = [];
        $res['success'] = false;
        $res['msg'] = "Not found data";
		$accKey = $Request->actionContent.'_'.$Request->userType;
		$Config = Config::where('accKey', $accKey)->first();
		$res['Config'] = $accKey;
		if (!empty($Config)) {
			$Config = json_decode($Config->config,true);
			$function = $Config['function_name'];
			$res['success'] = true;
			$res['msg'] = "found your data request";
			$res['data'] = $this->$function([ 'config' => $Config, 'model' => $Config['model'], 'id' => $Request->indetity['id']]);

		}
		return response()->json($res);
	}

	public function findData($config){
		$model = $config['model'];
		return $model::find($config['id']);
	}

	public function getConfigPageIndex($config){
		return $config['config'];
	}

	public function indexData(Request $Request){
		$res = [];
        $res['success'] = true;
		$model = $Request->config['model'];
		$data = $model::select('*');
		if (isset($Request->config['search'])) {
			$condition = [];
			foreach ($Request->config['search'] as $key => $value) {
				$condition[] = [ $key, 'like', '%'.$value.'%' ];
			}
			$data->where([$condition]);
		}
		if (isset($Request->config['order'])){
			$data->orderBy($Request->config['order']['key'], $Request->config['order']['value']);
		}
		$curentPage = 1;
		$skip = 1;
		if (isset($Request->config['page'])){
			$curentPage = $Request->config['page'];
			$skip = ($Request->config['page']-1)*10;
			$data->skip($skip)->take(10);
		}else{
			$data->skip(0)->take(10);
		}
		$count = $data->count();
		$page = ceil($count%10);
		$data = $data->get();
		$res['record'] = $data;
		$res['allOfPage'] = $page;
		$res['curentPage'] = $curentPage;
		$res['endRecord'] = $page;
		$res['startRecord'] = $skip;
		return $res;
	}
}
