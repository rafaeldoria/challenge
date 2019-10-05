<?php

namespace App\Http\Controllers;

use App\Models\OauthClient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $oauth;
    private $auth;
    private $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
        $this->oauth = new OauthClientController;
        $this->auth = $this->oauth->getCredentialsOauth();
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $token = $this->oauth->getToken($this->auth);
        
        $this->request->session()->put('authtoken', $token);

        return view('home');
    }
}
