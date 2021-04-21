<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ListOrderController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        
        // return view('layouts.ListOrder');

        Session::forget('token');
        $userid = Session::get('USERNAME');
        $passwd = Session::get('PASSWORD');
        $curl_getUserExist = curl_init();
        $curl_register = curl_init();
        $curl_login = curl_init();

        curl_setopt_array($curl_getUserExist, array(
            CURLOPT_URL => "https://svr01.kencana.org/service/api/getUserExist?email=".$userid."@".$userid.".com",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response_getUserExist = curl_exec($curl_getUserExist);
        $err_getUserExist = curl_error($curl_getUserExist);
        curl_close($curl_getUserExist);

        if ($err_getUserExist) {
            return view('layouts.DNConfirm')->with('error','UserExist#:' . $err_getUserExist);
        }
        else {
            $response_getUserExist = json_decode($response_getUserExist);
            $count = $response_getUserExist->message;

            if ($count < 1){

                $data = [
                    'name' => $userid,
                    'email' => $userid.'@'.$userid.'.com',
                    'password' => 'GeraltOfRivia1993',
                    'password_confirmation' => 'GeraltOfRivia1993',
                    'type' => 1,
                ];

                curl_setopt_array($curl_register, array(
                    CURLOPT_URL => "https://svr01.kencana.org/service/api/register",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        // Set here requred headers
                        "accept: */*",
                        "accept-language: en-US,en;q=0.8",
                        "content-type: application/json",
                    ),
                ));

                $response_register = curl_exec($curl_register);
                $err_register = curl_error($curl_register);

                curl_close($curl_register);

                if ($err_register) {
                    return view('layouts.ListOrder')->with('error','Register#:' . $err_register);
                } else {
                    $response_register = json_decode($response_register);

                    if (isset($response_register->token)){
                        Session::put('token', $response_register->token);
                        //return view('layouts.DNConfirm')->with('success','API Authentication Success');
			            return view('layouts.ListOrder');
                    }
                    else {
                        $errors = '';
                        foreach($response_register->errors as $a)
                        {

                            $a = str_replace(".", '\n', $a);
                            $errors .= $a;

                        }
                        return view('layouts.ListOrder')->with('error','RegisterAttempt#:' . $errors);
                    }
                }
            }
            else {

                $data = [
                    'email' => $userid.'@'.$userid.'.com',
                    'password' => 'GeraltOfRivia1993',
                ];

                curl_setopt_array($curl_login, array(
                    CURLOPT_URL => "https://svr01.kencana.org/service/api/login",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        // Set here requred headers
                        "accept: */*",
                        "accept-language: en-US,en;q=0.8",
                        "content-type: application/json",
                    ),
                ));

                $response_login= curl_exec($curl_login);
                $err_login = curl_error($curl_login);

                curl_close($curl_login);

                if ($err_login) {
                    return view('layouts.ListOrder')->with('error','Login#:' . $err_login);
                } else {
                    $response_login = json_decode($response_login);

                    if (isset($response_login->token)){
                        Session::put('token', $response_login->token);
                        //return view('layouts.DNConfirm')->with('success','API Authentication Success');
			            return view('layouts.ListOrder');
                    }
                    else {
                        return view('layouts.ListOrder')->with('error','LoginAttempt#:' . $response_login->message);
                    }

                }

            }
        }

    }

    public function getListorder(){

        $groupid = Session::get('GROUPID');
        $salesid = Session::get('SALESID');
        $userid = Session::get('USERNAME');
        $custid = Session::get('CUSTID');

        if ($groupid == 'SALES') {

            $data = DB::select(DB::raw("select DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id
                    from order_book_hdr a
                    join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    where a.salesman_id = '$salesid'
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id order by a.tr_date desc"));

            return \DataTables::of($data)
            ->editColumn('book_id', function ($data) {
            
                return '<a href="javascript:void(0)" class="btn btn_book_id btn-dark trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">'.$data->book_id.'</a>';
            })
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") return '<span class="shadow-none badge badge-open">OPEN</span>';
                if ($data->stat == "P") return '<span class="shadow-none badge badge-posted">POSTED</span>';
                if ($data->stat == "R") return '<span class="shadow-none badge badge-price">PRICE</span>';
                if ($data->stat == "S") return '<span class="shadow-none badge badge-confirm">CONFIRMED</span>';
                if ($data->stat == "C") return '<span class="shadow-none badge badge-closed">CLOSED</span>';
                if ($data->stat == "X") return '<span class="shadow-none badge badge-reject">REJECT</span>';
            })
            ->editColumn('amt_net', function ($data) {
                $quote_id = $data->quote_id;
                if ($quote_id)
                return ($data->amt_net*(10/100)) + $data->amt_net;

                if (!$quote_id)
                return $data->amt_net;
            })
            ->editColumn('images', function ($data) {
                if ($data->image == "N") return '<a href="UploadImg/id='.$data->book_id.'" class="images" tittle="Upload Images">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera-off"><line x1="1" y1="1" x2="23" y2="23"></line><path d="M21 21H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3m3-3h6l2 3h4a2 2 0 0 1 2 2v9.34m-7.72-2.06a4 4 0 1 1-5.56-5.56"></path></svg>
                N/A</a>';
                if ($data->image == "Y") return '<a href="UploadImg/id='.$data->book_id.'" class="images" tittle="View Images">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                Click me</a>';
            })
            ->addColumn('Detail', function($data) {
                if ($data->stat == "O")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="editOrderItem/id='.$data->book_id.'" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                <a href="javascript:void(0)" title="Delete" class="deleteOrder" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>';

                if ($data->stat == "P")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                <a href="javascript:void(0)" title="Delete" class="deleteOrder" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>';

                if ($data->stat == "R")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                <a href="javascript:void(0)" class="confirmOrder" title="Confirm" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </a>';

                if ($data->stat == "S")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "C")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "X")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';
            })
            ->rawColumns(['book_id','Detail','stat','images','amt_net'])
            ->addIndexColumn()
            ->make(true);
        }
        
        if ($groupid == 'CUSTOMER') {

            $salesid = DB::table('customer')
                        ->select('salesman_id')
                        ->where('cust_id','=', $custid)
                        ->Value('salesman_id');

            $data = DB::select(DB::raw("select DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id
                    from order_book_hdr a
                    join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    where a.cust_id = '$custid' and a.salesman_id = '$salesid'
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id order by a.tr_date desc"));

            return \DataTables::of($data)
            ->editColumn('book_id', function ($data) {
            
                return '<a href="javascript:void(0)" class="btn btn_book_id btn-dark trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">'.$data->book_id.'</a>';
            })
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") return '<span class="shadow-none badge badge-open">OPEN</span>';
                if ($data->stat == "P") return '<span class="shadow-none badge badge-posted">POSTED</span>';
                if ($data->stat == "R") return '<span class="shadow-none badge badge-price">PRICE</span>';
                if ($data->stat == "S") return '<span class="shadow-none badge badge-confirm">CONFIRMED</span>';
                if ($data->stat == "C") return '<span class="shadow-none badge badge-closed">CLOSED</span>';
                if ($data->stat == "X") return '<span class="shadow-none badge badge-reject">REJECT</span>';
            })
            ->editColumn('amt_net', function ($data) {
                $quote_id = $data->quote_id;
                if ($quote_id)
                return ($data->amt_net*(10/100)) + $data->amt_net;

                if (!$quote_id)
                return $data->amt_net;
            })
            ->editColumn('images', function ($data) {
                if ($data->image == "N") return '<a href="UploadImg/id='.$data->book_id.'" class="images" tittle="Upload Images">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera-off"><line x1="1" y1="1" x2="23" y2="23"></line><path d="M21 21H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3m3-3h6l2 3h4a2 2 0 0 1 2 2v9.34m-7.72-2.06a4 4 0 1 1-5.56-5.56"></path></svg>
                N/A</a>';
                if ($data->image == "Y") return '<a href="UploadImg/id='.$data->book_id.'" class="images" tittle="View Images">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                Click me</a>';
            })
            ->addColumn('Detail', function($data) {
                if ($data->stat == "O")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="editOrderItem/id='.$data->book_id.'" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                <a href="javascript:void(0)" title="Delete" class="deleteOrder" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>';

                if ($data->stat == "P")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                <a href="javascript:void(0)" title="Delete" class="deleteOrder" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>';

                if ($data->stat == "R")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                <a href="javascript:void(0)" class="confirmOrder" title="Confirm" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </a>';

                if ($data->stat == "S")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "C")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "X")
                return
                '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';
            })
            ->rawColumns(['book_id','Detail','stat','images','amt_net'])
            ->addIndexColumn()
            ->make(true);
        }

        if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT') {

            $data = DB::select(DB::raw("select DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id
                    from order_book_hdr a
                    left join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id order by a.tr_date desc"));

           return \DataTables::of($data)
           ->editColumn('book_id', function ($data) {
            
                return '<a href="javascript:void(0)" class="btn btn_book_id btn-dark trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">'.$data->book_id.'</a>';
            })
           ->editColumn('stat', function ($data) {
               if ($data->stat == "O") return '<span class="shadow-none badge badge-open">OPEN</span>';
               if ($data->stat == "P") return '<span class="shadow-none badge badge-posted">POSTED</span>';
               if ($data->stat == "R") return '<span class="shadow-none badge badge-price">PRICE</span>';
               if ($data->stat == "S") return '<span class="shadow-none badge badge-confirm">CONFIRMED</span>';
               if ($data->stat == "C") return '<span class="shadow-none badge badge-closed">CLOSED</span>';
               if ($data->stat == "X") return '<span class="shadow-none badge badge-reject">REJECT</span>';
           })
           ->editColumn('amt_net', function ($data) {
               $quote_id = $data->quote_id;
               if ($quote_id)
               return ($data->amt_net*(10/100)) + $data->amt_net;

               if (!$quote_id)
               return $data->amt_net;
           })
           ->editColumn('images', function ($data) {
               if ($data->image == "N") return '<a href="UploadImg/id='.$data->book_id.'" class="images" tittle="Upload Images">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera-off"><line x1="1" y1="1" x2="23" y2="23"></line><path d="M21 21H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3m3-3h6l2 3h4a2 2 0 0 1 2 2v9.34m-7.72-2.06a4 4 0 1 1-5.56-5.56"></path></svg>
               N/A</a>';
               if ($data->image == "Y") return '<a href="UploadImg/id='.$data->book_id.'" class="images" tittle="View Images">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
               Click me</a>';
           })
           ->addColumn('Detail', function($data) {
               if ($data->stat == "O")
               return
               '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
               </a>
               <a href="editOrderItem/id='.$data->book_id.'" title="Edit">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
               </a>
               <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
               </a>
               <a href="javascript:void(0)" title="Delete" class="deleteOrder" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
               </a>';

               if ($data->stat == "P")
               return
               '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
               </a>
               <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
               </a>
               <a href="javascript:void(0)" title="Delete" class="deleteOrder" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
               </a>';

               if ($data->stat == "R")
               return
               '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
               </a>
               <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
               </a>
               <a href="javascript:void(0)" class="confirmOrder" title="Confirm" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
               </a>';

               if ($data->stat == "S")
               return
               '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
               </a>
               <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
               </a>';

               if ($data->stat == "C")
               return
               '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
               </a>
               <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
               </a>';

               if ($data->stat == "X")
               return
               '<a href="javascript:void(0)" class="detailOrderModal" title="Quick View" data-id="'.$data->book_id.'">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
               </a>
               <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
               </a>';
           })
           ->rawColumns(['book_id','Detail','stat','images','amt_net'])
           ->addIndexColumn()
           ->make(true);
       }
    }

    public function detailHdr(Request $request){
        $id = $request->id;
        $result = DB::table('order_book_hdr')
                ->leftJoin('pay_term', 'order_book_hdr.pay_term_id', '=', 'pay_term.pay_term_id')
                ->select('order_book_hdr.*', 'pay_term.pay_term_desc')
                ->where('book_id', '=', $id)
                ->first();

        return response()->json(['cust_name' => $result->cust_name, 'cust_address' => $result->cust_address,
        'phone' => $result->phone, 'ship_to' => $result->ship_to, 'proj_flag' => $result->proj_flag,
        'pay_term_desc' => $result->pay_term_desc, 'cust_po_num' => $result->cust_po_num,
        'remark1' => $result->remark1, 'remark2' => $result->remark2]);

    }

    public function trackOrder(Request $request){

        $book_id = $request->id;

        $token = Session::get('token');

        $url = "https://svr01.kencana.org/service/api/trackOrder?id=".$book_id;

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
            return view('layouts.ListOrder')->with('error','trackOrder#:' . $err);
        }

        else {

            $data = json_decode($response);
            // dd($response);

            $xOrder = '';
            $XsItem = '';
            $xLpm = '';
            $xDeliv = '';
            $xItemNum = 0;
            $value = "<br>";

            foreach ($data as $data) {

                if ($xOrder != $data->order_id) {
    
                    $value .= "<p style='font-size: 16px'>&nbsp;&nbsp;&nbsp;<mark class='bg-success br-6'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevrons-down'><polyline points='7 13 12 18 17 13'></polyline><polyline points='7 6 12 11 17 6'></polyline></svg>".$data->order_id." (".$data->dt_order.") </mark></p>";
                    $xOrder = $data->order_id;
                }
    
    
                if ($xItemNum != $data->item_num) {
    
                    $value .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<mark class='bg-primary br-6'>".$data->val3."</mark></p>";
                    $xItemNum = $data->item_num;
    
                }
    
    
                if ($xLpm != $data->lpm_id."-".$data->item_num) { 
    
    
                    if (!$data->lpm_id) {
    
                        $value .= "<p class='text-danger'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg><strong>Lpm Id - Not Available Yet</strong></p>";
    
                    }
    
                    else {
    
                        $value .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg><strong>".$data->val4."</strong></p>";
    
                    }
    
    
                    $xLpm = $data->lpm_id."-".$data->item_num;
    
    
                }
    
                if ($xDeliv != $data->deliv_id."-".$data->item_num) { 
    
                    if (!$data->deliv_id) {
    
                        $value .= "<p class='text-danger'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevrons-right'><polyline points='13 17 18 12 13 7'></polyline><polyline points='6 17 11 12 6 7'></polyline></svg><em>Deliv Id - Not Available Yet</em></p>";
    
                    }
    
                    else {
    
                        $value .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevrons-right'><polyline points='13 17 18 12 13 7'></polyline><polyline points='6 17 11 12 6 7'></polyline></svg><em>".$data->val5."</em></p>";
    
                    }
                    
                    $xDeliv = $data->deliv_id."-".$data->item_num;
                }
    
                $check = $data->order_id;
    
            }
    
            if ($check) {
    
                return response()->json(['response' => $value]);
    
            }
    
            else {
    
                return response()->json(['error' => 'Order Id not yet created']);
    
            }


        }

    }

}
