<?php

namespace App\Modules\Maintenance\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Modules\User\Models\User;
use App\Modules\Admin\Models\Admin;
use App\Modules\Maintenance\Models\Maintenance;
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
        return view("Maintenance::user_maintenance" , ['success'=>'' , 'errors' => ''] ); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        print_r($user);
        die();

        $validator = Validator::make($request->all(), [
             'month' => 'required|string|max:255', 
                'amount' => 'required',
                'painding_amount' => 'required',
                'extra_amount' => 'required',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();

            return view("Maintenance::user_maintenance" , ['success'=>'', 'errors' => $errors] ); 
            //return redirect('admin/create')->with('errors', $errors);

        } else {
            $month = request()->input('month');
            $amount = request()->input('amount');
           
            $painding_amount = request()->input('painding_amount');
             $extra_amount = request()->input('extra_amount');
                    
            $insert_array = ['month' => $month,
                              'amount' => $amount,
                              'painding_amount'=>$painding_amount,
                              'extra_amount'=>$extra_amount
                             
                             ];

       // User::update('users', $update_array, ['id'=>$user->id]);
        
        Maintenance::insert($insert_array,'user_maintenance');
         return redirect('Mmintenance.create')->with('success', 'User Maintenance created successfully.');  
        }
            
       // return redirect('users');
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
