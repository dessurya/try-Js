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
    	$getIndexTable = SendRequestHelper::sendRequestToExtJsonMethod($opt);
        $toView = $getIndexTable['response']['record'];
        $model = explode('\\', $data->config['model']);
        $model = $model[count($model)-1];
        $componen = $data->actionType.$model;
        $render = [];
        $render['render'] = view('componen.'.$componen, compact('toView'))->render();
        $render['type'] = 'replace';
        $render['target'] = 'tbody';
        $return = $this->render($render);
        $page = [];
        for ($i = 1;$i<=$getIndexTable['response']['allOfPage'];$i++) {
            $page[] = $i;
        }
        $toView = [ 
            'page' => $page,
            'allOfPage' => $getIndexTable['response']['allOfPage'],
            'curentPage' => $getIndexTable['response']['curentPage'],
            'allRecord' => $getIndexTable['response']['allRecord'],
            'startRecord' => $getIndexTable['response']['startRecord'],
            'endRecord' => $getIndexTable['response']['endRecord']
        ];
        $return['indexTabInfo'] = true;
        $return['indexTabInfoTarget'] = '#table-data-info';
        $return['indexTabInfoRender'] = base64_encode(view('componen.table-data-info', compact('toView'))->render());
        
        return $return;
    }

    public function getForm($data, $authCode){
        $content = str_replace('\\', '', $data->model);
        $toView = null;
        if (is_numeric($data->id)) {
            $opt = [
                "token" => $authCode['codeOfMe'], 
                "json" => json_encode([
                    "model" => $data->model,
                    "id" => $data->id
                ]),
                "target" => config('endpoint.getFindData')
            ];
            $getFindData = SendRequestHelper::sendRequestToExtJsonMethod($opt);
            $toView = $getFindData['response']['data'];
        }
        $render = [];
        $render['render'] = view('componen.form'.$content, compact('toView'))->render();
        $render['type'] = 'replace';
        $render['target'] = '#fromRender';
        $return = $this->render($render);
        return $return;
    }

    public function destroyData($data, $authCode){
        $res = [];
        $res['success'] = true;
        $opt = [
            "token" => $authCode['codeOfMe'], 
            "json" => json_encode($data->all()),
            "target" => config('endpoint.destroyData')
        ];
        $destroyData = SendRequestHelper::sendRequestToExtJsonMethod($opt);
        $res['response'] = $destroyData['response'];
        $res['msg'] = $destroyData['response']['msg'];
        if ($destroyData['response']['success'] == false) {
            $res['success'] = false;
            $res['respnType'] = 'info';
        }else{
            $res['respnType'] = 'info';
            $res['getContentFM'] = true;
        }
        return $res;
    }

    public function storeDataAMU($data, $authCode){
        $res = [];
        $res['success'] = true;
        $data['function'] = 'storeDataAMU';
        $opt = [
            "token" => $authCode['codeOfMe'], 
            "json" => json_encode($data->all()),
            "target" => config('endpoint.storeData')
        ];
        $storeData = SendRequestHelper::sendRequestToExtJsonMethod($opt);
        $res['response'] = $storeData['response'];
        $res['msg'] = $storeData['response']['msg'];
        if ($storeData['response']['success'] == false) {
            $res['success'] = false;
            $res['respnType'] = 'info';
        }else{
            $res['respnType'] = 'info';
            $res['getContentFM'] = true;
        }
        return $res;
    }

    public function storeDataAMC($data, $authCode){
        $res = [];
        $res['success'] = true;
        $data['function'] = 'storeDataAMC';
        $opt = [
            "token" => $authCode['codeOfMe'], 
            "json" => json_encode($data->all()),
            "target" => config('endpoint.storeData')
        ];
        $storeData = SendRequestHelper::sendRequestToExtJsonMethod($opt);
        $res['response'] = $storeData['response'];
        $res['msg'] = $storeData['response']['msg'];
        if ($storeData['response']['success'] == false) {
            $res['success'] = false;
            $res['respnType'] = 'info';
        }else{
            $res['respnType'] = 'info';
            $res['getContentFM'] = true;
        }
        return $res;
    }

    public function storeDataAMG($data, $authCode){
        $res = [];
        $res['success'] = true;
        $data['function'] = 'storeDataAMG';
        $opt = [
            "token" => $authCode['codeOfMe'], 
            "json" => json_encode($data->all()),
            "target" => config('endpoint.storeData')
        ];
        $storeData = SendRequestHelper::sendRequestToExtJsonMethod($opt);
        $res['response'] = $storeData['response'];
        $res['msg'] = $storeData['response']['msg'];
        if ($storeData['response']['success'] == false) {
            $res['success'] = false;
            $res['respnType'] = 'info';
        }else{
            $res['respnType'] = 'info';
            $res['getContentFM'] = true;
        }
        return $res;
    }

    public function selfStoreData($data, $authCode){
        return [
            'respnType' => 'info',
            'respnReload' => false,
            'msg' => 'Success'
        ];
    }
}