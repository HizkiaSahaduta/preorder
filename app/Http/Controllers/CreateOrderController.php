<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CreateOrderController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        Session::forget('bookId');
        $now = Carbon::now();
        $year_now =  $now->year;
        $a = $now->addYear(+10);
        $year_later = $a->year;

        return view('layouts.CreateOrder',['year_now' => $year_now, 'year_later' => $year_later]);
    }

    public function getOrderHeader($id){

        $result = DB::table('order_book_hdr')
                    ->select('cust_id', 'deliv_mode', 'cons_id', 'salesman_id', 'proj_flag', 'pay_term_id','cust_po_num','remark1','remark2')
                    ->where('book_id', '=', $id)
                    ->first();

        return response()->json(['cust_id' => $result->cust_id, 'deliv_mode' => $result->deliv_mode, 'cons_id' => $result->cons_id, 'salesman_id' => $result->salesman_id,
        'proj_flag' => $result->proj_flag, 'pay_term_id' => $result->pay_term_id, 'cust_po_num' => $result->cust_po_num,
        'remark1' => $result->remark1, 'remark2' => $result->remark2]);

    }

    public function updateOrderHeader(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $cust_name = $request->cust_name;
        if(!$cust_name){
            $cust_name = '';
        }
        $deliv_mode = $request->deliv_mode;
        if(!$deliv_mode){
            $deliv_mode = '';
        }
        $cust_address = $request->cust_address;
        if(!$cust_address){
            $cust_address = '';
        }
        $phone = $request->phone;
        if(!$phone){
            $phone = '';
        }
        $cons_id = $request->cons_id;
        if(!$cons_id){
            $cons_id = '';
        }
        $ship_to = $request->ship_to;
        if(!$ship_to){
            $ship_to = '';
        }
        $salesman_id = $request->salesman_id;
        if(!$salesman_id){
            $salesman_id = '';
        }
        $remark1 = $request->remark1;
        if (!$remark1){
            $remark1 = '';
        }
        $remark2 = $request->remark2;
        if (!$remark2){
            $remark2 = '';
        }
        $pay_term_id = $request->pay_term_id;
        if (!$pay_term_id){
            $pay_term_id = '';
        }
        $cust_po_num = $request->cust_po_num;
        if (!$cust_po_num){
            $cust_po_num = '';
        }

        try{

            $header = DB::table('order_book_hdr')
                        ->where('book_id', '=', $request->book_id)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->update([
                            'tr_date' => $tr_date,
                            'cust_id' => $request->cust_id,
                            'deliv_mode' => $deliv_mode,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'pay_term_id' => $pay_term_id,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

            return response()->json(['response' => 'Order Updated']);
        }
        catch(QueryException $ex){

            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }



    }

    public function listCommodity(){

        $result = DB::table('commodity')
                    ->selectRaw('LTRIM(RTRIM(commodity_id)) as commodity_id, LTRIM(RTRIM(descr)) as descr')
                    ->where('category_id', '=', '01')
                    ->where('active_flag', '=', 'Y')
                    ->get();

        return response()->json($result);
    }

    public function listBrand(){

        $result = DB::table('prod_brand')
                ->selectRaw('LTRIM(RTRIM(brand_id)) as brand_id, LTRIM(RTRIM(descr)) as descr')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function listCoat(){

        $result = DB::table('brand_coat')
                ->selectRaw('LTRIM(RTRIM(coat_mass)) as coat_mass, LTRIM(RTRIM(brand_name)) as brand_name')
                ->where('coat_mass', '<>', '50')
                ->get();

        return response()->json($result);
    }

    public function listGrade(){

        $result =DB::table('prod_grade')
                ->selectRaw('LTRIM(RTRIM(grade_id)) as grade_id')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function listAppl(){

        $result =DB::table('appl_name')
                ->selectRaw('LTRIM(RTRIM(appl_name)) as appl_name')
                ->where('mill_id', '=', 'SR')
                ->get();

        return response()->json($result);
    }

    public function allThickness(){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function commodityThickness($id){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function brandThickness($id){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('brand_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function getThickness($a, $b){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(thick)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $a)
                ->where('brand_id', '=', $b)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('thick', 'asc')
                ->get();

        return response()->json($result);


    }

    public function allWidth(){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);

    }

    public function commodityWidth($id){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);


    }

    public function brandWidth($id){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('brand_id', '=', $id)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);


    }

    public function getWidth($a, $b){

        $result = DB::table('prod_spec')
                ->selectRaw('distinct(width)')
                ->where('active_flag', '=', 'Y')
                ->where('commodity_id', '=', $a)
                ->where('brand_id', '=', $b)
                ->where('pattern_id', '=', '')
                ->where('quality_id', '=', 'A')
                ->orderBy('width', 'asc')
                ->get();

        return response()->json($result);


    }

    public function allColour(){

        $result = DB::table('prod_color')
                ->selectRaw('LTRIM(RTRIM(color_id)) as color_id, LTRIM(RTRIM(descr)) as descr')
                ->where('active_flag', '=', 'Y')
                ->get();

        return response()->json($result);
    }

    public function getColour($id){

        if ($id == 'ZN') {

            $result = DB::table('prod_color')
                    ->selectRaw('LTRIM(RTRIM(color_id)) as color_id, LTRIM(RTRIM(descr)) as descr')
                    ->whereIn('brand_id', ['ZN', 'JWZN'])
                    ->where('active_flag', '=', 'Y')
                    ->get();

            return response()->json($result);
        }

        else {

            $result = DB::table('prod_color')
                    ->selectRaw('LTRIM(RTRIM(color_id)) as color_id, LTRIM(RTRIM(descr)) as descr')
                    ->whereIn('brand_id', ['JW', 'JWZN'])
                    ->where('active_flag', '=', 'Y')
                    ->get();

            return response()->json($result);
        }


    }

    public function getProduct(Request $request){

        $where = "";
        $where.= "where a.quality_id = 'A' and a.pattern_id = '' and b.category_id = '01' and a.active_flag = 'Y'";

        if (isset($request->commodity)) {

            $where.= " and a.commodity_id = '$request->commodity'";

        }

        if (isset($request->brand)) {

            $where.= " and a.brand_id = '$request->brand'";

        }

        if (isset($request->coat)) {

            $where.= " and a.coat_mass = '$request->coat'";

        }

        if (isset($request->thick)) {

            $where.= " and a.thick = '$request->thick'";

        }

        if (isset($request->width)) {

            $where.= " and a.width = '$request->width'";

        }

        if (isset($request->grade)) {

            $where.= " and a.grade_id = '$request->grade'";

        }

        if (isset($request->colour)) {

            $where.= " and a.color_id = '$request->colour'";

        }

        $data = DB::select(DB::raw("select a.prod_code, a.descr, a.commodity_id, LTRIM(RTRIM(b.descr)) as commodity_descr,
                    a.brand_id, LTRIM(RTRIM(c.descr)) as brand_descr, a.coat_mass, LTRIM(RTRIM(d.brand_name)) as brand_coat,
                    a.thick, a.width, a.grade_id,
                    a.color_id, LTRIM(RTRIM(e.descr)) as color_descr from prod_spec a
                    JOIN commodity b on a.commodity_id = b.commodity_id
                    JOIN prod_brand c on a.brand_id = c.brand_id
                    JOIN brand_coat d on a.coat_mass = d.coat_mass
                    JOIN prod_color e on a.color_id = e.color_id"." ".$where));

        return response()->json($data);

    }

    public function cekHarga($id){

        $result = DB::table('price_list')
                    ->selectRaw('LTRIM(RTRIM(prod_spec.commodity_id)) as commodity_id, prod_spec.quality_id, prod_spec.prod_code, prod_spec.descr,
                    CAST(price_list.thick AS DECIMAL(10,2)) as thick, CAST(price_list.spc_price AS DECIMAL(10,2)) as spc_price, CAST(price_list.slit_cost AS DECIMAL(10,2)) as slit_cost')
                    ->join('prod_spec', function($join){
                        $join->on('prod_spec.mill_id', '=', 'price_list.mill_id');
                        $join->on('prod_spec.thick', '=', 'price_list.thick');
                        $join->on('prod_spec.coat_mass', '=', 'price_list.coat_mass');
                    })
                    ->where('prod_spec.prod_code', '=', $id)
                    ->where('prod_spec.quality_id', '=', 'A')
                    ->first();


        $commodity_id = $result->commodity_id;
        $spc_price = $result->spc_price;
        $thick = $result->thick;
        $slit_cost = $result->slit_cost;

        if($commodity_id == "SLT"){
            if ($thick < 0.4){
                $slit_cost = 0;
                $hasil = ( $spc_price/1.1 ) + $slit_cost;
            }
            else{
                $hasil = ( $spc_price/1.1 ) + $slit_cost;
            }
        }
        else{
            $hasil = $spc_price/1.1;
        }

        return response()->json(['hasil' => $hasil]);


    }

    public function getItemDetail(Request $request){

        $id = $request->id;
        $data = DB::select(DB::raw("SELECT LTRIM(RTRIM(a.mill_id)) as mill_id
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

        return \DataTables::of($data)

        ->addColumn('Action', function($data) {
            return  '
                <a href="javascript:void(0)" data-id1="'.$data->book_id.'" data-id2="'.$data->item_num.'" class="deleteItem" title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>
                ';
        })
        ->rawColumns(['Action'])
        ->make(true);

        // dd($data);
    }

    public function getItemDetail2(Request $request){

        $id = $request->id;
        $data = DB::select(DB::raw("SELECT LTRIM(RTRIM(a.mill_id)) as mill_id
                ,LTRIM(RTRIM(a.book_id)) as book_id
                ,a.item_num as item_num
                ,LTRIM(RTRIM(a.prod_code)) as prod_code
                ,COALESCE(LTRIM(RTRIM(b.descr)),'by Remark') as descr
                ,a.wgt as wgt_quo
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
                ,'' as req_ship_week
                from order_book_dtl a LEFT OUTER JOIN prod_spec b
                on a.prod_code = b.prod_code
                where a.book_id = '$id'"));

        return \DataTables::of($data)

        ->addColumn('Action', function($data) {
            return  '
                <a href="javascript:void(0)" data-id1="'.$data->book_id.'" data-id2="'.$data->item_num.'" class="deleteItem" title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </a>
                ';
        })
        ->rawColumns(['Action'])
        ->make(true);

        // dd($data);
    }

    public function saveOrderItem(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $bookId = Session::get('bookId');
        
        if (!$bookId){
            $bookId = 'SKU-'.substr($tr_date->format('Y'), -2).$tr_date->format('m').$tr_date->format('d').$tr_date->format('H').$tr_date->format('i').$tr_date->format('s');
        }
        $prod_code = $request->prod_code;
        if(!$prod_code){
            $prod_code = '';
        }
        $deliv_mode = $request->deliv_mode;
        if(!$deliv_mode){
            $deliv_mode = '';
        }
        $cust_name = $request->cust_name;
        if(!$cust_name){
            $cust_name = '';
        }
        $cust_address = $request->cust_address;
        if(!$cust_address){
            $cust_address = '';
        }
        $phone = $request->phone;
        if(!$phone){
            $phone = '';
        }
        $cons_id = $request->cons_id;
        if(!$cons_id){
            $cons_id = '';
        }
        $ship_to = $request->ship_to;
        if(!$ship_to){
            $ship_to = '';
        }
        $salesman_id = $request->salesman_id;
        if(!$salesman_id){
            $salesman_id = '';
        }
        $remark1 = $request->remark1;
        if (!$remark1){
            $remark1 = '';
        }
        $remark2 = $request->remark2;
        if (!$remark2){
            $remark2 = '';
        }
        $pay_term_id = $request->pay_term_id;
        if (!$pay_term_id){
            $pay_term_id = '';
        }
        $cust_po_num = $request->cust_po_num;
        if (!$cust_po_num){
            $cust_po_num = '';
        }
        $weight = $request->weight;
        if (!$weight){
            $weight = 0.00;
        }
        $unit_price = $request->unit_price;
        if (!$unit_price){
            $unit_price = 0.00;
        }
        $extra_price = $request->extra_price;
        if (!$extra_price){
            $extra_price = 0.00;
        }
        $amt_gross = $request->amt_gross;
        if (!$amt_gross){
            $amt_gross = 0.00;
        }
        $pct_disc = $request->pct_disc;
        if (!$pct_disc){
            $pct_disc = 0.00;
        }
        $amt_disc = $request->amt_disc;
        if (!$amt_disc){
            $amt_disc = 0.00;
        }
        $amt_net = $request->amt_net;
        if (!$amt_net){
            $amt_net = $amt_gross;
        }
        $atr_remark = $request->atr_remark;
        if (!$atr_remark){
            $atr_remark = '';
        }
        $appl_note = $request->appl_note;
        if (!$appl_note){
            $appl_note = '';
        }
        $req_date = $request->req_date;
        if (!$req_date){
            $req_date = '1900-01-01 00:00:00.000';
        }
        $req_week = $request->req_week;
        if (!$req_week){
            $req_week = '';
        }
        $req_month = $request->req_month;
        if (!$req_month){
            $req_month = '';
        }
        $req_year = $request->req_year;
        if (!$req_year){
            $req_year = '';
        }

        try{

            $checkHeader = DB::table('order_book_hdr')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->where('stat', '=', 'O')
                            ->first();

            if ($checkHeader){

                $header = DB::table('order_book_hdr')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->update([
                            'cust_id' => $request->cust_id,
                            'deliv_mode' => $deliv_mode,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'dt_modified' => $tr_date,
                            'pay_term_id' => $pay_term_id,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

                $seqNum = DB::table('order_book_dtl')
                        ->select('item_num')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->max('item_num');

                $item = DB::table('order_book_dtl')
                        ->where('book_id', '=', $bookId)
                        ->insert([
                            'mill_id' => $request->mill_id,
                            'book_id' => $bookId,
                            'item_num' => $seqNum + 1,
                            'prod_code' => $prod_code,
                            'unit_meas' => 'KG',
                            'curr_id' => 'IDR',
                            'wgt' => $weight,
                            'unit_price' => $unit_price,
                            'spc_strata' => $extra_price,
                            'amt_gross' => $amt_gross,
                            'amt_disc' => $amt_disc,
                            'pct_disc' => $pct_disc,
                            'amt_net' => $amt_net,
                            'remark' => $atr_remark,
                            'dt_req_ship' => $req_date,
                            'req_week' => $req_week,
                            'req_month' => $req_month,
                            'req_year' => $req_year,
                            'stat' => 'O',
                            'dt_created' => $tr_date,
                            'user_id' => $userid,
                            'aplikasi_note' => $appl_note
                        ]);

                $invoiceNo = $bookId;
                return response()->json(['response' => 'Item Added', 'invoiceNo' => $invoiceNo]);
            }

            else{
                $header = DB::table('order_book_hdr')
                        ->insert([
                            'mill_id' => $request->mill_id,
                            'book_id' => $bookId,
                            'tr_date' => $tr_date,
                            'cust_id' => $request->cust_id,
                            'deliv_mode' => $deliv_mode,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'stat' => 'O',
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'user_id' => $userid,
                            'pay_term_id' => $pay_term_id,
                            'dt_created' => $tr_date,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

                $item = DB::table('order_book_dtl')
                            ->insert([
                                'mill_id' => $request->mill_id,
                                'book_id' => $bookId,
                                'item_num' => 1,
                                'prod_code' => $prod_code,
                                'unit_meas' => 'KG',
                                'curr_id' => 'IDR',
                                'wgt' => $weight,
                                'unit_price' => $unit_price,
                                'spc_strata' => $extra_price,
                                'amt_gross' => $amt_gross,
                                'amt_disc' => $amt_disc,
                                'pct_disc' => $pct_disc,
                                'amt_net' => $amt_net,
                                'remark' => $atr_remark,
                                'dt_req_ship' => $req_date,
                                'req_week' => $req_week,
                                'req_month' => $req_month,
                                'req_year' => $req_year,
                                'stat' => 'O',
                                'dt_created' => $tr_date,
                                'user_id' => $userid,
                                'aplikasi_note' => $appl_note
                            ]);

                Session::put('bookId', $bookId);
                $invoiceNo = Session::get('bookId', $bookId);
                return response()->json(['response' => 'Item Added', 'invoiceNo' => $invoiceNo]);
            }

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function deleteOrderItem(Request $request){

        $i = 1;

        try{

            $del_dtl = DB::table('order_book_dtl')
                    ->where('book_id', '=', $request->book_id)
                    ->where('item_num', '=', $request->item_num)
                    ->delete();

            $check = DB::table('order_book_dtl')
                    ->select('item_num')
                    ->where('book_id', '=', $request->book_id)
                    ->pluck('item_num');

            $count = DB::table('order_book_dtl')
                    ->select('*')
                    ->where('book_id', '=', $request->book_id)
                    ->count();

            if ($count > 0) {

                foreach($check as $check) {

                    $update = DB::table('order_book_dtl')
                            ->where('book_id', '=', $request->book_id)
                            ->where('item_num', '=', $check)
                            ->update([
                                'item_num' => $i,
                            ]);
                    $i++;
                }
                return response()->json(['response' => 'Item Deleted']);

            }

            else {

                $del_hdr = DB::table('order_book_hdr')
                        ->where('book_id', '=', $request->book_id)
                        ->delete();

                return response()->json(['response' => 'All item has been deleted, order canceled']);

            }

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }


    }

    public function submitOrder(Request $request){

        $bookId = $request->book_id;
        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();

        try {

            $checkHeader = DB::table('order_book_hdr')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->first();

            if($checkHeader){

                $updateHeader = DB::table('order_book_hdr')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '=', 'O')
                                ->update([
                                    'stat' => 'P',
                                    'dt_posted' => $tr_date
                                ]);

                $updateDetail = DB::table('order_book_dtl')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '=', 'O')
                                ->update([
                                    'stat' => 'P',
                                    'dt_posted' => $tr_date
                                ]);

               if ($updateHeader && $updateDetail){
                    return response()->json(['response' => 'Order Submitted']);
                }
                else if (!$updateHeader && $updateDetail){
                    return response()->json(['response' => "Something error when update header order"]);
                }
                else if ($updateHeader && !$updateDetail){
                    return response()->json(['response' => "Something error when update detail order"]);
                }
                else {
                    return response()->json(['response' => "Failed to submit order"]);
                }

            }
            else {
                return response()->json(['response' => "Book Id not found"]);

            }
        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function deleteOrder(Request $request){

        $bookId = $request->book_id;
        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();

        try {

            $result = DB::table('order_book_hdr')
                            ->select('*')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->first();


            if($result){

                $stat = $result->stat;

                if($stat == "O" || $stat == "P"){

                    $updateHeader = DB::table('order_book_hdr')
                                    ->where('book_id', '=', $bookId)
                                    ->where('user_id', '=', $userid)
                                    ->whereIn('stat', ['O','P'])
                                    ->delete();

                    $updateDetail = DB::table('order_book_dtl')
                                    ->where('book_id', '=', $bookId)
                                    ->where('user_id', '=', $userid)
                                    ->whereIn('stat', ['O','P'])
                                    ->delete();

                    if ($updateHeader && $updateDetail){
                        return response()->json(['response' => 'Order Deleted']);
                    }
                    else if (!$updateHeader && $updateDetail){
                        return response()->json(['response' => "Something error when delete header order"]);
                    }
                    else if ($updateHeader && !$updateDetail){
                        return response()->json(['response' => "Something error when delete detail order"]);
                    }
                    else {
                        return response()->json(['response' => "Failed to delete order"]);
                    }

                }
                else if ($stat == "R" || $stat == "S" || $stat == "C"){
                    return response()->json(['response' => "Current status from this order make this order not possible to be deleted"]);

                }

            }
            else {
                return response()->json(['response' => "You can't delete this order, this is not an order you made"]);
            }

        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function confirmOrder(Request $request){

        $bookId = $request->book_id;
        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $tr_date = Carbon::now();

        try {

            $checkHeader = DB::table('order_book_hdr')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->where('stat', '=', 'R')
                            ->first();

            if($checkHeader){

                $totalOrder = DB::table('order_book_dtl')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->count();

                $countNotR = DB::table('order_book_dtl')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '<>', 'R')
                                ->count();

                $countR = DB::table('order_book_dtl')
                            ->where('book_id', '=', $bookId)
                            ->where('user_id', '=', $userid)
                            ->where('stat', '=', 'R')
                            ->count();

                    if ($totalOrder != $countR ) {

                        if ($groupid == 'CUSTOMER') {
                            return response()->json(['response' => 'From total of '.$totalOrder. ' items order, there are only '.$countR.' items whose prices have been confirmed, while '.$countNotR.' others have not. Pls kindly contacted our salesmman. Thankyou.']);
                        }

                        if ($groupid == 'SALES') {
                            return response()->json(['response' => 'From total of '.$totalOrder. ' items order, there are only '.$countR.' items whose prices have been confirmed, while '.$countNotR.' others have not. Pls kindly contacted our admin. Thankyou.']);
                        }
                        
                    }

                    else {


                        $updateHeader = DB::table('order_book_hdr')
                                ->where('book_id', '=', $bookId)
                                ->where('user_id', '=', $userid)
                                ->where('stat', '=', 'R')
                                ->update([
                                    'stat' => 'S',
                                    'dt_confirm' => $tr_date
                                ]);

                        $updateDetail = DB::table('order_book_dtl')
                                        ->where('book_id', '=', $bookId)
                                        ->where('user_id', '=', $userid)
                                        ->where('stat', '=', 'R')
                                        ->update([
                                            'stat' => 'S',
                                            'dt_confirm' => $tr_date
                                        ]);

                        if ($updateHeader && $updateDetail){
                            return response()->json(['response' => 'Order Confirmed']);
                        }
                        else if (!$updateHeader && $updateDetail){
                            return response()->json(['response' => "Something error when update header order"]);
                        }
                        else if ($updateHeader && !$updateDetail){
                            return response()->json(['response' => "Something error when update detail order"]);
                        }
                        else {
                            return response()->json(['response' => "Failed to confirm order"]);
                        }
                    }
            }
            else {
                return response()->json(['response' => "You can't confirm order, this is not an order you made"]);
            }
        }
        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }

    }

    public function editOrderItem($id){

        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $salesid  = Session::get('SALESID');
        $now = Carbon::now();
        $year_now =  $now->year;
        $a = $now->addYear(+10);
        $year_later = $a->year;

            try{

                $result = DB::table('order_book_hdr')
                        ->select('*')
                        ->where('book_id', '=', $id)
                        ->first();

                $createdBy = $result->user_id;
                $stat = $result->stat;

                if ($createdBy == $userid && $stat == "O") {

                    $book_id = $result->book_id;
                    $cust_id = $result->cust_id;
                    $deliv_mode = $result->deliv_mode;
                    $cust_name = $result->cust_name;
                    $cust_address = $result->cust_address;
                    $phone = $result->phone;
                    $cons_id = $result->cons_id;
                    $ship_to = $result->ship_to;
                    $salesman_id = $result->salesman_id;
                    $pay_term_id = $result->pay_term_id;
                    $proj_flag = $result->proj_flag;
                    $cust_po_num= $result->cust_po_num;
                    $remark1= $result->remark1;
                    $remark2= $result->remark2;


                    $strata = DB::table('customer')
                                ->selectRaw('LTRIM(RTRIM(strata)) as strata')
                                ->where('cust_id', '=', $cust_id)
                                ->value('strata');

                    $str1 = DB::table('customer')
                                ->selectRaw('LTRIM(RTRIM(str1)) as str1')
                                ->where('cust_id', '=', $cust_id)
                                ->value('str1');

                    $disc_loco = DB::table('customer')
                                ->selectRaw('disc_loco')
                                ->where('cust_id', '=', $cust_id)
                                ->value('disc_loco');            

                    if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT'){

                        $listsales = DB::table('salesman')
                                    ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                                    ->where('active_flag', '=', 'Y')
                                    ->get();

                                    return view('layouts.EditOrder',[
                                        'listsales' => $listsales,
                                        'book_id' => $book_id,
                                        'cust_id' => $cust_id,
                                        'deliv_mode' => $deliv_mode,
                                        'strata' => $strata,
                                        'cust_name' => $cust_name,
                                        'cust_address' => $cust_address,
                                        'phone' => $phone,
                                        'cons_id' => $cons_id,
                                        'ship_to' => $ship_to,
                                        'salesman_id' => $salesman_id,
                                        'pay_term_id' => $pay_term_id,
                                        'proj_flag' => $proj_flag,
                                        'cust_po_num' => $cust_po_num,
                                        'remark1' => $remark1,
                                        'remark2' => $remark2,
                                        'year_now' => $year_now,
                                        'year_later' => $year_later,
                                        'str1' => $str1,
                                        'disc_loco' => $disc_loco
                                        ]);
                    }
                    if ($groupid == 'SALES' || $groupid == 'CUSTOMER') {


                        $listsales = DB::table('salesman')
                                    ->selectRaw('LTRIM(RTRIM(salesman_id)) as salesman_id, LTRIM(RTRIM(salesman_name)) as salesman_name')
                                    ->where('salesman_id', '=', $salesid)
                                    ->where('active_flag', '=', 'Y')
                                    ->get();

                                    return view('layouts.EditOrder',[
                                        'listsales' => $listsales,
                                        'book_id' => $book_id,
                                        'cust_id' => $cust_id,
                                        'deliv_mode' => $deliv_mode,
                                        'strata' => $strata,
                                        'cust_name' => $cust_name,
                                        'cust_address' => $cust_address,
                                        'phone' => $phone,
                                        'cons_id' => $cons_id,
                                        'ship_to' => $ship_to,
                                        'salesman_id' => $salesman_id,
                                        'pay_term_id' => $pay_term_id,
                                        'proj_flag' => $proj_flag,
                                        'cust_po_num' => $cust_po_num,
                                        'remark1' => $remark1,
                                        'remark2' => $remark2,
                                        'year_now' => $year_now,
                                        'year_later' => $year_later,
                                        'str1' => $str1,
                                        'disc_loco' => $disc_loco
                                        ]);
                    }

                }
                else if ($createdBy != $userid && $stat != "O"){
                    return redirect('ListOrder')->with("alert", "This is not an order you made, status is not OPEN either");
                }
                else if ($stat != "O"){
                    return redirect('ListOrder')->with("alert", "Status of this order is not OPEN anymore");
                }
                else if ($createdBy != $userid){
                    return redirect('ListOrder')->with("alert", "You can't edit this order, this is not an order you made");
                }


            }
            catch(QueryException $ex){
                $error = $ex->getMessage();
                return response()->json(['response' => $error]);
            }

    }

    public function saveEditOrderItem(Request $request){

        $userid = Session::get('USERNAME');
        $tr_date = Carbon::now();
        $bookId = $request->book_id;
        $prod_code = $request->prod_code;
        if(!$prod_code){
            $prod_code = '';
        }
        $deliv_mode = $request->deliv_mode;
        if(!$deliv_mode){
            $deliv_mode = '';
        }
        $cust_name = $request->cust_name;
        if(!$cust_name){
            $cust_name = '';
        }
        $cust_address = $request->cust_address;
        if(!$cust_address){
            $cust_address = '';
        }
        $phone = $request->phone;
        if(!$phone){
            $phone = '';
        }
        $cons_id = $request->cons_id;
        if(!$cons_id){
            $cons_id = '';
        }
        $ship_to = $request->ship_to;
        if(!$ship_to){
            $ship_to = '';
        }
        $salesman_id = $request->salesman_id;
        if(!$salesman_id){
            $salesman_id = '';
        }
        $remark1 = $request->remark1;
        if (!$remark1){
            $remark1 = '';
        }
        $remark2 = $request->remark2;
        if (!$remark2){
            $remark2 = '';
        }
        $pay_term_id = $request->pay_term_id;
        if (!$pay_term_id){
            $pay_term_id = '';
        }
        $cust_po_num = $request->cust_po_num;
        if (!$cust_po_num){
            $cust_po_num = '';
        }
        $weight = $request->weight;
        if (!$weight){
            $weight = 0.00;
        }
        $extra_price = $request->extra_price;
        if (!$extra_price){
            $extra_price = 0.00;
        }
        $unit_price = $request->unit_price;
        if (!$unit_price){
            $unit_price = 0.00;
        }
        $amt_gross = $request->amt_gross;
        if (!$amt_gross){
            $amt_gross = 0.00;
        }
        $pct_disc = $request->pct_disc;
        if (!$pct_disc){
            $pct_disc = 0.00;
        }
        $amt_disc = $request->amt_disc;
        if (!$amt_disc){
            $amt_disc = 0.00;
        }
        $amt_net = $request->amt_net;
        if (!$amt_net){
            $amt_net = $amt_gross;
        }
        $atr_remark = $request->atr_remark;
        if (!$atr_remark){
            $atr_remark = '';
        }
        $appl_note = $request->appl_note;
        if (!$appl_note){
            $appl_note = '';
        }
        $req_date = $request->req_date;
        if (!$req_date){
            $req_date = '1900-01-01 00:00:00.000';
        }
        $req_week = $request->req_week;
        if (!$req_week){
            $req_week = '';
        }
        $req_month = $request->req_month;
        if (!$req_month){
            $req_month = '';
        }
        $req_year = $request->req_year;
        if (!$req_year){
            $req_year = '';
        }

        try{

                $checkHeader = DB::table('order_book_hdr')
                ->where('book_id', '=', $bookId)
                ->where('user_id', '=', $userid)
                ->where('stat', '=', 'O')
                ->first();

            if ($checkHeader) {

                $header = DB::table('order_book_hdr')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->update([
                            'cust_id' => $request->cust_id,
                            'deliv_mode' => $deliv_mode,
                            'cust_name' => $cust_name,
                            'phone' => $phone,
                            'cust_address' => $cust_address,
                            'cons_id' => $cons_id,
                            'ship_to' => $ship_to,
                            'salesman_id' => $salesman_id,
                            'remark1' => $remark1,
                            'remark2' => $remark2,
                            'dt_modified' => $tr_date,
                            'pay_term_id' => $pay_term_id,
                            'proj_flag' => $request->proj_flag,
                            'cust_po_num' => $cust_po_num
                        ]);

                $seqNum = DB::table('order_book_dtl')
                        ->select('item_num')
                        ->where('book_id', '=', $bookId)
                        ->where('user_id', '=', $userid)
                        ->where('stat', '=', 'O')
                        ->max('item_num');

                $item = DB::table('order_book_dtl')
                        ->where('book_id', '=', $bookId)
                        ->insert([
                            'mill_id' => $request->mill_id,
                            'book_id' => $bookId,
                            'item_num' => $seqNum + 1,
                            'prod_code' => $prod_code,
                            'unit_meas' => 'KG',
                            'curr_id' => 'IDR',
                            'wgt' => $weight,
                            'unit_price' => $unit_price,
                            'spc_strata' => $extra_price,
                            'amt_gross' => $amt_gross,
                            'amt_disc' => $amt_disc,
                            'pct_disc' => $pct_disc,
                            'amt_net' => $amt_net,
                            'remark' => $atr_remark,
                            'dt_req_ship' => $req_date,
                            'req_week' => $req_week,
                            'req_month' => $req_month,
                            'req_year' => $req_year,
                            'stat' => 'O',
                            'dt_created' => $tr_date,
                            'user_id' => $userid,
                            'aplikasi_note' => $appl_note
                        ]);

                return response()->json(['response' => 'Item Added']);
            }
        }
            catch(QueryException $ex){
                    $error = $ex->getMessage();
                    return response()->json(['response' => $error]);
            }

    }

    public function getPrice(Request $request){
        
        $txtStrata = $request->txtStrata;
        $txtCustID = $request->txtCustID;
        $txtStr1 = $request->txtStr1;
        $txtDelivMode = $request->txtDelivMode;
        $txtProduct = $request->txtProduct;

        try {

            $data = DB::select(DB::raw("SELECT '$txtCustID' as cust_id, '$txtStrata' as strata, '$txtStr1' str1, a.commodity_id, a.prod_code,
            a.series_id, a.thick, a.coat_mass, a.quality_id, 
            ifnull((select b.std_price from price_list b where b.series_id = a.series_id and a.thick = b.thick and
            a.coat_mass = b.coat_mass),0) as stdprice, 
            ifnull((select c.int2 from appl_constant c where c.key_id = 'STRATA' and c.str1 = '$txtStrata'),0) as DiskonStrata ,
            ifnull((select f.int2 from appl_constant f where f.key_id = 'QUALITY' and f.str1 = a.quality_id),0) as DiskonQuality ,
            ifnull((select d.int2 from appl_constant d where d.key_id = 'DELIV' and d.str1 =  '$txtStr1'),0) as Diskondeliv ,
            ifnull((select e.int2 from appl_constant e where e.key_id = 'SLITING' and e.str1 =  a.thick),0) as BiayaSlit
            from prod_spec a
            where category_id = 1  and a.prod_code = '$txtProduct'"));


            return response()->json($data);

        
        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }
    
    
    
    }

    public function getQuoteDetail(Request $request){

        $token = Session::get('token');
        
        $id = $request->id;

        $getStatus = DB::table('order_book_hdr')
                        ->select('stat')
                        ->where('book_id','=', $id)
                        ->value('stat');

        $getPOID = DB::table('order_book_hdr')
                    ->select('po_id')
                    ->where('book_id','=', $id)
                    ->value('po_id');

        $getQuoteID = DB::table('order_book_hdr')
                        ->select('quote_id')
                        ->where('book_id','=', $id)
                        ->value('var_value');


        if ($getStatus == "R") {

            $url = "https://svr01.kencana.org/service/api/getQuoteDetail?quote_id=".$getQuoteID;

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
                return view('layouts.ListOrder')->with('error','getQuoteDetail#:' . $err);
            }
            else {

                $response = json_decode($response);

                return \DataTables::of($response)
                ->addColumn('approval', function ($data) {
                    return '
                    <select name="approval" id="approval">
                        <option value="A-'.$data->quote_item.'" selected="selected">Confirm</option>
                        <option value="X-'.$data->quote_item.'">Reject</option>
                    </select>';
                })
                ->rawColumns(['approval'])
                ->make(true);

            }

        }

        else {

            $url = "https://svr01.kencana.org/service/api/getQuoteDetailConfirmed?quote_id=".$getQuoteID;

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
                return view('layouts.ListOrder')->with('error','getQuoteDetail#:' . $err);
            }
            else {

                $response = json_decode($response);

                return \DataTables::of($response)
                ->addColumn('approval', function ($data) {

                    if ($data->stat == "X")
                    return '
                    <span class="badge outline-badge-danger">REJECTED</span>';

                    else 
                    return '
                    <span class="badge outline-badge-primary">CONFIRMED</span>';

                })
                ->rawColumns(['approval'])
                ->make(true);

            }


        }
    
        
       
    }

    public function submitApproval(Request $request){

        $token = Session::get('token');
        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');
        $tr_date = Carbon::now();

        $id = $request->id;
        $listApproval = $request->listApproval;
        $countApproval = substr_count($listApproval,"A");
        $temp1_listApproval = explode(',', $listApproval);

        try {

            $getPOID = DB::table('order_book_hdr')
                        ->select('po_id')
                        ->where('book_id','=', $id)
                        ->value('po_id');

            $getQuoteID = DB::table('order_book_hdr')
                            ->select('quote_id')
                            ->where('book_id','=', $id)
                            ->value('var_value');


            foreach ($temp1_listApproval as $listApproval1) {


                $quote_item = substr($listApproval1, 2);
    
                $approval = $listApproval1[0];


                if ($approval == "A") {

                    $updateEachDetail = DB::table('order_book_dtl')
                                        ->where('book_id', '=', $id)
                                        ->where('user_id', '=', $userid)
                                        ->where('item_num', '=', $quote_item )
                                        ->update([
                                            'stat' => 'S',
                                            'dt_confirm' => $tr_date
                                        ]);

                }

                else {

                    $updateEachDetail = DB::table('order_book_dtl')
                                        ->where('book_id', '=', $id)
                                        ->where('user_id', '=', $userid)
                                        ->where('item_num', '=', $quote_item )
                                        ->update([
                                            'stat' => 'X',
                                            'dt_confirm' => $tr_date
                                        ]);

                }

    
            }

            if ($countApproval > 0) {

                $updateHeader = DB::table('order_book_hdr')
                                    ->where('book_id', '=', $id)
                                    ->where('user_id', '=', $userid)
                                    ->update([
                                        'stat' => 'S',
                                        'dt_confirm' => $tr_date
                                    ]);

            }

            else {

                $updateHeader = DB::table('order_book_hdr')
                                    ->where('book_id', '=', $id)
                                    ->where('user_id', '=', $userid)
                                    ->update([
                                        'stat' => 'X',
                                        'dt_confirm' => $tr_date
                                    ]);


            }

            $curl = curl_init();

            $data = [
                'poID' => $getPOID,
                'quoteID' => $getQuoteID,
                'listApproval' => $listApproval,
            ];

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://svr01.kencana.org/service/api/submitApproval",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
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
                return response()->json(['response' => 'Error:' . $err]);
            }
            else {

                $response = json_decode($response);
                $response = $response->message;
                return response()->json(['response' => $response]);

            }

        }

        catch(QueryException $ex){
            $error = $ex->getMessage();
            return response()->json(['response' => $error]);
        }




       







    }

    

    

}
