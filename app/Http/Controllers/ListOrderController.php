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
        
        return view('layouts.ListOrder');

    }

    public function getListorder(Request $request){

        $searchkey = $request->searchkey;
        $groupid = Session::get('GROUPID');
        $salesid = Session::get('SALESID');
        $userid = Session::get('USERNAME');
        $custid = Session::get('CUSTID');

        $where = "where 1=1";

        if ($searchkey) {

            $where .= " and c.ord_desc like '%$searchkey%'";

        }

        // echo $where;

        if ($groupid == 'SALES') {

            $data = DB::select(DB::raw("select DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id, a.order_id
                    from order_book_hdr a
                    join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    $where and a.salesman_id = '$salesid'
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id, a.order_id order by a.tr_date desc"));

            return \DataTables::of($data)
            ->editColumn('book_id', function ($data) {
            
                return '<span class="badge badge-primary">'.$data->book_id.'</span>';
            })
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-dark trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    OPEN
                </a>';
                if ($data->stat == "P") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-warning trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    INQUIRY
                </a>';
                if ($data->stat == "R") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-success trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    QUOTATION
                </a>';
                if ($data->stat == "S") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-info trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    CONFIRMED
                </a>';
                if ($data->stat == "C") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-secondary trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    SALES CONTRACT
                </a>';
                if ($data->stat == "X") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-danger trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    REJECTED
                </a>
                ';
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
                '<a href="javascript:void(0)" class="detailOrderModalB4" title="Quick View" data-id="'.$data->book_id.'">
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
                '<a href="javascript:void(0)" class="detailOrderModalB4" title="Quick View" data-id="'.$data->book_id.'">
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
                '<a href="javascript:void(0)" class="detailOrderModal" title="Approval" data-id="'.$data->book_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                ';

                if ($data->stat == "S")
                return
                '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "C")
                return
                '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "X")
                return
                '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';
            })
            ->rawColumns(['book_id', 'Detail','stat','images','amt_net'])
            ->addIndexColumn()
            ->make(true);
        }
        
        if ($groupid == 'CUSTOMER') {

            $list_custid = '';
            $salesid = DB::table('customer')
                        ->select('salesman_id')
                        ->where('cust_id','=', $custid)
                        ->Value('salesman_id');

            $cust_grp_id_tmp = DB::table('customer')
                        ->selectRaw('LTRIM(RTRIM(cust_grp_id)) as cust_grp_id')
                        ->where('cust_id', '=', $custid)
                        ->where('active_flag','=', 'Y')
                        ->groupBy('cust_grp_id')
                        ->value('cust_grp_id');

            
            $list_custid_tmp = DB::table('customer')
                            ->selectRaw('LTRIM(RTRIM(cust_id)) as cust_id')
                            ->where('cust_grp_id', '=', $cust_grp_id_tmp)
                            ->where('active_flag','=', 'Y')
                            ->get();


            foreach ($list_custid_tmp as $list_custid_tmp) {
                

                $list_custid .= "'".$list_custid_tmp->cust_id."',";
                
            }

            $list_custid = substr_replace($list_custid, "", -1);
            

            $data = DB::select(DB::raw("select DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id, a.order_id
                    from order_book_hdr a
                    join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id
                    $where and a.cust_id in ($list_custid) and a.salesman_id = '$salesid'
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id, a.order_id order by a.tr_date desc"));

            // $data = DB::select(DB::raw("select x.descr, a.fr_date,
            //                 a.book_id, a.stat, a.salesman_id, a.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
            //                 a.cust_po_num, a.amt_net, a.image, a.quote_id from 
            //                 (select c.prod_code, a.tr_date, DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
            //                 a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
            //                 a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id
            //                 from order_book_hdr a
            //                 join salesman b on a.salesman_id = b.salesman_id
            //                 join order_book_dtl c on a.book_id = c.book_id
            //                 where a.cust_id in ($list_custid) and a.salesman_id = '$salesid'
            //                 group by c.prod_code, a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
            //                 a.cust_po_num, a.image, a.quote_id order by a.tr_date desc) a
            //                 join prod_spec x on a.prod_code = x.prod_code
            //                 order by a.tr_date desc"));

            return \DataTables::of($data)
            ->editColumn('book_id', function ($data) {
                if ($data->order_id != "" || $data->order_id)
                return '<span class="badge badge-primary">'.$data->order_id.'</span>';

                if ($data->order_id == "" || !$data->order_id)
                return '<span class="badge badge-primary">'.$data->book_id.'</span>';
            })
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-dark trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    OPEN
                </a>';
                if ($data->stat == "P") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-warning trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    INQUIRY
                </a>';
                if ($data->stat == "R") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-success trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    QUOTATION
                </a>';
                if ($data->stat == "S") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-info trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    CONFIRMED
                </a>';
                if ($data->stat == "C") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-secondary trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    SALES CONTRACT
                </a>';
                if ($data->stat == "X") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-danger trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    REJECTED
                </a>
                ';
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
                '<a href="javascript:void(0)" class="detailOrderModalB4" title="Quick View" data-id="'.$data->book_id.'">
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
                '<a href="javascript:void(0)" class="detailOrderModalB4" title="Quick View" data-id="'.$data->book_id.'">
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
                '<a href="javascript:void(0)" class="detailOrderModal" title="Approval" data-id="'.$data->book_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>
                ';

                if ($data->stat == "S")
                return
                '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "C")
                return
                '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';

                if ($data->stat == "X")
                return
                '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>
                <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                </a>';
            })
            ->rawColumns(['book_id', 'Detail','stat','images','amt_net'])
            ->addIndexColumn()
            ->make(true);
        }

        if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT') {

            $data = DB::select(DB::raw("select DATE_FORMAT(a.tr_date, '%d %M %Y') as fr_date,
                    a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, sum(c.amt_net) as amt_net, a.image, a.quote_id, a.order_id
                    from order_book_hdr a
                    left join salesman b on a.salesman_id = b.salesman_id
                    join order_book_dtl c on a.book_id = c.book_id $where
                    group by a.tr_date, a.book_id, a.stat, a.salesman_id, b.salesman_name, a.user_id, a.cust_id, a.cust_name, a.ship_to,
                    a.cust_po_num, a.image, a.quote_id, a.order_id order by a.tr_date desc"));

           return \DataTables::of($data)
           ->editColumn('book_id', function ($data) {
            
                return '<span class="badge badge-primary">'.$data->book_id.'</span>';
            })
            ->editColumn('stat', function ($data) {
                if ($data->stat == "O") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-dark trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    OPEN
                </a>';
                if ($data->stat == "P") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-warning trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    INQUIRY
                </a>';
                if ($data->stat == "R") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-success trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    QUOTATION
                </a>';
                if ($data->stat == "S") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-info trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    CONFIRMED
                </a>';
                if ($data->stat == "C") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-secondary trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    SALES CONTRACT
                </a>';
                if ($data->stat == "X") 
                return '
                <a href="javascript:void(0)" class="badge outline-badge-danger trackingOrder" title="Tracking Order" data-id="'.$data->book_id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    REJECTED
                </a>
                ';
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
            '<a href="javascript:void(0)" class="detailOrderModalB4" title="Quick View" data-id="'.$data->book_id.'">
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
            '<a href="javascript:void(0)" class="detailOrderModalB4" title="Quick View" data-id="'.$data->book_id.'">
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
            '<a href="javascript:void(0)" class="detailOrderModal" title="Approval" data-id="'.$data->book_id.'">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            </a>
            <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            </a>
            ';

            if ($data->stat == "S")
            return
            '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </a>
            <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            </a>';

            if ($data->stat == "C")
            return
            '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </a>
            <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            </a>';

            if ($data->stat == "X")
            return
            '<a href="javascript:void(0)" class="detailOrderModalAfter" title="Quick View" data-id="'.$data->book_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </a>
            <a href="PrintPreview/id='.$data->book_id.'" target="_blank" title="Print">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            </a>';
            })

            ->rawColumns(['book_id', 'Detail','stat','images','amt_net'])
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
    
                    // $value .= "<p style='font-size: 16px'>&nbsp;&nbsp;&nbsp;<mark class='bg-success br-6'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevrons-down'><polyline points='7 13 12 18 17 13'></polyline><polyline points='7 6 12 11 17 6'></polyline></svg>".$data->order_id." (".$data->dt_order.") </mark></p>";
                    $value .= '
                    
                    <div class="widget widget-activity-three" style="padding: 10px">
        
                        <div class="widget-content">

                            <div class="mt-container mx-auto">
                                <div class="timeline-line">
                                    
                                    <div class="item-timeline timeline-new">
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5 style="font-size: 25px;">'.$data->order_id.'</h5>
                                            </div>
                                            <div class="tags">
                                                <div style="font-size: 13px;" class="badge badge-primary">Date: '.$data->dt_order.'</div>
                                                <div style="font-size: 13px;" class="badge badge-success">PayTerm: '.$data->pay_term.'</div>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>                                    
                            </div>
                        </div>

                    </div>';
                    
                    $xOrder = $data->order_id;
                }
    
    
                if ($xItemNum != $data->item_num) {

                    $value .= '</div><p></p>';
    
                    // $value .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<mark class='bg-primary br-6'>".$data->item."</mark></p>";
                    $value .= '
                    
                    <div class="widget widget-activity-three" style="padding: 10px">
        
                        <div class="widget-content">

                            <div class="mt-container mx-auto">
                                <div class="timeline-line">
                                    
                                    <div class="item-timeline timeline-new">
                                        <div class="t-dot">
                                            <div class="t-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                            </div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>'.$data->item.'</h5>
                                            </div>
                                            <p>Reqship: '.$data->req_shipx.'</p>
                                            <p>LeadTime: '.$data->leat_time.'</p>
                                            <div class="tags">
                                                <div class="badge badge-primary">Ord: '.number_format($data->wgt_ord).' KG</div>
                                                <div class="badge badge-success">Remain: '.number_format($data->wgt_sisa).' KG</div>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>                                    
                            </div>
                        </div>';
                    $xItemNum = $data->item_num;
    
                }
    
    
                if ($xLpm != $data->lpm_id."-".$data->item_num) { 
    
    
                    if (!$data->lpm_id || $data->lpm_id == '') {
    
                        // $value .= "<p class='text-danger'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg><strong>Lpm Id - Not Available Yet</strong></p>";
                        $value .= 
                        '<div class="widget widget-table-one" style="margin-left: 5px; margin-right: 10px; box-shadow: none;">
                        <div class="widget-content">
                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="icon" style="background-color: #dc3545">
                                                <svg style="color: #ffff" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4 class="text-danger">LPM ID: N/A</h4>
                                            <p class="meta-date text-danger">Date: N/A</p>
                                            <p class="meta-date text-danger">Valid: N/A</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-dec">
                                        <p><span>Wgt: N/A</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
    
                    else {
    
                        // $value .= "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg><strong>".$data->lpm_id."</strong></p>";
                        $value .= 
                        '<div class="widget widget-table-one" style="margin-left: 5px; margin-right: 10px; box-shadow: none;">
                        <div class="widget-content">
                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="icon" style="background-color: #28a745">
                                                <svg style="color: #ffff" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4 class="text-success">'.$data->lpm_id.'</h4>
                                            <p class="meta-date text-success">Date: '.$data->dt_lpm.'</p>
                                            <p class="meta-date text-success">Valid: '.$data->dt_lpm_valid.'</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-inc text-success">
                                        <p class="text-success"><span>'.number_format($data->wgt_lpm).' KG</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
    
    
                    $xLpm = $data->lpm_id."-".$data->item_num;
    
    
                }
    
                if ($xDeliv != $data->deliv_id."-".$data->item_num) { 
    
                    if (!$data->deliv_id || $data->deliv_id == '') {
    
                        $value .= 
                        '<div class="widget widget-table-one" style="margin-left: 30px; margin-right: 10px; box-shadow: none;">
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #dc3545">
                                                    <svg style="color: #ffff" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4 class="text-danger">DLV ID: N/A</h4>
                                                <p class="meta-date text-danger">Date: N/A</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-dec">
                                            <p><span>Wgt: N/A</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
    
                    else {
    
                        $value .= 
                        '<div class="widget widget-table-one" style="margin-left: 30px; margin-right: 10px; box-shadow: none;">
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #17a2b8">
                                                    <svg style="color: #ffff" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4 class="text-info">'.$data->deliv_id.'</h4>
                                                <p class="meta-date text-info">Date: '.$data->dt_deliv.'</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-inc">
                                            <p class="text-info"><span>'.number_format($data->wgt_deliv).' KG</span></p>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
    
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
