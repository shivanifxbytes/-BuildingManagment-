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
use App\Dashboard;
use Config;
use Crypt;
use App\Helpers\Helper;
use myhelper;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;
use Excel;

class DashboardController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->dashboardObj = new Dashboard();
    }

    /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load the dashboard view
    * @return                 View
    */
    public function index()
    {
        /**
        *@ShortDescription Blank array for the count for sending the array to the view.
        *
        * @var Array
        */
        $count = [];
        $count['users']  = $this->dashboardObj->countUsers();
        return view('admin.dashboard', compact('count'));
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
        $data['users'] = $this->dashboardObj->queryData();
        return view('admin.users', $data);
    }

    /**
    * @DateOfCreation         24 Aug 2018
    * @ShortDescription       Function run according to the parameter if $user_id is NUll
    *                         then it return add view If we get ID it will return edit view
    * @return                 View
    */
    public function getUser($user_id = null)
    {
        if (!empty($user_id)) {
            try {
                $user_id = Crypt::decrypt($user_id);


                $check = Admin::where('id', '=', $user_id)->count();
                
                if (is_int($user_id) && $check > 0) {
                    $data['user'] = Admin::find($user_id);
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
            'user_last_name'  => 'required|max:50',
            'owner'           => 'required|max:50',
            'tenant'          => 'required|max:50',
            'flat_number'     => 'required|max:50',
            'carpet_area'     => 'required|max:50',
        );

        if (empty($user_id)) {
            $rules = array(
            'user_email'      => 'required|string|email|max:255|unique:users',
            'password'        => 'required|string|min:6|confirmed',);
        }
        
        // set validator
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            // redirect our admin back to the form with the errors from the validator
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'user_first_name'   => $request->input('user_first_name'),
                'user_last_name'    => $request->input('user_last_name'),
                'owner'             => $request->input('owner'),
                'tenant'            => $request->input('tenant'),
                'flat_number'       => $request->input('flat_number'),
                'carpet_area'       => $request->input('carpet_area'),
                'user_status'       => Config::get('constants.ADMIN_ROLE'),
                'user_role_id'      => Config::get('constants.USER_ROLE')
            );

            if (empty($user_id)) {
                $requestData['user_email']    = $request->input('user_email');
                $requestData['password']      = bcrypt($request->input("password"));

                $user = Admin::create($requestData);
                
                //insert data in users table
                if ($user) {
                    return redirect('adminUser')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $user_id = Crypt::decrypt($user_id);

                if (is_int($user_id)) {
                    $user = Admin::where(array('id' => $user_id))->update($requestData);
                    return redirect('adminUser')->with('message', __('messages.Record_updated'));
                } else {
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
    public function deleteUser(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->input('id'));
            if (is_int($id)) {
                $Admin = Admin::findOrFail($id);
                if ($Admin->delete()) {
                    return Config::get('constants.OPERATION_CONFIRM');
                } else {
                    return Config::get('constants.OPERATION_FAIED');
                }
            } else {
                return Config::get('constants.ID_NOT_CORRECT');
            }
        } catch (DecryptException $e) {
            return Config::get('constants.ID_NOT_CORRECT');
        }
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Load user maintanence view with list of user whoes user id is equal to maintenance id
    * @return                 View
    */
    public function showMaintenance($id, $user_id=null)
    {
        $data['user_id'] = Crypt::decrypt($id);
        $data['user_maintenance'] = $this->dashboardObj->showUser($data['user_id']);
        return view('admin.userMaintenance', $data)->with('no', 1);
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Function run according to the parameter if $user_id is NUll
    *                         then it return add view
    * @return                 View
    */
    public function addMaintenance($id, $user_id)
    {
        $userName = Auth::user()->user_first_name;
        $user_id = Crypt::decrypt($user_id);
        $data['userName'] = $userName;
        return view('admin.addMaintenance', $data);
    }

    /**
    * @DateOfCreation         27 Aug 2018
    * @ShortDescription       Function run according to the parameter If we get ID it will return edit view
    * @return                 View
    */
    public function editMaintenance($id)
    {
        if (!empty($id)) {
            try {
                $id = Crypt::decrypt($id);
                $check = Maintenance::where('id', '=', $id)->count();
                if (is_int($id)) {
                    $user = Maintenance::find($id);
                    
                    return view('admin.editMaintenance', ['user'=>$user]);
                } else {
                    return redirect()->back()->withErrors(__('messages.Id_incorrect'));
                }
            } catch (DecryptException $e) {
                return view("admin.errors");
            }
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
    public function postMaintenence(Request $request, $id, $user_id = null)
    {
        $rules = array(
            'amount'         => 'required|max:50',
            'month'          => 'required|max:50',
            'pending_amount' => 'required|max:50',
            'extra_amount'   => 'required|max:50',
        );
        // set validator
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // redirect our admin back to the form with the errors from the validator
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                    'amount'         => $request->input('amount'),
                    'month'          => $request->input('month'),
                    'pending_amount' => $request->input('pending_amount'),
                    'extra_amount'   => $request->input('extra_amount'),
                    'user_status'    => $request->input('status')
                );
            if (empty($id)) {
                $requestData['user_id'] = Crypt::decrypt($user_id);
                $user = Maintenance::create($requestData);
                //insert data in users table
                if ($user) {
                    return redirect('adminUser')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $id = Crypt::decrypt($id);
            
                if (is_int($id)) {
                    $user = Maintenance::where(array('user_id' => $id))->update($requestData); //update data in users table
                    return redirect('adminUser')->with('message', __('messages.Record_updated'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            }
        }
    }

    /**
    * @DateOfCreation         22 March 2018
    * @ShortDescription       Distroy the session and Make the Auth Logout
    * @return                 Response
    */
    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function downloadExcel($type)
    {
        $data = Admin::get(['user_first_name','user_last_name','owner','tenant','carpet_area'])->toArray();
        $data = json_decode(json_encode($data), true);
        return Excel::create('user_list', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadMaintenanceExcel($type, $id)
    {
        $data['user_maintenance'] = $this->dashboardObj->showUser($id);
        $data = json_decode(json_encode($data['user_maintenance']), true);
        return Excel::create('user_maintenance', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
