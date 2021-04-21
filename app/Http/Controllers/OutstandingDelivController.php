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
        $txtCustID = Session::get('CUSTID');

        if ($groupid == "CUSTOMER") {

            $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select ltrim(rtrim(a.order_id)) as order_id, ltrim(rtrim(a.cust_name)) as cust_name,
                            FORMAT(a.dt_order, 'dd MMM yyyy') as dt_order,
                            a.leat_time, a.descr, 
                            CONVERT(varchar(12), b.thick) as thick, 
                            CAST(b.width as float) as width, 
                            b.grade_id, b.coat_mass, 
                            CONVERT(varchar(12), a.wgt_ord) as wgt_ord, 
                            CONVERT(varchar(12), a.wgt_deliv) as wgt_deliv,
                            CASE
                                WHEN (a.wgt_ord - a.wgt_deliv) < 0 THEN  '('+CONVERT(varchar(12),((a.wgt_ord - a.wgt_deliv) * -1))+')'
                                ELSE CONVERT(varchar(12),(a.wgt_ord - a.wgt_deliv))
                            END as outstd,
                            CONVERT(varchar(12), a.wgt_lpm) as wgt_lpm, 
                            CASE
                                WHEN ((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm) < 0 THEN '('+CONVERT(varchar(12),(((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm) * -1))+')'
                                ELSE CONVERT(varchar(12),((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm))
                            END as remain
                            from tracking_order a
                            inner join prod_spec b on a.prod_code = b.prod_code
                            where cust_id = '$txtCustID' and order_id <> ''"));

        }

        if ($groupid == "SALES") {

            $salesid = Session::get('SALESID');

            $data = DB::connection("sqlsrv2")
                    ->select(DB::raw("select ltrim(rtrim(a.order_id)) as order_id, ltrim(rtrim(a.cust_name)) as cust_name,
                    FORMAT(a.dt_order, 'dd MMM yyyy') as dt_order,
                    a.leat_time, a.descr, 
                    CONVERT(varchar(12), b.thick) as thick, 
                    CAST(b.width as float) as width, 
                    b.grade_id, b.coat_mass, 
                    CONVERT(varchar(12), a.wgt_ord) as wgt_ord, 
                    CONVERT(varchar(12), a.wgt_deliv) as wgt_deliv,
                    CASE
                        WHEN (a.wgt_ord - a.wgt_deliv) < 0 THEN  '('+CONVERT(varchar(12),((a.wgt_ord - a.wgt_deliv) * -1))+')'
                        ELSE CONVERT(varchar(12),(a.wgt_ord - a.wgt_deliv))
                    END as outstd,
                    CONVERT(varchar(12), a.wgt_lpm) as wgt_lpm, 
                    CASE
                        WHEN ((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm) < 0 THEN '('+CONVERT(varchar(12),(((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm) * -1))+')'
                        ELSE CONVERT(varchar(12),((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm))
                    END as remain
                    from tracking_order a
                    inner join prod_spec b on a.prod_code = b.prod_code
                    inner join order_book_hdr c on a.book_id = c.book_id
                    where c.salesman_id = '$salesid' and a.order_id <> ''"));

        }

        if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT') {

            $data = DB::connection("sqlsrv2")
            ->select(DB::raw("select ltrim(rtrim(a.order_id)) as order_id, ltrim(rtrim(a.cust_name)) as cust_name,
                    FORMAT(a.dt_order, 'dd MMM yyyy') as dt_order,
                    a.leat_time, a.descr, 
                    CONVERT(varchar(12), b.thick) as thick, 
                    CAST(b.width as float) as width, 
                    b.grade_id, b.coat_mass, 
                    CONVERT(varchar(12), a.wgt_ord) as wgt_ord, 
                    CONVERT(varchar(12), a.wgt_deliv) as wgt_deliv,
                    CASE
                        WHEN (a.wgt_ord - a.wgt_deliv) < 0 THEN  '('+CONVERT(varchar(12),((a.wgt_ord - a.wgt_deliv) * -1))+')'
                        ELSE CONVERT(varchar(12),(a.wgt_ord - a.wgt_deliv))
                    END as outstd,
                    CONVERT(varchar(12), a.wgt_lpm) as wgt_lpm, 
                    CASE
                        WHEN ((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm) < 0 THEN '('+CONVERT(varchar(12),(((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm) * -1))+')'
                        ELSE CONVERT(varchar(12),((a.wgt_ord - a.wgt_deliv) - a.wgt_lpm))
                    END as remain
                    from tracking_order a
                    inner join prod_spec b on a.prod_code = b.prod_code
                    where order_id <> ''"));

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
