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
use App\Transaction;
use Carbon;
use App\Flat;
use Exception;
use App\Monthlyexpenses;

class DashboardController extends Controller
{
    /**
     * @DateOfCreation      10-Oct-2018
     * @ShortDescription    Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->dashboardObj = new Dashboard();
        $this->userobj = new User();
    }

    /**
     * @DateOfCreation         23 Aug 2018
     * @ShortDescription       Load the dashboard view
     * @return                 View
     */
    public function index()
    {
        /**
         * @ShortDescription Blank array for the count for sending the array to the view.
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
                    $data['users'] = $this->dashboardObj->selectFlatType();
                    $data['user'] = $this->dashboardObj->queryData()->where('id', $user_id);
                    
                    return view('admin.editUser', $data);
                } else {
                    return redirect()->back()->withErrors(__('messages.Id_incorrect'));
                }
            } catch (DecryptException $e) {
                return view("admin.errors");
            }
        } else {
            $data['users'] = $this->dashboardObj->selectFlatType();
            return view('admin.addUser', $data);
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
            'owner'           => 'required|max:50',
            'owner_mobile_no' => 'required|regex:/[0-9]{10}/|digits:10',
            'flat_number'     => 'required|string|max:255',
            'carpet_area'     => 'required|max:50',
        );
        if (empty($user_id)) {
            $rules = array(
                'email'      => 'required|string|email|max:255|unique:users',
                'password'   => 'required|string|min:6|confirmed',);
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'name'             => $request->input('owner'),
                'mobile_number'    => $request->input('owner_mobile_no'),
                'user_role_id'     => 2
            );

            if (empty($user_id)) {
                $requestData['email']    = $request->input('email');
                $requestData['password'] = bcrypt($request->input("password"));
                $user = Admin::insertGetId($requestData);
                if ($user) {
                    $flatData = array(
                'flat_number'      => $request->input('flat_number'),
                'carpet_area'      => $request->input('carpet_area'),
                'owner_id'         => $user);
                }
                $flat =  Flat::insertGetId($flatData);
                if ($flat) {
                    return redirect('adminUser')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $user_id = Crypt::decrypt($user_id);
                if (is_int($user_id)) {
                    $flatData = array(
                'flat_number'      => $request->input('flat_number'),
                'carpet_area'      => $request->input('carpet_area'),
                );
                    $user = Admin::where(array('id' => $user_id))->update($requestData);
                    $flat =  Flat::where('owner_id', $user_id)->update($flatData);
                    return redirect('adminUser')->with('message', __('messages.Record_updated'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            }
        }
    }
    /**
    * @DateOfCreation         27 August 2018
    * @ShortDescription       Load user maintanence view with list of user when user id is equal to maintenance id
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
    * @ShortDescription       Load add maintenance view
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
                'user_status'    => $request->input('status'),
                'created_at'     => date('Y-m-d'),
                'updated_at'     => date('Y-m-d')
            );
            $user_id = Crypt::decrypt($user_id);
            $users = DB::table('user_maintenance')->select('user_id', 'month')
                ->where('user_id', '=', $user_id)
                ->where('month', '=', $requestData['month'])
                ->get()->toArray();
            if (count($users)>0) {
                return redirect()->back()->withInput()->withErrors(__('messages.already_paid '));
            } else {
                $requestData['user_id'] = $user_id;
                $user = Maintenance::create($requestData);
                return redirect()->route('showmaintenance', Crypt::encrypt($user_id))->with('message', __('messages.Record_added'));
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
    * @ShortDescription       This function handle the post request which get after submit
    *                         and function run according to the parameter if $user_id is NUll
    *                         then it will insert the value If we get ID it will update the value
    *                         according to the ID
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
    public function getMaintenanceMaster($id = null)
    {
        if (!empty($id)) {
            try {
                $flat_number = Crypt::decrypt($id);
                $check = Master::where('flat_number', '=', $flat_number)->count();
                if (is_int($flat_number) && $check > 0) {
                    $data['flats'] = Master::get()->where('flat_number', $flat_number);
                    return view('admin.editMaintenanceMaster', $data);
                } else {
                    return redirect()->back()->withErrors(__('messages.Id_incorrect'));
                }
            } catch (DecryptException $e) {
                return view("admin.errors");
            }
        } else {
            $data['users'] = $this->dashboardObj->selectFlatType();
            return view('admin.addMaintenanceMaster', $data);
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
    public function postMaintenanceMaster(Request $request, $id = null)
    {
        $rules = array(
            'maintenance_amount' => 'required|max:50',
            'flat_number'   => 'max:10'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'maintenance_amount' => $request->input('maintenance_amount'),
            );
            $insertData = array(
                'maintenance_amount' => $request->input('maintenance_amount'),
                'flat_number'=> $request->input('flat_number')
            );
            if (empty($id)) {
                $user = Master::create($insertData);
                if ($user) {
                    return redirect('maintenanceMaster')->with('message', __('messages.Record_added'));
                } else {
                    return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
                }
            } else {
                $flat_number = Crypt::decrypt($id);
                if (is_int($flat_number)) {
                    $user = Master::where(array('flat_number' => $flat_number))->update($requestData);
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
            'flat_type'   => 'required|max:50',
            'flat_number' => 'required|string',
        );
        // set validator
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // redirect our admin back to the form with the errors from the validator
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $requestData = array(
                'flat_type'    => $request->input('flat_type'),
                'flat_number'    => $request->input('flat_number'),
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
    /**
     * @DateOfCreation         27 August 2018
     * @ShortDescription       Get the ID from the ajax and pass
     *  it to the function to delete it
     * @return                 Response
     */
    public function deleteUser(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->input('id'));
            if (is_int($id)) {
                $user = $this->userobj->retrieveRecordOrTerminate($id);
                if ($user->delete()) {
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
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load the maintenance transaction form view
    * @return                 View
    */
    public function monthViewList()
    {
        return view('admin.monthviewlist');
    }
    /**
    * @DateOfCreation         23 Aug 2018
    * @ShortDescription       Load the maintenance transaction form view
    * @return                 View
    */
    public function showMaintenanceTransactionList()
    {
        $this->transactionobj = new Transaction();
        $data['flats'] = $this->transactionobj->selectAllTransaction();
        return view('admin.showMaintenanceTransactionList', $data);
    }
    /**
     * @DateOfCreation         28 September 2018s
     * @ShortDescription       Get the ID from the ajax and pass it to the function to save it
     * @return                 Response
     */
    public function paidmaintenanceTransaction(Request $request)
    {
        $test = new Transaction();
        $input = $request->all();
        $test->flat_number=$input['flatNumber'];
        $test->amount=$input['amount'];
        $test->pending_amount=$input['pendingAmount'];
        $test->reason_pending_amount=$input['reasonPendingAmount'];
        $test->extra_amount=$input['extraAmount'];
        $test->reason_extra_amount=$input['reasonExtraAmount'];
        $test->month =date("Y-m-d", strtotime($input['date']));
        $test->save();
        return response()->json(['success'=>'Paid']);
    }
    
    /**
     * @DateOfCreation         23 Aug 2018
     * @ShortDescription       Load the monthly Expences form view
     * @return                 View
     */
    public function monthlyExpences()
    {
        return view('admin.monthlyExpenses');
    }
    /**
    * @DateOfCreation         27 August 2018
    * @ShortDescription       Load the add Maintenance Transaction form view
    * @return                 View
    */
    public function addMaintenanceTransaction()
    {
        $data['flats'] = $this->dashboardObj->getFlatDetail();

        return view('admin.maintenanceTransaction', $data);
    }
    /**
     * [addMonthlyExpense description]    {
     */
    public function addMonthlyExpense()
    {
        return view('admin.addMonthlyExpenses');
    }

    /**
     * [addMoreMonthlyExpense description]
     * @param Request $request [description]
     */
    public function addMoreMonthlyExpense(Request $request)
    {
        $datainsert = [];
        $data       = $request->all();
        $date       = $data['date'];
        $title      = $data['title'];
        $amount     = $data['amount'];
        $cardNumber = $data['card_number'];
        $paidBy = $data['paid_by'];
        foreach ($title as $key => $value) {
            $date1 = isset($date[$key])?date("Y-m-d", strtotime($date[$key])):date("Y-m-d", strtotime($date['0']));
            array_push($datainsert, array(
                    'month'      => isset($date[$key])?date("Y-m-d", strtotime($date[$key])):date("Y-m-d", strtotime($date['0'])),
                    'title'      =>$value,
                    'amount'     =>$amount[$key],
                    'paid_by'    =>$paidBy[$key],
                    'reference_number'=>$cardNumber[$key],                  
            ));
        }
        Monthlyexpenses::insert($datainsert);
        $amount = DB::table('monthly_expenses')->select('amount', 'paid_by')->where('month', $date1)->get();
        $cash_amount =0;
        $cheque_amount =0;
        foreach ($amount as $key => $value) {
            $paid_by = $amount[$key]->paid_by;
            if ($paid_by == 'Cash') {
                $cash_amount += $amount[$key]->amount;
            } else {
                $cheque_amount += $amount[$key]->amount;
            }
        }
        $total = $cheque_amount+$cash_amount;
        return response()->json(['success'=>'done','cash'=>$cash_amount,'cheque'=>$cheque_amount,'total'=>$total]);
    }

    /**
     * [changeflattype description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function changeflattype(Request $request)
    {
        $id = $request->id;
        $result = $this->dashboardObj->getFlatTypeById($id);
        return $result;
    }

    /**
     * [showMonthlyTransaction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showMonthlyTransaction(Request $request)
    {
        $year   =  $request->year;
        $month  =  $request->month;
        $result = $this->dashboardObj->getTransactionByMonthAndYear($year,$month);
        return $result;
    }
    /**
     * [showMonthlyTransaction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showMonthlyExpenses(Request $request)
    {
        $year   =  $request->year;
        $month  =  $request->month;
        $result = $this->dashboardObj->getExpensesByMonthAndYear($year,$month);
        return $result;
    }
}
