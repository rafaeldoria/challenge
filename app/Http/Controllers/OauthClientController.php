<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\OauthClient;
use App\Models\User;
use Laravel\Passport\Passport;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class OauthClientController extends Controller
{
    private $auth_client_id = 2;
    private $auth_client_secret = 'm5gro9gaHQx3bziueVDSKMwCNF8jt1EPH1lgQaAt';
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($this->validationLogin($request)){
            $secret = OauthClient::where('password_client', 1)->first();
            
            return [
                'client_id' => $secret->id,
                'client_secret' => $secret->secret
            ];
        }
        return response('Error validating data', 400);
        
    }

    private function validationLogin($request)
    {
        $login = false;
        if ($hashedPassword = User::where('email', $request->email)->first()) {
            $login = Hash::check($request->password, $hashedPassword->password);
        }
        return $login;
    }

    public function getCredentialsOauth()
    {
        return [
            'client_id' => $this->auth_client_id,
            'client_secret' => $this->auth_client_secret
        ];
    }

    public function getToken($auth)
    {
        $client = new Client();
        try {
            $response = $client->post('http://webserver/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $auth['client_id'],
                    'client_secret' => $auth['client_secret'],
                    'username' => \Auth::user()->email,
                    'password' => base64_decode(\Session::get('password')),
                    'scope' => ''
                ],
            ]);
            
            return json_decode((string) $response->getBody(), true);
        } catch (\Throwable $th) {
            return false;
        }
    }

}
