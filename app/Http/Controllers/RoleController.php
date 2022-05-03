<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleToUser;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::all();   
        return view('roles.index')->with([
            'roles' => $roles,
            'users' => $users 
        ]);
    }

    public function roleUserAssigment(AssignRoleToUser $request){
        DB::beginTransaction();
        try{
            $user = User::find($request->user);
            $role = Role::find($request->role);
            $user->roles()->attach($role);
            $role->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            echo $e;
            //abort('500');
        }
        return redirect()->route('roles.index')->with([
            'success' => 'Se ha asignado correctamente un rol'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
