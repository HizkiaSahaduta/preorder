<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class RegisteredCustController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $salesid = Session::get('SALESID');
        $groupid = Session::get('GROUPID');

        switch ($groupid) {

            case "SALES":

                $listsales = DB::table('salesman')
                                ->select('salesman_id', 'salesman_name')
                                ->where('salesman_id', '=', $salesid)
                                //->where('active_flag', '=', 'Y')
                                ->get();

                return view('layouts.RegisteredCust',['listsales' => $listsales]);
            break;

            case "DEVELOPMENT":

                $listsales = DB::table('salesman')
                                ->select('salesman_id', 'salesman_name')
                                ->where('active_flag', '=', 'Y')
                                ->orWhere('salesman_id', '=',  'S009' )
                                ->orderBy('salesman_name', 'ASC')
                                ->get();


                return view('layouts.RegisteredCust',['listsales' => $listsales]);
            break;

            case "MARKETING MANAGEMENT":

                $listsales = DB::table('salesman')
                                ->select('salesman_id', 'salesman_name')
                                ->where('active_flag', '=', 'Y')
                                ->orWhere('salesman_id', '=',  'S009' )
                                ->orderBy('salesman_name', 'ASC')
                                ->get();


                return view('layouts.RegisteredCust',['listsales' => $listsales]);
            break;

            default:
                return redirect('home')->with("alert", "You are not allowed to view this page");
        }

    }

    public function listRegisteredUser ($id) {


        $salesid = Session::get('SALESID');
        $groupid = Session::get('GROUPID');


        if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT') {  

            if ($id != 'undefined') {
                $where = " where b.var_id = 'CUSTID' and c.salesman_id = '$id'";
            }

            else {
                $where = " where b.var_id = 'CUSTID'";
            }

            $data = DB::select(DB::raw("SELECT a.user_id2, a.name1, a.name2, c.cust_pass, a.active_flag, b.var_value as cust_id, c.salesman_id, d.salesman_name
                                        from sec_user a 
                                        inner join sec_env_conf b on a.user_id2 = b.user_id2
                                        inner join customer c on b.var_value = c.cust_id
                                        inner join salesman d on c.salesman_id = d.salesman_id $where"));

            return \DataTables::of($data)
            ->editColumn('active_flag', function ($data) {
                if ($data->active_flag == "Y") return '<span class="shadow-none badge badge-success"> Active</span>';
                return '<span class="shadow-none badge badge-danger"> N/A</span>';
            })
            ->rawColumns(['active_flag'])
            ->make(true);

        }

        if ($groupid == 'SALES') {


            if ($id == 'undefined') {

                $data = DB::select(DB::raw("SELECT a.user_id2, a.name1, a.name2, c.cust_pass, a.active_flag, b.var_value as cust_id, c.salesman_id, d.salesman_name
                                            from sec_user a 
                                            inner join sec_env_conf b on a.user_id2 = b.user_id2
                                            inner join customer c on b.var_value = c.cust_id
                                            inner join salesman d on c.salesman_id = d.salesman_id where b.var_id = 'CUSTID' and c.salesman_id = '$salesid'"));

                return \DataTables::of($data)
                ->editColumn('active_flag', function ($data) {
                    if ($data->active_flag == "Y") return '<span class="shadow-none badge badge-success"> Active</span>';
                    return '<span class="shadow-none badge badge-danger"> N/A</span>';
                })
                ->rawColumns(['active_flag'])
                ->make(true);
            }

        }



        


    }

}
