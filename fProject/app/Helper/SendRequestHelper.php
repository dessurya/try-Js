<?php
namespace App\Helper;

use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Session;

class SendRequestHelper {

	public static function sendRequestToExtJsonMethod($arr){
		$client = new Client();
		$options = [];
		$options['body'] = $arr['json'];
		$options['debug'] = false;
		$options['headers'] = [];
		$options['headers']['content-type'] = 'application/json';
		$options['headers']['Accept'] = 'application/json';
		if (isset($arr['token'])) {
			$options['headers']['Authorization'] = 'Bearer '.$arr['token'];
		}
		try {
			$res = $client->post($arr['target'], $options);
		} catch (ClientException $e) {
			$error = $e->getRequest() . "\n";
			if ($e->hasResponse()) {
				$error .= $e->getResponse() . "\n";
			}
			return ["success"=>false, "request" => $options, "response" => $error, "target" => $arr['target']];
		}
		$res = json_decode($res->getBody()->getContents(), true);
		if ($res['success'] == false ) {
			$res['respnType'] = 'info';
			if ($res['msg'] == 'fail, your session code has expired') {
				$res['signoutExe'] = true;
			}
			exit(json_encode($res));
		}
		return ["success"=>$res['success'], "request" => $options, "response" => $res, "target" => $arr['target']];
	}

}