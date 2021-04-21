<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PrintPreviewController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        try {

            $checkStat = DB::table('order_book_hdr')
                        ->select('stat')
                        ->where('book_id', '=', $id)
                        ->value('stat');

            if ($checkStat == "X") {

                $header = DB::table('order_book_hdr')
                        ->leftjoin('customer', 'customer.cust_id', '=', 'order_book_hdr.cust_id')
                        ->leftjoin('pay_term', 'pay_term.pay_term_id', '=', 'order_book_hdr.pay_term_id')
                        ->selectRaw("order_book_hdr.book_id, order_book_hdr.stat, order_book_hdr.quote_id, order_book_hdr.order_id, order_book_hdr.cust_po_num,
                        LTRIM(RTRIM(customer.cust_name)) as cust_name,
                        LTRIM(RTRIM(customer.npwp)) as npwp, LTRIM(RTRIM(customer.contact_name)) as contact_name,
                        order_book_hdr.cust_address,
                        LTRIM(RTRIM(customer.phone)) as phone,
                        COALESCE(LTRIM(RTRIM(pay_term.pay_term_desc)), '') as pay_term_desc, order_book_hdr.ship_to,
                        DATE_FORMAT(order_book_hdr.tr_date, '%d %M %Y') as tr_date")
                        ->where('order_book_hdr.book_id', '=', $id)
                        ->first();

                $detail =DB::select(DB::raw("SELECT LTRIM(RTRIM(a.mill_id)) as mill_id
                        ,LTRIM(RTRIM(a.book_id)) as book_id
                        ,a.item_num as item_num
                        ,LTRIM(RTRIM(a.prod_code)) as prod_code
                        ,COALESCE(LTRIM(RTRIM(b.descr)),'by Remark') as descr
                        ,a.wgt as wgt
                        ,LTRIM(RTRIM(a.unit_meas)) as unit_meas
                        ,LTRIM(RTRIM(a.curr_id)) as curr_id
                        ,a.unit_price as unit_price
                        ,a.amt_gross as amt_gross
                        ,a.amt_disc as amt_disc
                        ,a.amt_tax as amt_tax
                        ,a.pct_disc as pct_disc
                        ,a.amt_net as amt_net
                        ,LTRIM(RTRIM(a.ord_desc)) as ord_desc
                        ,LTRIM(RTRIM(a.remark)) as remark
                        ,DATE_FORMAT(a.dt_req_ship, '%d %M %Y') as dt_req_ship
                        ,LTRIM(RTRIM(a.req_week)) as req_week
                        ,LTRIM(RTRIM(a.req_month)) as req_month
                        ,LTRIM(RTRIM(a.req_year)) as req_year
                        ,LTRIM(RTRIM(a.stat)) as stat
                        ,a.dt_created
                        ,a.dt_modified
                        ,LTRIM(RTRIM(a.user_id)) as user_id
                        ,LTRIM(RTRIM(a.aplikasi_note)) as aplikasi_note
                        from order_book_dtl a LEFT OUTER JOIN prod_spec b
                        on a.prod_code = b.prod_code
                        where a.book_id = '$id'"));

                        return view('layouts.PrintPreview',[
                            'bookId'=>$header->book_id,
                            'quouteId'=>$header->quote_id,
                            'orderId'=>$header->order_id,
                            'custPoNum'=>$header->cust_po_num,
                            'tr_date'=>$header->tr_date,
                            'buyer'=>$header->cust_name,
                            'npwp'=>$header->npwp,
                            'attn'=>$header->contact_name,
                            'address'=>$header->cust_address,
                            'phone'=>$header->phone,
                            'payment'=>$header->pay_term_desc,
                            'shipto'=>$header->ship_to,
                            'amt_net'=>0,
                            'detail'=>$detail
                            ]);

            }

            else {

                $header = DB::table('order_book_hdr')
                        ->leftjoin('customer', 'customer.cust_id', '=', 'order_book_hdr.cust_id')
                        ->leftjoin('pay_term', 'pay_term.pay_term_id', '=', 'order_book_hdr.pay_term_id')
                        ->selectRaw("order_book_hdr.book_id, order_book_hdr.stat, order_book_hdr.quote_id, order_book_hdr.order_id, order_book_hdr.cust_po_num,
                        LTRIM(RTRIM(customer.cust_name)) as cust_name,
                        LTRIM(RTRIM(customer.npwp)) as npwp, LTRIM(RTRIM(customer.contact_name)) as contact_name,
                        order_book_hdr.cust_address,
                        LTRIM(RTRIM(customer.phone)) as phone,
                        COALESCE(LTRIM(RTRIM(pay_term.pay_term_desc)), '') as pay_term_desc, order_book_hdr.ship_to,
                        DATE_FORMAT(order_book_hdr.tr_date, '%d %M %Y') as tr_date")
                        ->where('order_book_hdr.book_id', '=', $id)
                        ->first();

                $detail =DB::select(DB::raw("SELECT LTRIM(RTRIM(a.mill_id)) as mill_id
                        ,LTRIM(RTRIM(a.book_id)) as book_id
                        ,a.item_num as item_num
                        ,LTRIM(RTRIM(a.prod_code)) as prod_code
                        ,COALESCE(LTRIM(RTRIM(b.descr)),'by Remark') as descr
                        ,a.wgt as wgt
                        ,LTRIM(RTRIM(a.unit_meas)) as unit_meas
                        ,LTRIM(RTRIM(a.curr_id)) as curr_id
                        ,a.unit_price as unit_price
                        ,a.amt_gross as amt_gross
                        ,a.amt_disc as amt_disc
                        ,a.amt_tax as amt_tax
                        ,a.pct_disc as pct_disc
                        ,a.amt_net as amt_net
                        ,LTRIM(RTRIM(a.ord_desc)) as ord_desc
                        ,LTRIM(RTRIM(a.remark)) as remark
                        ,DATE_FORMAT(a.dt_req_ship, '%d %M %Y') as dt_req_ship
                        ,LTRIM(RTRIM(a.req_week)) as req_week
                        ,LTRIM(RTRIM(a.req_month)) as req_month
                        ,LTRIM(RTRIM(a.req_year)) as req_year
                        ,LTRIM(RTRIM(a.stat)) as stat
                        ,a.dt_created
                        ,a.dt_modified
                        ,LTRIM(RTRIM(a.user_id)) as user_id
                        ,LTRIM(RTRIM(a.aplikasi_note)) as aplikasi_note
                        from order_book_dtl a LEFT OUTER JOIN prod_spec b
                        on a.prod_code = b.prod_code
                        where a.book_id = '$id'"));

                $total = DB::table('order_book_dtl')
                            ->selectRaw('book_id, sum(amt_net) as amt_net')
                            ->where('book_id', '=', $id)
                            ->where('stat', '<>', 'X')
                            ->groupBy('book_id')
                            ->first();

                $check = $header->quote_id;

                if ($check) {
                    $checkQuote = 1;
                    $tax = DB::table('order_book_hdr')
                            ->select('tax1')
                            ->where('quote_id', '=', $check)
                            ->first();
                    $checkTax = $tax->tax1;
                    // if ($checkTax == "T") {
                    //     $taxPct = 10/100;
                    //     $taxAmt = $taxPct * $total->amt_net;
                    //     $beforeTax = $total->amt_net * 1;
                    //     $totalOrder = $beforeTax + $taxAmt;
                    // }
                    // else {
                    //     $beforeTax = $total->amt_net * 1;
                    //     $totalOrder = $total->amt_net * 1;
                    // }

                    return view('layouts.PrintPreview',[
                        'bookId'=>$header->book_id,
                        'quouteId'=>$header->quote_id,
                        'orderId'=>$header->order_id,
                        'custPoNum'=>$header->cust_po_num,
                        'tr_date'=>$header->tr_date,
                        'buyer'=>$header->cust_name,
                        'npwp'=>$header->npwp,
                        'attn'=>$header->contact_name,
                        'address'=>$header->cust_address,
                        'phone'=>$header->phone,
                        'payment'=>$header->pay_term_desc,
                        'shipto'=>$header->ship_to,
                        'detail'=>$detail,
                        'check'=>$checkTax,
                        'amt_net'=>$total->amt_net
                        ]);

                }
                else {
                    return view('layouts.PrintPreview',[
                        'bookId'=>$header->book_id,
                        'quouteId'=>$header->quote_id,
                        'orderId'=>$header->order_id,
                        'custPoNum'=>$header->cust_po_num,
                        'tr_date'=>$header->tr_date,
                        'buyer'=>$header->cust_name,
                        'npwp'=>$header->npwp,
                        'attn'=>$header->contact_name,
                        'address'=>$header->cust_address,
                        'phone'=>$header->phone,
                        'payment'=>$header->pay_term_desc,
                        'shipto'=>$header->ship_to,
                        'amt_net'=>$total->amt_net,
                        'detail'=>$detail
                        ]);
                }
                
            }
            
        }
        catch(QueryException $ex){

            $error = $ex->getMessage();
            return response()->json(['response' => 'Whops, something error', 'detail'=> $error]);
        }
    }
}
