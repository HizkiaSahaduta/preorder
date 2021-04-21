<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cache;
use App\User;
use Hash;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(){
        
        $userid = Session::get('USERNAME');
        $groupid = Session::get('GROUPID');

        $month =  date("F", mktime(0, 0, 0, Carbon::now()->month, 1));
        $year =  Carbon::now()->year;
        $num_month =  Carbon::now()->month;

        if ($groupid == 'CUSTOMER') {

            $custid = Session::get('CUSTID');

            $cust_grp_id_tmp = DB::table('customer')
                                ->selectRaw('LTRIM(RTRIM(cust_grp_id)) as cust_grp_id')
                                ->where('cust_id', '=', $custid)
                                ->where('active_flag','=', 'Y')
                                ->groupBy('cust_grp_id')
                                ->value('cust_grp_id');

            $count_cust = DB::table('customer')
                            ->select('cust_id')
                            ->where('cust_grp_id', '=', $cust_grp_id_tmp)
                            ->where('active_flag','=', 'Y')
                            ->count();

            
            return view('layouts.home', ['userid' => $userid,'groupid' => $groupid,'custid' => $custid, 'count_cust' => $count_cust,'month' => $month,
            'num_month' => $num_month,
            'year' => $year]);

                       
        }

        if ($groupid == 'SALES') {

            $salesid = Session::get('SALESID');
            
            return view('layouts.home', ['userid' => $userid,'groupid' => $groupid,'salesid' => $salesid]);
                        
        }

        if ($groupid == 'DEVELOPMENT' || $groupid == 'MARKETING MANAGEMENT') {

            return view('layouts.home', ['userid' => $userid,'groupid' => $groupid]);

        }

        
    }

    // Dahsboard Customer
    public function customerDashboard (Request $request) { 

        $txtGroup = $request->txtGroup;
        $txtCustID = $request->txtCustID;

        if (!$txtCustID) {
            $txtCustID = Session::get('CUSTID');
        }

        $month =  date("F", mktime(0, 0, 0, Carbon::now()->month, 1));
        $year =  Carbon::now()->year;
        $num_month =  Carbon::now()->month;
        $NotShipYet = '';
        $UnpaidInv = '';
        $ReadyToShip = '';
        $Last12Mo = '';
     
        $cust_grp_id_tmp = DB::table('customer')
                            ->selectRaw('LTRIM(RTRIM(cust_grp_id)) as cust_grp_id')
                            ->where('cust_id', '=', $txtCustID)
                            ->where('active_flag','=', 'Y')
                            ->groupBy('cust_grp_id')
                            ->value('cust_grp_id');

        $count_cust = DB::table('customer')
                        ->select('cust_id')
                        ->where('cust_grp_id', '=', $cust_grp_id_tmp)
                        ->where('active_flag','=', 'Y')
                        ->count();

        $token = Session::get('token');
        $url = "https://svr01.kencana.org/service/api/dashboardOrderCustGroup?custid=".$txtCustID."&flag=Y";
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
            return view('layouts.home')->with('error','APIDashboard#:' . $err);
        }

        else {

            $custName = DB::table('customer')
                        ->selectRaw('LTRIM(RTRIM(cust_name)) as cust_name')
                        ->where('cust_id', '=', $txtCustID)
                        ->where('active_flag','=', 'Y')
                        ->value('cust_name');

            $data = json_decode($response);

            $NotShipYet = '
            <div class="icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </div>
            <h5 class="card-title">Undelivered Orders</h5>
            <h5 class="card-title">'.$data->order_blm_kirim_jml.'</h5>
            <hr class="style">
            <h5 class="card-title">Undelivered Orders (Wgt)</h5>
            <h5 class="card-title">'.$data->order_blm_kirim_wgt.'</h5>
            <p class="card-text">'.$custName.'</p>';

            $UnpaidInv = '
            <div class="icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <h5 class="card-title">Unpaid Invoices</h5>
            <h5 class="card-title">'.$data->inv_kurang_bayar_inv.'</h5>
            <hr class="style">
            <h5 class="card-title">Unpaid Invoices (IDR-Million)</h5>
            <h5 class="card-title">'.$data->inv_kurang_bayar_piutang.'</h5>
            <p class="card-text">'.$custName.'</p>';

            $ReadyToShip = '
            <div class="icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            </div>
            <h5 class="card-title">LPM (Ready to Ship)</h5>
            <h5 class="card-title">'.$data->siap_kirim_lpm.'</h5>
            <hr class="style">
            <h5 class="card-title">LPM (Ready to Ship - Wgt & IDR)</h5>
            <h5 class="card-title">'.$data->siap_kirim_wgt.' - (Million) '.$data->siap_kirim_idr.'</h5>
            <p class="card-text">'.$custName.'</p>';

            $Last12Mo = '
            
                <div class="invoice-box">
                    <div class="acc-total-info">
                        <h5>Invoices Last 12 Month (IDR-Million)</h5>
                        <p class="acc-amount">'.$data->inv_last_year_amt_total.'</p>
                    </div>

                    <div class="inv-detail">      
                        <div class="info-detail-1">
                            <p class="text-primary">Total Invoices</p>
                            <p class="text-primary">'.$data->inv_last_year_total_inv.'</p>
                        </div>                                  
                        <div class="info-detail-1">
                            <p class="text-warning">Total Paid</p>
                            <p class="text-warning">'.$data->inv_last_year_amt_paid.'</p>
                        </div>
                        <div class="info-detail-1">
                            <p class="text-danger">Total Debt</p>
                            <p class="text-danger">'.$data->inv_last_year_total_piutang.'</p>
                        </div>
                    </div>
                    
                </div>
                <p class="card-text">'.$custName.'</p>';
            
            $list_prod_last_year = $data->list_prod_last_year;

            return response()->json(['NotShipYet' => $NotShipYet,
                                    'UnpaidInv' => $UnpaidInv,
                                    'ReadyToShip' => $ReadyToShip,
                                    'Last12Mo'=> $Last12Mo,
                                    // 'list_order_blm_kirim_val' => $list_order_blm_kirim_val,
                                    'list_prod_last_year' => $list_prod_last_year,
                                    'month' => $month,
                                    'num_month' => $num_month,
                                    'year' => $year,
                                    'count' => $count_cust]);
            
        }



       
    }

    public function customerDashboardbyID (Request $request) { 

        $txtCustID  = $request->txtCustID ;

        $month =  date("F", mktime(0, 0, 0, Carbon::now()->month, 1));
        $year =  Carbon::now()->year;
        $num_month =  Carbon::now()->month;

        $result_amt_order = 0;
        $result_wgt_order = 0;
        $result_sum_order = 0;
        $list_order_value = '';

        $token = Session::get('token');
        $url = "https://svr01.kencana.org/service/api/dashboardOrderbyCustID?custid=".$txtCustID;
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
            return view('layouts.home')->with('error','APIDashboard#:' . $err);
        }

        else {

            $data = json_decode($response);

            $custName = DB::table('customer')
                    ->selectRaw('LTRIM(RTRIM(cust_name)) as cust_name')
                    ->where('cust_id', '=', $txtCustID)
                    ->where('active_flag','=', 'Y')
                    ->value('cust_name');

            $result_amt_order = '
            <div class="icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </div>
            <h5 class="card-title">Amount Order</h5>
            <h5 class="card-title">IDR. '.number_format($data->result_amt_order,0,",",".").'</h5>
            <p class="card-text">'.$month.', '.$year.'</p>
            <p class="card-text">'.$custName.'</p>';

            $result_wgt_order = '
            <div class="icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            </div>
            <h5 class="card-title">Weight Order</h5>
            <h5 class="card-title">'.number_format($data->result_wgt_order,0,",",".").' KG</h5>
            <p class="card-text">'.$month.', '.$year.'</p>
            <p class="card-text">'.$custName.'</p>';

            $result_sum_order = '
            <div class="icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </div>
            <h5 class="card-title">Total Order</h5>
            <h5 class="card-title">'.$data->result_sum_order.' Orders</h5>
            <p class="card-text">'.$month.', '.$year.'</p>
            <p class="card-text">'.$custName.'</p>';
            
            $list_item = $data->list_item;
            $list_order = $data->list_order;

                if ($list_order) {

                    foreach ($list_order as $list_order) {

                        $list_order_value .= '
                        <div class="item-timeline timeline-new">
                            <div class="t-dot">
                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            </div>
                            <div class="t-content">
                                <div class="t-uppercontent">
                                    <h5>'.$list_order->cust_name.'</h5>
                                </div>
                                <p>BookId: <strong class="chooseBookId badge outline-badge-primary" data-id="'.$list_order->book_id.'">'.$list_order->book_id.'</strong></p>
                                <p>BookId-DateCreation: '.$list_order->tr_date.'</p>
                                <p></p>
                                <p>OrderId: <strong class="chooseOrderId badge badge-dark" data-id="'.$list_order->order_id.'">'.$list_order->order_id.'</strong></p>
                                <p>OrderId-DateCreation: '.$list_order->dt_order.'</p>
                                <div class="tags">
                                    <p class="badge badge-success">PayTerm: '.$list_order->pay_term_id.'</p>
                                </div>
                            </div>
                        </div>';
                    }

                }

                else {

                    $list_order_value .= '
                    <div class="item-timeline timeline-new">
                        <div class="t-dot">
                            <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></div>
                        </div>
                        <div class="t-content">
                            <div class="t-uppercontent">
                                <h5>'.$custName.'</h5>
                            </div>
                            <p><strong class="text-danger">N/A</strong></p>
                        </div>
                    </div>';

                }

            return response()->json(['result_amt_order' => $result_amt_order,
                                    'result_wgt_order' => $result_wgt_order,
                                    'result_sum_order' => $result_sum_order,
                                    'list_item'=> $list_item,
                                    'list_order' => $list_order_value,
                                    'month' => $month,
                                    'num_month' => $num_month,
                                    'year' => $year]);
            
        }

    }
}
