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
use App\Maintenance;
use Config;
use Crypt;
use App\Helpers\Helper;
use myhelper;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;


class UserController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
     /**
    * @DateOfCreation         30 aug 2018
    * @ShortDescription       Load the login view for user
    * @return                 View
    */
    public function index()
    {
        $id=  Auth::user()->id;

        return view('user.welcome')->with($id);
  // echo "user page";
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
return view('user.users',$data);
}
/**
* @DateOfCreation         27 Aug 2018
* @ShortDescription       Load user maintanence view with list of that user whoes log in
* @return                 View
*/
public function userrMaintenance($id, $user_id=Null)
{
$id=  Auth::user()->id;  
$maintenancelist  = new User();
$data['user_id'] = $user_id;
$data['user_maintenance'] = $maintenancelist->showUser($id);
return view('user.userMaintenance',$data)->with('no', 1);
}
/**
* @DateOfCreation         27 Aug 2018
* @ShortDescription       Register user from user side
* @return                 View
*/
public function register()
{
    return view('user.register');
}

}
