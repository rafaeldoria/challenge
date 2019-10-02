<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\OauthClient;
use App\Models\User;
use Laravel\Passport\Passport;

class OauthClientController extends Controller
{
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
        if ($hashedPassword = User::where('email', $request->email)->first()->password) {
            $login = Hash::check($request->password, $hashedPassword);
        }
        return $login;
    }

}
