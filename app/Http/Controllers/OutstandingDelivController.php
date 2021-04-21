<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class OutstandingDelivController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        return view('layouts.OutstandingDeliv');

    }

    public function getOutstandingDeliv(Request $request){

        $groupid = Session::get('GROUPID');

        if ($groupid == "CUSTOMER") {

            $custid = Session::get('CUSTID');

            $token = Session::get('token');

            $url = "https://svr01.kencana.org/service/api/getOutstandingDeliv?custid=".$custid;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                    "Authorization: Bearer $token",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return view('layouts.OutstandingDeliv')->with('error','OutstandingDeliv#:' . $err);
            }

            else {

                $data = json_decode($response);
            }
        }

        if ($groupid == "SALES") {

            $salesid = Session::get('SALESID');

            $token = Session::get('token');

            $url = "https://svr01.kencana.org/service/api/getOutstandingDeliv?salesid=".$salesid;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                    "Authorization: Bearer $token",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return view('layouts.OutstandingDeliv')->with('error','OutstandingDeliv#:' . $err);
            }

            else {

                $data = json_decode($response);
            }

        }

        if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT') {

            $token = Session::get('token');

            $url = "https://svr01.kencana.org/service/api/getOutstandingDeliv?privilege=all";

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                    "Authorization: Bearer $token",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return view('layouts.OutstandingDeliv')->with('error','OutstandingDeliv#:' . $err);
            }

            else {

                $data = json_decode($response);
            }
        }

        return \DataTables::of($data)
        ->editColumn('outstd', function ($data) { 

            if (strpos($data->outstd, '(') !== FALSE)
            return '
            <a href="javascript:void(0)" class="text-danger">'.$data->outstd.'</a>';

            if (strpos($data->outstd, '(') !== TRUE)
            return '
            <a href="javascript:void(0)" class="text-primary">'.$data->outstd.'</a>';

        })
        ->editColumn('remain', function ($data) { 

            if (strpos($data->remain, '(') !== FALSE)
            return '
            <a href="javascript:void(0)" class="text-danger">'.$data->remain.'</a>';

            if (strpos($data->remain, '(') !== TRUE)
            return '
            <a href="javascript:void(0)" class="text-primary">'.$data->remain.'</a>';

        })
        ->rawColumns(['remain', 'outstd'])
        ->make(true);

        



    }
}
