<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Session;
use DB;
use Hash;

class CustRegController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('layouts.CustReg');

    }


    public function SaveCustReg (Request $request){

        $txtCustEmail = $request->txtCustEmail;
        $txtCustPwd = $request->txtCustPwd;
        $txtCustName = $request->txtCustName;
        $txtContact = $request->txtContact;
        $txtCustID = $request->txtCustID;
        $txtSalesman = $request->txtSalesman;

        if (!$txtCustName) {
            $txtCustName = '';
        }

        if (!$txtContact) {
            $txtContact = '';
        }

        $userid = Session::get('USERNAME');
        $password = Hash::make($txtCustPwd);
        $tr_date = Carbon::now();
        $salesid = Session::get('SALESID');

        if (!$salesid) {
            $salesid = $txtSalesman;
        }

        try{

            $id = DB::table('sec_user')
                    ->select('id')
                    ->max('id');

            $item = DB::table('sec_user')
                        ->insert([
                            'id' => $id + 1,
                            'global_id' => $txtCustEmail,
                            'user_id2' => $txtCustEmail,
                            'username' => $txtCustEmail,
                            'password' => $password,
                            'user_pass'=> $txtCustPwd,
                            'name1' => $txtCustName,
                            'name2' => $txtContact,
                            'name3' => '',
                            'plant' => '',
                            'division' => '',
                            'dept' => '',
                            'section' => '',
                            'position' => '',
                            'active_flag' => 'Y',
                            'user_id' => $userid
                        ]);

            $group = DB::table('sec_group')
                        ->insert([
                            'appl_id' => 'PREORDER',
                            'user_id2' => $txtCustEmail,
                            'group_id' => 'CUSTOMER',
                            'active_flag' => 'Y',
                            'dt_modified' => $tr_date,
                            'user_id' => $userid
                        ]);

            $env = DB::table('sec_env_conf')
                        ->insert([
                            'appl_id' => 'PREORDER',
                            'group_id' => '',
                            'user_id2' => $txtCustEmail,
                            'var_id' => 'CUSTID',
                            'var_type' => 'S',
                            'var_value' => $txtCustID,
                            'note1' => '',
                            'active_flag' => 'Y',
                            'dt_modified' => $tr_date,
                            'user_id' => $userid
                        ]);

            $header = DB::table('customer')
                    ->where('cust_id', '=', $txtCustID)
                    ->update([
                        'salesman_id' => $salesid,
                        'cust_user' => $txtCustEmail,
                        'cust_pass' => $txtCustPwd
                    ]);

            return response()->json(['response' => 'Customer Registered']);

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }

        

    }
}
