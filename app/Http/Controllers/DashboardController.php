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
use App\Master;

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
            'flat_type'       => 'required|max:50',
            'flat_number'     => 'required|max:50',
            'carpet_area'     => 'required|max:50',
        );
        if (empty($user_id)) {
            $rules = array(
                'user_email'      => 'required|string|email|max:255|unique:users',
                'password'        => 'required|string|min:6|confirmed',);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'user_first_name'   => $request->input('user_first_name'),
                'user_last_name'    => $request->input('user_last_name'),
                'owner'             => $request->input('owner'),
                'flat_type'         => $request->input('flat_type'),
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
    * @DateOfCreation         27 August 2018
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
    * @DateOfCreation         27 August 2018
    * @ShortDescription       Function run according to the parameter if $user_id is NUll
    *                         then it return add view
    * @return                 View
    */
    public function addMaintenance($id, $user_id)
    {
        $user_id = Crypt::decrypt($user_id);
        return view('admin.addMaintenance');
    }

    /**
    * @DateOfCreation         27 August 2018
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
    * @DateOfCreation         24 August 2018
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
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
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

                $user = Maintenance::where('month', $requestData['month'])->where('user_id', '=', $user_id)->get();
                if (count($user)>0) {
                    return redirect()->back()->withInput()->withErrors(__('messages.already_paid '));
                } else {
                    
                    $requestData['user_id'] = Crypt::decrypt($user_id);
                    $user = Maintenance::create($requestData);
                    
                }
                if ($user) {
                    return redirect()->route('showmaintenance', $user_id)->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $id = Crypt::encrypt($id);
                if (is_int($id)) {
                    $user = Maintenance::where(array('user_id' => $user_id))->update($requestData);
                    return redirect()->route('showmaintenance', $user_id)->with('message', __('messages.Record_updated'));
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
    * @DateOfCreation         04 September 2018
    * @ShortDescription       Display a listing of the resource.
    * @return                 Response
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
    * @DateOfCreation         04 September 2018
    * @ShortDescription       Display a listing of the resource.
    * @return                 Response
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

    /**
    * @DateOfCreation         05 September 2018
    * @ShortDescription       Display a listing of the resource.
    * @return                 Response
    */
    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        $i = 0;
        $array = [];
        if ($data->count()) {
            foreach ($data as $key => $value) {
                $arr = [
                    'user_id'        => $value->user_id,
                    'user_status'    => $value->user_status,
                    'amount'         => $value->amount,
                    'month'          => $value->month,
                    'user_status'    => Config::get('constants.ADMIN_ROLE'),
                    'pending_amount' => $value->pending_amount,
                    'extra_amount'   => $value->extra_amount,
                    'flat_number'    => $value->flat_number
                ];
                if (!empty($arr)) {
                    $maintenance_records = Maintenance::selectMaintenance($value->user_id);
                    if (count($maintenance_records) == 0) {
                        Maintenance::insert($arr);
                    } else {
                        $j = $i+1;
                        $string = "On Excel Record Number ".$j." For User ID ".$value->user_id."month".$value->month."flat number".$value->flat_number."Already paid";
                        array_push($array, $string);
                    }
                }
                $i++;
            }
        }
        $import_success = 'File Imported And Insert Record successfully.';
        return back()->with(['import_success'=>$import_success,'error_array'=>$array]);
    }

    /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load maintenance master view with list of all maintenance
    * @return                 View
    */
    public function maintenanceMaster()
    {
        $data['users'] = $this->dashboardObj->selectMaintenance();
        return view('admin.maintenanceMaster', $data);
    }

    /**
    * @DateOfCreation         19 September 2018
    * @ShortDescription       Function run according to the parameter If we get ID it will return edit view
    * @return                 View
    */
    public function getMaintenanceMaster($user_id = null)
    {
        if (!empty($user_id)) {
            try {
                $user_id = Crypt::decrypt($user_id);
                $check = Master::where('id', '=', $user_id)->count();
                if (is_int($user_id) && $check > 0) {
                    $data['user'] = Master::find($user_id)->toArray();
                    return view('admin.editMaintenanceMaster', $data);
                } else {
                    return redirect()->back()->withErrors(__('messages.Id_incorrect'));
                }
            } catch (DecryptException $e) {
                return view("admin.errors");
            }
        } else {
            return view('admin.addMaintenanceMaster');
        }
    }

    /**
     * @DateOfCreation         19 September 2018
     * @ShortDescription       This function handle the post request which get after submit
     *                         and function run according to the parameter if $user_id is NUll
     *                         then it will insert the value If we get ID it will update the value
     *                         according to the ID
     * @return                 Response
     */
    public function postMaintenanceMaster(Request $request, $user_id = null)
    {
        $rules = array(
            'maintenance_amount' => 'required|max:50',
            'flat_type'  => 'required|max:50',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'maintenance_amount'   => $request->input('maintenance_amount'),
                'flat_type'    => $request->input('flat_type'),
            );
            if (empty($user_id)) {
                $user = Master::create($requestData);
                if ($user) {
                    return redirect('maintenanceMaster')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $user_id = Crypt::decrypt($user_id);
                if (is_int($user_id)) {
                    $user = Master::where(array('id' => $user_id))->update($requestData);
                    return redirect('maintenanceMaster')->with('message', __('messages.Record_updated'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            }
        }
    }

    /**
    * @DateOfCreation         19 September 2018
    * @ShortDescription       Function run according to the parameter If we get ID it will return deteled row
    * @return                 result
    */
    public function deleteMaintenanceMastere($user_id = null)
    {
        $user_id = Crypt::decrypt($user_id);
        DB::table('maintenance_master')->where('id', '=', $user_id)->delete();
        return redirect('maintenanceMaster')->with('message', __('messages.Record_delete'));
    }
 
     /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load flat type view with list of all flats
    * @return                 View
    */
    public function flatType()
    {
        $data['users'] = $this->dashboardObj->selectFlatType();
        return view('admin.flatType', $data);
    }

    /**
    * @DateOfCreation         19 September 2018
    * @ShortDescription       Function run according to the parameter If we get ID it will return edit view
    * @return                 View
    */
    public function getFlatType($user_id = null)
    {
        $this->dashboardObj = new Master();
        if (!empty($user_id)) {
            try {
                $user_id = Crypt::decrypt($user_id);
                $check= $this->dashboardObj->getFlatId($user_id);
                //$check = Master::where('id', '=', $user_id)->count();
                if (is_int($user_id) && $check > 0) {
                    $data['user'] = $this->dashboardObj->findFlatId($user_id);
                    return view('admin.editFlatType', $data);
                } else {
                    return redirect()->back()->withErrors(__('messages.Id_incorrect'));
                }
            } catch (DecryptException $e) {
                return view("admin.errors");
            }
        } else {
            return view('admin.addFlatType');
        }
    }

    /**
     * @DateOfCreation         19 September 2018
     * @ShortDescription       This function handle the post request which get after submit
     *                         and function run according to the parameter if $user_id is NUll
     *                         then it will insert the value If we get ID it will update the value
     *                         according to the ID
     * @return                 Response
     */
    public function postFlatType(Request $request, $user_id = null)
    {
        $rules = array(
            'flat_type'  => 'required|max:50',
        );
        // set validator
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // redirect our admin back to the form with the errors from the validator
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'flat_type'    => $request->input('flat_type'),
                'created_at'   => date('Y-m-d H-i-s')
            );
            if (empty($user_id)) {
                $user = Master::insert('flat_type', $requestData);
                //insert data in users table
                if ($user) {
                    return redirect('flatType')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $user_id = Crypt::decrypt($user_id);
                if (is_int($user_id)) {
                    $user = Master::where(array('id' => $user_id))->update($requestData);
                    return redirect('flatType')->with('message', __('messages.Record_updated'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            }
        }
    }

    /**
    * @DateOfCreation         19 September 2018
    * @ShortDescription       Function run according to the parameter If we get ID it will return deteled row
    * @return                 result
    */
    public function deleteFlatType($user_id = null)
    {
        $user_id = Crypt::decrypt($user_id);
        DB::table('flat_type')->where('id', '=', $user_id)->delete();
        return redirect('flatType')->with('message', __('messages.Record_delete'));
    }
}
