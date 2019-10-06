<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EventController extends Controller
{
    private $new_key;
    private $price = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minutes = \Carbon\Carbon::now()->addMinutes(10);
        $events = \Cache::remember('api::events', $minutes, function () {
            return Event::all();
        });

        return $events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Cache::forget('api::events');
        return Event::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return 'one_event';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        return 'update_event';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        return 'delete_event';
    }

    public function eventsCache()
    {
        $events = Event::select('event')->distinct('event')->limit('50')->get();
        
        return $events;
    }

    public function likeEvents(Request $request)
    {
        $string = $request->string . "%";
        $events = Event::select('event')->where('event', 'like', $string)->get();
        return response()->json([
            'all' => $events,
        ]);
    }

    public function getEventsJson()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://storage.googleapis.com/dito-questions/events.json');
        $response = $request->getBody()->getContents();

        $events_json = json_decode((string) $response, true);

        $new_keys = [];
        $array_new = false;
        $price = 0;
        $product_name = "";
        $store_name = "";
        $i_product = 0;
        $product = 0;
        foreach ($events_json["events"] as $key => $event) {
            foreach ($event["custom_data"] as $i => $value) {
                if($value["key"] == "transaction_id")
                {
                    $new_key = $value["value"];
                    if (!in_array($new_key, $new_keys) && !empty($new_keys)) {
                        $array_new = true;
                    }
                    
                    if(in_array($new_key, $new_keys)){
                        $events_json["events"][$new_key]["store_name"] = $store_name;
                        $events_json["events"][$new_key]["revenue"] = $events_json["events"][$new_key]["revenue"] += $price;
                        
                    }else{
                        $events_json["events"][$new_key] = $events_json["events"][$key];
                        $events_json["events"][$new_key] = [
                            "timestamp" => $events_json["events"][$new_key]["timestamp"],
                            "revenue" => 0,
                            "transaction_id" => $value["value"],
                            "store_name" => $store_name,
                            "products" => [
                                [
                                    "name" => $product_name,
                                    "price" => $price
                                ]
                            ]
                        ];
                        if($array_new){
                            $product = 0;
                            $i_product = 0;
                        }
                        if($events_json["events"][$new_key]["products"][0]["name"] != "" || $events_json["events"][$new_key]["products"][0]["name"] != 0){
                            $product++;
                        }
                        unset($events_json["events"][$key]);
                        $new_keys[] = $value["value"];
                    }
                    
                    
                }
                if($value["key"] == "product_price")
                {
                    if($array_new && !empty($new_key)){
                        if($product%2 == 0 && $product!=0){
                            $i_product++;
                        }
                        $events_json["events"][$new_key]["revenue"] = $events_json["events"][$new_key]["revenue"] + $value["value"];
                        $events_json["events"][$new_key]["products"][$i_product]["price"] =  $value["value"];
                        $price = 0;
                        $product++;
                    }
                    else if (isset($new_key) && in_array($new_key, $new_keys)) {
                        if ($product % 2 == 0 && $product != 0) {
                            $i_product++;
                        }
                        $events_json["events"][$new_key]["revenue"] = $events_json["events"][$new_key]["revenue"] + $value["value"];
                        $events_json["events"][$new_key]["products"][$i_product]["price"] = $value["value"];
                        $price = 0;
                        $product++;
                    } else {
                        $price = $value["value"];
                    }
                }
                if($value["key"] == "product_name")
                {
                    
                    if($array_new && !empty($new_key)){
                        if($product % 2 == 0 && $product != 0){
                            $i_product++;
                        }
                        
                        $events_json["events"][$new_key]["products"][$i_product]["name"] = $value["value"];
                        $product_name = "";
                        $product++;
                    }
                    else if (isset($new_key) && in_array($new_key, $new_keys)) {
                        if($product % 2 == 0 && $product != 0){
                            $i_product++;
                        }
                        $events_json["events"][$new_key]["products"][$i_product]["name"] = $value["value"];
                        $product_name = "";
                        $product++;
                    } else {
                        $product_name = $value["value"];
                    }
                }
                if ($value["key"] == "store_name") {
                    if ($array_new) {
                        $events_json["events"][$new_key]["store_name"] = $value["value"];
                        $store_name = "";
                    } else {
                        $store_name = $value["value"];
                    }
                }
                
            }
            unset($events_json["events"][$key]);
        }
        return $events_json["events"];

    }
}
