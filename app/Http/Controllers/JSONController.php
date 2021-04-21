<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class JSONController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    // Sales
    public function getCust(Request $request){
        $search = $request->get('term');
        $result = DB::table('customer')
                    ->where('active_flag','=', 'Y')
                    ->where('cust_name', 'LIKE', '%'. $search. '%')
                    ->orWhere('cust_id', '=',  $search )
                    ->take(50)
                    ->get();

        return response()->json($result);
    }

    public function getCustID($id){
         $result = DB::table('customer')
                    ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id,
                    LTRIM(RTRIM(cust_name)) as cust_name,
                    LTRIM(RTRIM(address1)) as address1,
                    LTRIM(RTRIM(address2)) as address2,
                    LTRIM(RTRIM(city)) as city,
                    LTRIM(RTRIM(prov)) as prov,
                    LTRIM(RTRIM(phone)) as phone,
                    LTRIM(RTRIM(fax)) as fax,
                    LTRIM(RTRIM(contact_name)) as contact_name,
                    LTRIM(RTRIM(email)) as email')
                    ->where('cust_id', '=', $id)
                    ->get()
                    ->first();

        return json_encode($result);
    }

    public function checkCustomer ($id){

        $var_value = DB::table('sec_env_conf')
                    ->select('var_value')
                    ->Where('var_id', '=', 'CUSTID')
                    ->Where('var_value', '=', $id)
                    ->Value('var_value');

        if ($var_value) {

            
            $email= DB::table('sec_env_conf')
                        ->select('user_id2')
                        ->Where('var_id', '=', 'CUSTID')
                        ->Where('var_value', '=', $id)
                        ->Value('user_id2');

            $salesman = DB::table('customer')
                        ->join('salesman', 'salesman.salesman_id', '=', 'customer.salesman_id')
                        ->select('salesman.salesman_name')
                        ->Where('customer.cust_id', '=', $var_value)
                        ->Value('salesman.salesman_name');

            return response()->json(['response' => 'This customer already registered with '.$email.' and registered by '.$salesman]);
        }

        else {

            return response()->json(['response' => 'Ok']);

        }
    
       

    }

    public function checkEmail ($id){

        $email = DB::table('sec_user')
                    ->select('user_id2')
                    ->Where('user_id2', '=', $id)
                    ->Value('user_id2');

        if ($email) {

            $cust_name = DB::table('sec_user')
                        ->select('name1')
                        ->Where('user_id2', '=', $email)
                        ->Value('name1');


            return response()->json(['response' => 'This email already registered with '.$cust_name]);
        }
    
       

    }

    // Create Order
    public function listCustomer (Request $request) {

        $txtGroup = $request->txtGroup;
        $txtSalesid = $request->txtSalesid;
        $txtCustID = $request->txtCustID;

        if ($txtGroup == 'CUSTOMER') {


            $cust_grp_id = DB::table('customer')
                        ->selectRaw('LTRIM(RTRIM(cust_grp_id)) as cust_grp_id')
                        ->where('cust_id', '=', $txtCustID)
                        ->where('active_flag','=', 'Y')
                        ->first();

            $result = DB::table('customer')
                        ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id, LTRIM(RTRIM(cust_name)) as cust_name')
                        ->where('cust_grp_id', '=', $cust_grp_id->cust_grp_id)
                        ->where('active_flag','=', 'Y')
                        ->get();

            return response()->json($result);
            //echo $cust_grp_id;
        }

        if ($txtGroup == 'SALES') {

            $result = DB::table('customer')
                        ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id, LTRIM(RTRIM(cust_name)) as cust_name')
                        ->where('salesman_id', '=', $txtSalesid)
                        ->where('active_flag','=', 'Y')
                        ->get();

            return response()->json($result);
        }


    }

    public function listAllCustomer (Request $request) {

        $search = $request->get('term');
        $result = DB::table('customer')
                    ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id, LTRIM(RTRIM(cust_name)) as cust_name')
                    ->where('cust_name', 'LIKE', '%'. $search. '%')
                    ->where('active_flag','=', 'Y')
                    ->orWhere('cust_id', '=',  $search )
                    ->take(50)
                    ->get();

        return response()->json($result);

    }

    public function getCustDetails($id){

        $result = DB::table('customer')
                    ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id,
                    LTRIM(RTRIM(cust_name)) as cust_name,
                    LTRIM(RTRIM(address1)) as address1,
                    LTRIM(RTRIM(address2)) as address2,
                    LTRIM(RTRIM(city)) as city,
                    LTRIM(RTRIM(prov)) as prov,
                    LTRIM(RTRIM(phone)) as phone,
                    LTRIM(RTRIM(strata)) as strata,
                    LTRIM(RTRIM(str1)) as str1,
                    disc_loco')
                    ->where('cust_id', '=', $id)
                    ->where('active_flag','=', 'Y')
                    ->get()
                    ->first();

        return json_encode($result);
    }

    public function getConsignee($id){

        $result = DB::select(DB::raw("
                SELECT LTRIM(RTRIM(a.cons_id)) as cons_id,
                LTRIM(RTRIM(b.cons_name)) as cons_name,
                concat(LTRIM(RTRIM(b.address1)),' ',LTRIM(RTRIM(b.address2)), ',',
                LTRIM(RTRIM(b.city)),',', LTRIM(RTRIM(b.prov)), ' ', LTRIM(RTRIM(b.zip_code))) as address1
                FROM cust_cons_link a JOIN consignee b
                ON a.mill_id = b.mill_id
                AND a.cons_id = b.cons_id
                WHERE a.mill_id = 'SR'
                AND a.cust_id = '$id'
                AND a.active_flag = 'Y'"));

        return response()->json($result);
        // dd($result);
    }
    
    public function listSalesman (Request $request) {

        $txtGroup = $request->txtGroup;
        $txtSalesid = $request->txtSalesid;
        $txtCustID = $request->txtCustID;

        if ($txtGroup == 'CUSTOMER') {

            if ($txtCustID == 'C044') {


                $result =DB::table('salesman')
                        ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                        // ->where('active_flag', '=', 'Y')
                        ->where('salesman_id', '=',  'S009' )
                        ->get();

                return response()->json($result);

            }

            else {

                $result = DB::table('customer')
                        ->join('salesman', 'salesman.salesman_id', '=', 'customer.salesman_id')
                        ->selectRaw('LTRIM(RTRIM(salesman.salesman_id)) as salesman_id, LTRIM(RTRIM(salesman.salesman_name)) as salesman_name')
                        ->where('customer.cust_id', '=', $txtCustID)
                        ->where('salesman.active_flag', '=', 'Y')
                        //->orWhere('salesman.salesman_id', '=',  'S009' )
                        ->get();

                return response()->json($result);

            }

            
        }

        if ($txtGroup == 'SALES') {

            $result = DB::table('salesman')
                        ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                        ->where('salesman_id', '=', $txtSalesid)
                        //->where('active_flag', '=', 'Y')
                        ->get();

            return response()->json($result);
        }

        if ($txtGroup == 'DEVELOPMENT' || $txtGroup == 'MARKETING MANAGEMENT') { 

            $result = DB::table('salesman')
                        ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                        ->where('active_flag', '=', 'Y')
                        ->orWhere('salesman_id', '=',  'S009' )
                        ->get();

            return response()->json($result);

        }


    }

    public function listPayment(){

        $result = DB::table('pay_term')
                ->selectRaw('LTRIM(RTRIM(pay_term_id)) as pay_term_id, LTRIM(RTRIM(pay_term_desc)) as pay_term_desc')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }




}
