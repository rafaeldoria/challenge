<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventTransformer;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minutes = \Carbon\Carbon::now()->addMinutes(10);
        $events = \Cache::remember('api::events', $minutes, function () {
            return json_encode(Event::select('event')->distinct('event')->limit('50')->get());
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

    public function getEventsJson()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://storage.googleapis.com/dito-questions/events.json');
        $response = $request->getBody()->getContents();

        $events_json = json_decode((string) $response, true);

        $events = (new EventTransformer)->eventTransformer($events_json);

        return $events;

    }
}
