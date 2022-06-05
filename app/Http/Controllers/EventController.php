<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('events.create')->with([
            'users' => $users,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $event = new Event();
            $event->name = $request->name;
            $event->description = $request->description;
            $event->event_date = $request->event_date;
            $event->save();
            DB::commit();
        }catch(\Exception $e){
            return $e;
        }

        $events = Event::all();
        $sessions = Session::all();
        return view('dashboard')->with([
            'events' => $events,
            'sessions' => $sessions,
        ]); 
    }

    public function assignManagerView(Event $event){
        $users = User::all();
        return view('events.assignManager')->with(
            [
                'event' => $event,
                'users' => $users,
            ]
        ); 
    }

    public function assignManager(Request $request){
        DB::beginTransaction();
        try{
            $event = Event::find($request->event);
            $user = User::find($request->user);
            $event->users()->attach($user);
            DB::commit();
        }catch(\Exception $e){
            return $e;
        }
        return 'Responsable Asignado Correctamente';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
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
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
