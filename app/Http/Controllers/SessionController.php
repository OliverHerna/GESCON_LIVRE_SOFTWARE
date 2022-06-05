<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
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
        $events = Event::all();
        $articles = Article::all();
        return view('sessions.create')->with([
            'events' => $events,
            'articles' => $articles,
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
            $session = new Session();
            $event = Event::find($request->event);

            $session->begin_hour = $request->begin_hour;
            $session->end_hour = $request->end_hour;
            
            $session->event()->associate($event);
            
            $session->save();
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

    public function assignArticleView(Session $session){
        $articles = Article::where('distribution_date', '!=', NULL)->get();
        return view('sessions.assignArticle')->with([
            'session' => $session,
            'articles' => $articles,

        ]);
    }

    public function assignArticleToSession(Request $request){
        DB::beginTransaction();
        try{
            $article = Article::find($request->article);
            $article->presentation_hour_begin = $request->presentation_hour_begin;
            $article->presentation_hour_end =  $request->presentation_hour_begin;
            $article->save();
        
            $session = Session::find($request->session);


            $session->articles()->attach($article);


            $session->save();
            
            DB::commit();
        }catch(\Exception $e){
            return $e;
        }
        $articles = Article::where('distribution_date', '!=', NULL)->get();
        return view('sessions.assignArticle')->with([
            'session' => $session,
            'articles' => $articles,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
