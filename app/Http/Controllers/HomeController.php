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
        $this->request->session()->put('eventscache', (new EventController)->eventsCache());
        return view('home', ["events" => $events_json]);
    }

    public function getLikeEvents(Request $request)
    {
        $client = new Client();
        $token = $request->session()->get('authtoken')['access_token'];
        
        try {
            $response = $client->post('http://webserver/api/v1/likeEvents', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer {$token}",
                ],
                'form_params' => [
                    'string' =>  $request->str,
                ]
            ]);
            
            return json_decode((string) $response->getBody(), true);
        } catch (RequestException $e) { } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
}
