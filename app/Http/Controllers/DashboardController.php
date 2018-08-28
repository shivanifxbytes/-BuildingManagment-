<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use App\User;
use App\Dashboard;
use Config;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DashboardController extends Controller
{
/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{

}
/**
* @DateOfCreation         23 Aug 2018
* @ShortDescription       Load the dashboard view 
* @return                 View
*/
public function index(){
/**
*@ShortDescription Blank array for the count for sending the array to the view.
*
* @var Array
*/
$count = [];
$usercount  = new Dashboard();
$count['users']  = $usercount->countUsers();
return view('admin.dashboard',compact('count'));
}

/**
* @DateOfCreation         23 Aug 2018
* @ShortDescription       Load users view with list of all users 
* @return                 View
*/
public function users()
{
/**
*@ShortDescription Blank array for the data for sending the array to the view.
*
* @var Array
*/
$userlist  = new Dashboard();
$data['users'] = $userlist->queryData();
return view('admin.users',$data);

}
/**
* @DateOfCreation         24 Aug 2018
* @ShortDescription       Function run according to the parameter if $user_id is NUll 
*                          then it return add view If we get ID it will return edit view 
* @return                 View
*/
public function getUser($user_id = NULL) {
if (!empty($user_id)) {
    try {
        $id = Crypt::decrypt($user_id);
        $check = Admin::where('id', '=', $id)->count();
        if (is_int($id) && $check > 0) {
            $data['user'] = Admin::find($id);
            return view('admin.editUser', $data);
        } else {
            return redirect()->back()->withErrors(__('messages.Id_incorrect'));
        }
    } catch (DecryptException $e) {
        return view("admin.errors");
    }
} else {
    return view('admin.addUser');
}
}
/**
* @DateOfCreation         24 Aug 2018
* @ShortDescription       This function handle the post request which get after submit the 
*                         and function run according to the parameter if $user_id is NUll 
*                         then it will insert the value If we get ID it will update the value
*                         according to the ID 
* @return                 Response
*/
public function postUser(Request $request, $user_id = null)
{   
$rules = array(
    'user_first_name' => 'required|max:50', 
    'user_last_name' => 'required|max:50', 
    'user_email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:6|confirmed',
);
// set validator
$validator = Validator::make($request->all(), $rules);
if ($validator->fails()) {
    
    // redirect our admin back to the form with the errors from the validator
    return redirect()->back()->withInput()->withErrors($validator->errors());
}
else
{
    if(empty($user_id)){    
        //final array of the data from the request
        $insertData = array(
            'user_first_name' => $request->input('user_first_name'), 
            'user_last_name' => $request->input('user_last_name'), 
            'user_email'=> $request->input('user_email'),
            'password' => bcrypt($request->input("password")),
            'user_status' => $request->input('status'),
            'user_role_id' => Config::get('constants.ADMIN_ROLE')
        );

        $user = Admin::create($insertData); 
        
        //insert data in users table
        if($user){
            return redirect('adminUser')->with('message',__('messages.Record_added'));
        }else{
            return redirect()->back()->withInput()->withErrors(__('messages.try_again')); 
        }
    }else{
        $id = Crypt::decrypt($user_id);
        
        //final array of the data from the request
        $updateData = array(
            'user_first_name' => $request->input('user_first_name'), 
            'user_last_name' => $request->input('user_last_name'), 
            'user_status' => $request->input('status')
        );
        if(is_int($id)){
                $user = Admin::where(array('id' => $id))->update($updateData); 
                return redirect('adminUser')->with('message',__('messages.Record_updated'));
        }else{
            return redirect()->back()->withInput()->withErrors(__('messages.try_again')); 
        }

    }   
}
}
/**
* @DateOfCreation         24 Aug 2018
* @ShortDescription       Get the ID from the ajax and pass it to the function to delete it 
* @return                 Response
*/
public function deleteBlog(Request $request)
{
    try {
        $id = Crypt::decrypt($request->input('id'));
        if(is_int($id)){
            $Admin = Admin::findOrFail($id);

            if($Admin->delete()){
                return Config::get('constants.OPERATION_CONFIRM');
            }else{
                return Config::get('constants.OPERATION_FAIED');
            }
        }else{
            return Config::get('constants.ID_NOT_CORRECT');
        } 
    }
    catch (DecryptException $e) {
        return Config::get('constants.ID_NOT_CORRECT');
    }
}
/**
* @DateOfCreation         27 Aug 2018
* @ShortDescription       Load user maintanence view with list of user whoes user id is equal to maintenance id
* @return                 View
*/
public function showMaintenance($id)
{
$id = Crypt::decrypt($id);
$maintenancelist  = new Dashboard();
$data['user_id'] = $id;
$data['user_maintenance'] = $maintenancelist->showUser($id);
return view('admin.userMaintenance',$data);
}
/**
* @DateOfCreation         27 Aug 2018
* @ShortDescription       Function run according to the parameter if $user_id is NUll 
*                         then it return add view If we get ID it will return edit view 
* @return                 View
*/
public function getMaintenance($id, $user_id=Null)
{
if (!empty($id)) {
    try {
        $id = Crypt::decrypt($id);
        $check = User::where('id', '=', $id)->count();
        if (is_int($id) && $check > 0) {
            $data['user_maintenance'] = User::find($id);
            return view('admin.editMaintenance', $data);
        } else {
            return redirect()->back()->withErrors(__('messages.Id_incorrect'));
        }
    } catch (DecryptException $e) {
        return view("admin.errors");
    }
} else {
    return view('admin.addMaintenance');
}

}
/**
* @DateOfCreation         24 Aug 2018
* @ShortDescription       This function handle the post request which get after submit 
*                         and function run according to the parameter if $user_id is NUll 
*                         then it will insert the value If we get ID it will update the value
*                         according to the ID 
* @return                 Response
*/
public function postMaintenence(Request $request, $user_id = null)
{
$rules = array(
    'amount' => 'required|max:50', 
    'month' => 'required|max:50', 
    'pending_amount' => 'required|max:50',
    'extra_amount' => 'required|max:50',
);
// set validator
$validator = Validator::make($request->all(), $rules);
if ($validator->fails()) {
   // redirect our admin back to the form with the errors from the validator
    return redirect()->back()->withInput()->withErrors($validator->errors());
}
else
{
    if(empty($user_id)){    
    //final array of the data from the request
        $insertData = array(
            'amount' => $request->input('amount'), 
            'month' => $request->input('month'), 
            'pending_amount'=> $request->input('pending_amount'),
            'extra_amount'=> $request->input('extra_amount'),
            'user_status' => $request->input('status'),
        );
       
        $user = User::create($insertData); 
        //insert data in users table
        if($user)
        {
            return redirect('adminUser')->with('message',__('messages.Record_added'));
        }
        else
        {
            return redirect()->back()->withInput()->withErrors(__('messages.try_again')); 
        }
    }
    else
    {
        $id = Crypt::decrypt($user_id);
        //final array of the data from the request
        $updateData = array(
            'amount' => $request->input('amount'), 
            'month' => $request->input('month'), 
            'pending_amount'=> $request->input('pending_amount'),
            'extra_amount'=> $request->input('extra_amount'),
            'user_status' => $request->input('status'),
        );


        if(is_int($id))
        {
$user = User::where(array('user_id' => $id))->update($updateData); //update data in users table
return redirect('adminUser')->with('message',__('messages.Record_updated'));
}
else
{
return redirect()->back()->withInput()->withErrors(__('messages.try_again')); 
}

}   
}

}
}
