<?php

namespace App\Modules\Maintenance\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Modules\User\Models\User;
use App\Modules\Admin\Models\Admin;
use Validator;
use Session;
use Auth;

class MaintenanceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->join('user_type', 'users.user_type_id', '=', 'user_type.user_type_id')
            ->leftJoin('user_maintenance', 'user_maintenance.user_id', '=', 'users.id')
            ->select('users.id','user_type', 'user_name', 'flat_number', 'amount')
           // ->where(['is_deleted'=>2])
            //->whereIn('is_deleted',[1])
            ->where(['users.is_deleted'=>2])
            ->whereNotIn('users.user_type_id',[1])

            ->get();
        return view("Maintenance::index", ['users'=>$users]);
        //return view("Maintenance::index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Maintenance::user_maintenance" , ['success'=>''] ); 
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
