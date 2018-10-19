<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Config;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @DateOfCreation     10 Oct 2018
     * @ShortDescription   Create a new authentication controller instance to check user is admin or not.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
    * @DateOfCreation         22 aug 2018
    * @ShortDescription       Load the login view for admin
    * @return                 View
    */
    public function getLogin()
    {

        if (isset(auth()->user()->user_role_id) && auth()->user()->user_role_id == 1) {
            return redirect()->route('dashboard');
        }
        return view('admin.login');
    }

    /**
    * @DateOfCreation         22 aug 2018
    * @ShortDescription       login user
    * @return                 result
    */
    public function postLogin(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required'
        );
        // set validator
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            // Get our login input
            $inputData = array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
            );
            if (Auth::attempt($inputData)) {
                $role_id =  Auth::user()->user_role_id;

                if ($role_id == Config::get('constants.ADMIN_ROLE')) {
                    return redirect("/dashboard")->with(array("message"=>__('messages.login_success')));
                } else {
                    return redirect("/welcome")->with(array("message"=>__('messages.login_success')))->with($role_id);
                }
            } else {
                //Check Email exist in the database or not
                if (Admin::where(
                        'email',
                    '=',
                    $inputData['email']
                )->first()) {
                    $validator->getMessageBag()->add('password', __('messages.wrong_password'));
                } else {
                    $validator->getMessageBag()->add('email', __('messages.account_not_exist'));
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }
}
