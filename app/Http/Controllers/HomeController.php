<?php

namespace App\Http\Controllers;

use App\Models\OauthClient;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

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
        $events_json = (new EventController)->getEventsJson();
        $events_cache = $this->getCacheEvents();
        return view('home', ["events" => $events_json, "events_cache" => $events_cache]);
    }

    public function getCacheEvents()
    {
        $client = new Client();
        $token = $this->request->session()->get('authtoken')['access_token'];

        try {
            $response = $client->get('http://webserver/api/v1/events', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer {$token}",
                ],
            ]);

            return $response->getBody();
        } catch (RequestException $e) { } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
}
