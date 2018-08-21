<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Modules\User\Models\User;
use App\Modules\Admin\Models\Admin;
use Validator;
use Session;
use Auth;
class AdminController extends Controller
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
        return view("Admin::index", ['users'=>$users]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin::create_user_details" , ['success'=>'', 'errors' => ''] ); 
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

        $validator = Validator::make($request->all(), [
             'user_name' => 'required|string|max:255', 
                'owner' => 'required',
                'tenant' => 'required',
                'flat_number' => 'required',
                'user_email' => 'required|string|email|max:255|unique:users',
                'user_password' => 'required|string|min:6|confirmed',
                'carpet_area' => 'required',
                'super_built_up_area' => 'required'
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();

            return view("Admin::create_user_details" , ['success'=>'', 'errors' => $errors] ); 
            //return redirect('admin/create')->with('errors', $errors);

        } else {
            $user_name = request()->input('user_name');
            $owner = request()->input('owner');
            $tenant = request()->input('tenant');
            $flat_number = request()->input('flat_number');
             $user_email = request()->input('user_email');
             $user_password = request()->input('user_password');
            $carpet_area = request()->input('carpet_area');
            $super_built_up_area = request()->input('super_built_up_area');         
            $insert_array = ['owner' => $owner,
                              'tenant' => $tenant,
                              'flat_number'=>$flat_number,
                              'user_email'=>$user_email,
                              'user_password'=>Hash::make($user_password),
                              'carpet_area'=>$carpet_area,
                              'super_built_up_area'=>$super_built_up_area,
                              'user_name'=>$user_name
                             ];

       // User::update('users', $update_array, ['id'=>$user->id]);
        
        User::insert($insert_array,'users');
         return redirect('admins.create')->with('success', 'User created successfully.');  
        }
            
       // return redirect('users');
    }
    /*
	The easiest way to insert multiple tables from one form
	public function store(Request $request)
  {
  $detail = new detail();
  $detail->name = $request->input("name");
  $detail->age = $request->input("age");
  $detail->sex = $request->input("sex");
  $detail->save();

 $location = new location();
 $location->detail_id = $detail->id;
 $location->location = $request->input("location");
 $location->save();
 }

*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = DB::table('users')
            ->join('user_type', 'users.user_type_id', '=', 'user_type.user_type_id')
            ->leftJoin('user_maintenance', 'user_maintenance.user_id', '=', 'users.id')
            ->select('user_type', 'user_name', 'flat_number', 'amount')
            ->where(['users.is_deleted'=>2])
            ->where('users.id', $id)
            ->get();
        return view("Admin::show", ['users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = DB::table('users')->select('id', 'owner','tenant', 'flat_number')->where(['is_deleted'=>2, 'product_id'=>$id])->get();
    $user_maintenance = DB::table('user_maintenance')->select('user_id', 'amount','month')->where(['is_deleted'=>2])->get();
    return view('Admin::edit', ['user_maintenance' => $user_maintenance,'users'=>$users]);
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
     echo "delete".$id;
    DB::table('users')->where('id', $id)->update(['is_deleted' => 1 ]);

    return redirect()->route('admin.index')->with('success', 'user deleted successfully.');
    }
}
