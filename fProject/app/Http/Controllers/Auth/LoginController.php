<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Helper\SendRequestHelper;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function loginView(Request $req){
        if ($req->session()->has('authCode')) {
            return redirect('/main');
        }
        return view('login');
    }

    public function signinExe(Request $req){
        $data = [
            "json" => json_encode(["email" => $req->email, "password" => $req->password]),
            "target" => config('endpoint.signinExe')
        ];
        $json = SendRequestHelper::sendRequestToExtJsonMethod($data);
        $session = [];
        if ($json['response']['success'] == true) {
            $session['codeOfMe'] = $json['response']['code'];
            $session['codeTmMe'] = $json['response']['time'];
            $session['codeTyMe'] = $json['response']['type'];
            $req->session()->put('authCode', $session);
            $req->session()->reflash();
            return redirect('/main');
        }
        return redirect('/')->with(['session' => $json['response']]);
    }

    public function signoutExe(Request $req){
        $result = [];
        $result['success'] = false;
        $result['respnType'] = 'info';
        $result['respnReload'] = false;
        $result['msg'] = 'fail, log out';
        if ($req->session()->has('authCode')) {
            $req->session()->flush();
            $result['success'] = true;
            $result['respnReload'] = true;
            $result['msg'] = 'success, log out';
        }
        return response()->json($result);
    }

    public function main(Request $req){
        if ($req->session()->has('authCode')) {
            return view('main');
        }
        return redirect('/');
    }
}
