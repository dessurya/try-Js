<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\SendRequestHelper;
use Carbon\Carbon;
use Session;

class ActionController extends Controller{

    public function index(Request $req){
		$action = $req->actionType;
		$res = $this->$action($req, $req->session()->get('authCode'));
        return response()->json($res);
    }

    private function render($data){
    	$res = [];
    	$res['success'] = true;
    	$res['respnType'] = 'render';
        $res['respnReload'] = false;
    	$res['renderType'] = $data['type'];
    	$res['renderTarget'] = $data['target'];
    	$res['renderContent'] = base64_encode($data['render']);
    	return $res;
    }

    private function getMenu($data, $authCode){
    	$opt = [
        	"token" => $authCode['codeOfMe'], 
            "json" => json_encode([
            	"userType" => $authCode['codeTyMe']
            ]),
            "target" => config('endpoint.getMenu')
        ];
        $json = SendRequestHelper::sendRequestToExtJsonMethod($opt);
        $json = $json['response']['data']['config'];
        $arr = json_decode($json, true);
        $arr = $arr['menu'];
        $render = [];
        $render['render'] = view('componen.menu', compact('arr'))->render();
        $render['type'] = 'replace';
        $render['target'] = 'ul#navigation';
    	$return = $this->render($render);
    	$return['getContentFM'] = true;
    	return $return;
    }

    private function getContent($data, $authCode){
    	$opt = [
        	"token" => $authCode['codeOfMe'], 
            "json" => json_encode([
            	"userType" => $authCode['codeTyMe'],
            	"actionContent" => $data->actionContent
            ]),
            "target" => config('endpoint.getViewData')
        ];
    	$getViewData = SendRequestHelper::sendRequestToExtJsonMethod($opt);
    	$getViewData = $getViewData['response']['data'];
    	$render = [];
        $render['render'] = view('componen.'.$data->actionContent, compact('getViewData'))->render();
        $render['type'] = 'replace';
        $render['target'] = '#renderContent';
    	$return = $this->render($render);
    	if (isset($getViewData['index'])) {
	    	$return['getIndexTable'] = true;
	    	$return['getIndexModel'] = $getViewData['model'];
    	}
    	return $return;
    }

    public function getIndexTable($data, $authCode){
    	$opt = [
        	"token" => $authCode['codeOfMe'], 
            "json" => json_encode([
            	"userType" => $authCode['codeTyMe'],
            	"config" => $data->config
            ]),
            "target" => config('endpoint.getIndexTable')
        ];
    	return $getIndexTable = SendRequestHelper::sendRequestToExtJsonMethod($opt);
    }
}