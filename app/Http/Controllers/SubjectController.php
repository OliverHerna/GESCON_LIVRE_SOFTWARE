<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubjectRequest;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Only get a kind of users
        $users = User::all();
        $subjects = Subject::all();
        return view('subjects.index')->with([
            'subjects' => $subjects,
            'users' => $users,
        ]);
    }

    public function subjectUserAssigment(Request $request){
        DB::beginTransaction();
        try{
            $user = User::find($request->user);
            $subject = Subject::find($request->subject);
            $user->subjects()->attach($subject);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            echo $e;
            //abort('500');
        }
        return 'Se asigno correctamente el rol';
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
        DB::beginTransaction();
        try{
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return (string)$e;
        }
        return 'Se agrego correctamente';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
