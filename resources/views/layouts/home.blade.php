@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link href="{{ asset('outside/assets/css/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('outside/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" >
<link rel="stylesheet" type="text/css" href="{{ asset('outside/assets/css/widgets/modules-widgets.css') }}">    
<link href="{{ asset('outside/assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('outside/assets/css/widgets/modules-widgets.css') }}"> 
<style>
hr.style {
  border-top: 1px dashed #888ea8;
}

.component-card_1 {
    border: 1px solid #e0e6ed;
    border-radius: 6px;
    width: auto;
    margin: 0 auto;
    box-shadow: 4px 6px 10px -3px #bfc9d4;
}

.widget-account-invoice-one .invoice-box h5 {
    text-align: center;
    font-size: 11px;
    letter-spacing: 1px;
    margin-bottom: 8px;
    color: #1b55e2;
}

.widget-account-invoice-one .invoice-box .acc-amount {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 0;
    color: #009688;
}

.widget-account-invoice-one .invoice-box [class*="info-detail-"]:not(.info-sub) p {
    margin-bottom: 10px;
    font-weight: 700;
    font-size: 13px;
}

.component-card_1 .card-text {
    color: #888ea8;
    font-size: 12px;
}

.component-card_1 .card-title {
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

@media (max-width:1366px) {

    .badge {
        font-size: 9px;  
    }

    .input-group-text {
        font-size: 0.75rem;
    }

    .table > tbody > tr > td {
        font-size: 10px;
    }

    .table > thead > tr > th {
        font-size: 10px;
    }

    div.dataTables_wrapper div.dataTables_info {
        font-size: 10px; 
    }

    .widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
        font-size: 12px;
        letter-spacing: 0;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .widget-activity-three .timeline-line .item-timeline .t-content p {
        margin-bottom: 2px;
        font-size: 11px;
        font-weight: 500;
        color: #888ea8;
    }

    .widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge {
        padding: 2px 4px;
        font-size: 10px;
        letter-spacing: 1px;
        transform: none;
    }


    .widget-activity-three .mt-container {
        position: relative;
        /* height: 325px; */
        overflow: auto;
        /* padding: 0 12px 0 12px; */
    }

    .widget-table-one .transactions-list .t-item .t-name h4 {
        font-size: 12px;
        letter-spacing: 0px;
        font-weight: 600;
        margin-bottom: 0;
    }

    .widget-table-one .transactions-list .t-item .t-name .meta-date {
        font-size: 10px;
        margin-bottom: 0;
        font-weight: 600;
        color: #888ea8;
    }

    .widget-table-one .transactions-list .t-item .t-rate p {
        margin-bottom: 0;
        font-size: 8px;
        letter-spacing: 0px;
    }

    .row [class*="col-"] .widget .widget-header h4 {
        color: #3b3f5c;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        padding: 16px 15px;
    }

    .widget.widget-activity-three .widget-heading h5 {
        font-size: 15px;
        display: block;
        color: #0e1726;
        font-weight: 600;
        margin-bottom: 0;
    }

    .widget.widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
        font-size: 12px !important;
    }

    .listCust {
        font-size: 11px;
    }

    .widget.widget-activity-three .timeline-line .item-timeline .t-content p {
        margin-bottom: 9px;
        font-size: 11px;
        font-weight: 500;
        color: #888ea8;
    }
    .component-card_1, .component-card_2, .component-card_3 {
        width: auto;
    }

    .component-card_1 .card-title {
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0px;
        margin-bottom: 10px;
    }
    .component-card_1 .card-text {
        color: #888ea8;
        font-size: 12px;
    }

    .widget-account-invoice-one .invoice-box h5 {
        text-align: center;
        font-size: 10px;
        letter-spacing: 1px;
        margin-bottom: 10px;
        color: #1b55e2;
    }

    .widget-account-invoice-one .invoice-box .acc-amount {
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 0;
        color: #009688;
    }

    .widget-account-invoice-one .invoice-box [class*="info-detail-"]:not(.info-sub) p {
        margin-bottom: 11px;
        font-weight: 700;
        font-size: 10px;
    }
    
    
}

@media (max-width:992px){

    .badge {
        font-size: 9px;  
    }

    .input-group-text {
        font-size: 0.75rem;
    }

    .table > tbody > tr > td {
        font-size: 10px;
    }

    .table > thead > tr > th {
        font-size: 10px;
    }

    div.dataTables_wrapper div.dataTables_info {
        font-size: 10px; 
    }

    .widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
        font-size: 12px;
        letter-spacing: 0;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .widget-activity-three .timeline-line .item-timeline .t-content p {
        margin-bottom: 2px;
        font-size: 11px;
        font-weight: 500;
        color: #888ea8;
    }

    .widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge {
        padding: 2px 4px;
        font-size: 10px;
        letter-spacing: 1px;
        transform: none;
    }


    .widget-activity-three .mt-container {
        position: relative;
        /* height: 325px; */
        overflow: auto;
        /* padding: 0 12px 0 12px; */
    }

    .widget-table-one .transactions-list .t-item .t-name h4 {
        font-size: 12px;
        letter-spacing: 0px;
        font-weight: 600;
        margin-bottom: 0;
    }

    .widget-table-one .transactions-list .t-item .t-name .meta-date {
        font-size: 10px;
        margin-bottom: 0;
        font-weight: 600;
        color: #888ea8;
    }

    .widget-table-one .transactions-list .t-item .t-rate p {
        margin-bottom: 0;
        font-size: 8px;
        letter-spacing: 0px;
    }

    .row [class*="col-"] .widget .widget-header h4 {
        color: #3b3f5c;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        padding: 16px 15px;
    }

    .widget.widget-activity-three .widget-heading h5 {
        font-size: 15px;
        display: block;
        color: #0e1726;
        font-weight: 600;
        margin-bottom: 0;
    }

    .widget.widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
        font-size: 12px !important;
    }

    .listCust {
        font-size: 11px;
    }

    .widget.widget-activity-three .timeline-line .item-timeline .t-content p {
        margin-bottom: 9px;
        font-size: 11px;
        font-weight: 500;
        color: #888ea8;
    }
    .component-card_1, .component-card_2, .component-card_3 {
        width: auto;
    }

    .component-card_1 .card-title {
        font-size: 14px;
        font-weight: 900;
        letter-spacing: 0px;
        margin-bottom: 10px;
    }
    .component-card_1 .card-text {
        color: #888ea8;
        font-size: 12px;
    }

    .widget-account-invoice-one .invoice-box h5 {
        text-align: center;
        font-size: 11px;
        letter-spacing: 1px;
        margin-bottom: 10px;
        color: #1b55e2;
    }

    .widget-account-invoice-one .invoice-box .acc-amount {
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 0;
        color: #009688;
    }

    .widget-account-invoice-one .invoice-box [class*="info-detail-"]:not(.info-sub) p {
        margin-bottom: 10px;
        font-weight: 700;
        font-size: 10px;
    }
}

@media (min-width:576px) and (max-width:992px){

    .badge {
        font-size: 9px;  
    }

    .input-group-text {
        font-size: 0.75rem;
    }

    .table > tbody > tr > td {
        font-size: 10px;
    }

    .table > thead > tr > th {
        font-size: 10px;
    }

    div.dataTables_wrapper div.dataTables_info {
        font-size: 10px; 
    }

    .widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
        font-size: 12px;
        letter-spacing: 0;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .widget-activity-three .timeline-line .item-timeline .t-content p {
        margin-bottom: 2px;
        font-size: 11px;
        font-weight: 500;
        color: #888ea8;
    }

    .widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge {
        padding: 2px 4px;
        font-size: 10px;
        letter-spacing: 1px;
        transform: none;
    }


    .widget-activity-three .mt-container {
        position: relative;
        /* height: 325px; */
        overflow: auto;
        /* padding: 0 12px 0 12px; */
    }

    .widget-table-one .transactions-list .t-item .t-name h4 {
        font-size: 12px;
        letter-spacing: 0px;
        font-weight: 600;
        margin-bottom: 0;
    }

    .widget-table-one .transactions-list .t-item .t-name .meta-date {
        font-size: 10px;
        margin-bottom: 0;
        font-weight: 600;
        color: #888ea8;
    }

    .widget-table-one .transactions-list .t-item .t-rate p {
        margin-bottom: 0;
        font-size: 8px;
        letter-spacing: 0px;
    }

    .row [class*="col-"] .widget .widget-header h4 {
        color: #3b3f5c;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        padding: 16px 15px;
    }

    .widget.widget-activity-three .widget-heading h5 {
        font-size: 15px;
        display: block;
        color: #0e1726;
        font-weight: 600;
        margin-bottom: 0;
    }

    .widget.widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
        font-size: 12px !important;
    }

    .listCust {
        font-size: 11px;
    }

    .widget.widget-activity-three .timeline-line .item-timeline .t-content p {
        margin-bottom: 9px;
        font-size: 11px;
        font-weight: 500;
        color: #888ea8;
    }
    .component-card_1, .component-card_2, .component-card_3 {
        width: auto;
    }

    .component-card_1 .card-title {
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 0px;
        margin-bottom: 10px;
    }
    .component-card_1 .card-text {
        color: #888ea8;
        font-size: 10px;
    }

    .widget-account-invoice-one .invoice-box h5 {
        text-align: center;
        font-size: 11px;
        letter-spacing: 1px;
        margin-bottom: 10px;
        color: #1b55e2;
    }

    .widget-account-invoice-one .invoice-box .acc-amount {
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 0;
        color: #009688;
    }

    .widget-account-invoice-one .invoice-box [class*="info-detail-"]:not(.info-sub) p {
        margin-bottom: 10px;
        font-weight: 700;
        font-size: 10px;
    }
}


</style>
@endsection
{{-- Content CSS End--}}

{{-- Content Navbar Content Begin--}}
@section('navbar_content')
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('home') }}">Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto ">
			<li class="nav-item more-dropdown">
				<div class="dropdown  custom-dropdown-icon">
					<a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Hello, {{ Auth::user()->name1 }}</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">

                        @if(session()->has('mnuMyAccount'))
                        <a class="dropdown-item" data-value="UserProfile" href="{{ url('MyAccount') }}">My Account</a>
                        @endif

                        @if(session()->has('mnuMyAccount'))
                        <a class="dropdown-item" data-value="UserProfile" href="{{ url('ChangePass') }}">Change Password</a>
                        @endif

						<a class="dropdown-item" data-value="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
					</div>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>

				</div>
			</li>
        </ul>

    </header>
</div>
@endsection
{{-- Content Navbar Content End--}}


{{-- Content Page Begin--}}
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

      
       
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="card component-card_1">
                <div class="card-body" id="NotShipYet">    

                    <div class="icon-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    </div>
                    <h5 class="card-title" style="font-size: 20px">Live Orders</h5>
                    <div class="widget-account-invoice-one">
                        <div class="invoice-box">
                            <div class="inv-detail">      
                                <div class="info-detail-1">
                                    <p class="text-primary">Numbers of Orders</p>
                                    <p class="text-primary">0</p>
                                </div>                                  
                                <div class="info-detail-1">
                                    <p class="text-primary">Weight</p>
                                    <p class="text-primary">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-text text-danger">N/A</p>
                    
                </div>
            </div>
        </div>    
        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="card component-card_1">
                <div class="card-body" id="UnpaidInv">

                    <div class="icon-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <h5 class="card-title" style="font-size: 20px">Account Deb</h5>
                    <div class="widget-account-invoice-one">
                        <div class="invoice-box">
                            <div class="inv-detail">      
                                <div class="info-detail-1">
                                    <p class="text-primary">Numbers of Invoices</p>
                                    <p class="text-primary">0</p>
                                </div>                                  
                                <div class="info-detail-1">
                                    <p class="text-primary">IDR-Million</p>
                                    <p class="text-primary">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-text text-danger">N/A</p>

                </div>
            </div>
        </div>    


        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="card component-card_1">
                <div class="card-body" id="ReadyToShip">    

                    <div class="icon-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    
                    <h5 class="card-title" style="font-size: 20px">PPP (Coil Ready)</h5>
                    <div class="widget-account-invoice-one">
                        <div class="invoice-box">
                            <div class="inv-detail">      
                                <div class="info-detail-1">
                                    <p class="text-primary">Numbers of PPP</p>
                                    <p class="text-primary">0</p>
                                </div>                                  
                                <div class="info-detail-1">
                                    <p class="text-primary">Weight</p>
                                    <p class="text-primary">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-text text-danger">N/A</p>

                </div>
            </div>
        </div> 
        
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="card component-card_1">
                <div class="card-body">
            
                    <div class="widget-account-invoice-one" id="Last12Mo">


                        <div class="invoice-box">
                            <div class="acc-total-info">
                                <h5>Last 12 Month</h5>
                                <h5>IDR-Million</h5>
                                {{-- <p class="acc-amount text-danger">0</p> --}}
                            </div>

                            <div class="inv-detail">      
                                <div class="info-detail-1">
                                    <p class="text-primary">Total</p>
                                    <p class="text-primary">0</p>
                                </div>                                  
                                <div class="info-detail-1">
                                    <p class="text-warning">Total Paid</p>
                                    <p class="text-warning">0</p>
                                </div>
                                <div class="info-detail-1">
                                    <p class="text-danger">Total Debt</p>
                                    <p class="text-danger">0</p>
                                </div>
                            </div>
                            
                        </div>
                        <p class="card-text text-danger">N/A</p>
                        
                    </div>
                </div>
            </div>
        </div>   


        {{-- ################################################################## --}}

        {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-activity-three">
                <div class="widget-heading">
                    <h5 class="">List Order Not Shipping Yet</h5>.
                </div>
                <div class="widget-content">
                    <div class="mt-container mx-auto">
                        <div class="timeline-line" id="ListNotShipYet">                                 
                        </div>                                    
                    </div>
                </div>
            </div>
        </div> --}}


        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-activity-three">
                <div class="widget-heading">
                    <h5 class="">Amount and Weight Order Summary (Last 12 Month)</h5>
                    {{-- <p class="badge badge-primary">by Cust.Group</p> --}}
                </div>
                <div class="widget-content">
                    <div class="mt-container mx-auto">
                        <div class="timeline-line"> 
                            {{-- <div class="item-timeline timeline-new" id="ResultAmtOrder">

                                <div class="t-dot">
                                    <div class="t-info"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                </div>
                                <div class="t-content">
                                    <div class="t-uppercontent">
                                        <h5>Amount Order (/item)</h5>
                                    </div>
                                </div>

                            </div> --}}

                            {{-- <div class="widget-content">
                                <div id="chartContainer1" style="height: 225px; width: 100%;"></div>
                            </div>
                            --}}
                            <div class="item-timeline timeline-new" id="ResultWgtOrder">

                                <div class="t-dot">
                                    <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                    </div>
                                </div>
                                <div class="t-content">
                                    <div class="t-uppercontent">
                                        <h5>Weight Order (/item)</h5>
                                        {{-- <span class="listCust">{{ $month }}, {{ $year }}</span> --}}
                                    </div>
                                </div>
                                
                            </div>

                            <div class="widget-content">
                                <div id="chartContainer2" style="height: 225px; width: 100%;"></div>
                            </div>                                                               
                        </div>                                    
                    </div>
                </div>
            </div>
        </div>

        {{-- ################################################################## --}}

        @if(Session::get('GROUPID') != 'CUSTOMER')

            <div class="col-lg-12 col-md-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Welcome
                                    {{ Session::get('NAME1') }}
                                    {{ Session::get('NAME2') }}
                                    {{ Session::get('NAME3') }}
                                    {{-- @if(session()->has('MILLID'))
                                        {{ Session::get('MILLID') }}
                                    @endif --}}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-area">
                        <div class="infobox-3" style="margin-left: 0px">
                            <div class="info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            </div>
                            <h5 class="info-heading">SunriseWeb</h5>
                            <p class="info-text">Customer Order Online</p>
                            <p class="info-text">You can place your own order
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                            </p>
                            <hr class="style">
                            <h5 class="info-heading">Quick Links</h5>

                            @if(Session::get('GROUPID') != 'CUSTOMER')
                            <a class="shadow-none badge badge-info" href="{{ url('CustReg') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                Cust. Registration
                            </a>
                            <br>
                            <br>
                            @endif
                            <a class="shadow-none badge badge-success" href="{{ url('CreateOrder') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                Create Order
                            </a>
                            <br>
                            <br>
                            <a class="shadow-none badge badge-warning" href="{{ url('ListOrder') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                List Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @endif


    </div>
</div>

<div class="modal fade" id="TrackingOrder" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" id="modalLoad">
            <div class="modal-header" id="headerModal">
            </div>
			<div class="modal-body">
                
			
			</div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
		</div>
	</div>
</div>


@endsection
{{-- Content Page End--}}

{{-- Content Page JS Begin--}}
@section('contentjs')
<script src="{{ asset('outside/plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('outside/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" crossorigin="anonymous"></script>
<script src="{{ asset('canvasjs.min.js') }}"></script>

@if(\Session::has('success'))
    <script>
        var success = "{{ Session::get('success') }}"
        Snackbar.show({
            text: success,
            pos: 'top-center'
        });

    </script>
@endif

<script>
var x = window.matchMedia("(min-width: 480px)")
var txtGroup, txtSalesid, txtCustID;


function blockUI(){

    $.blockUI({
        message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Loading</span>',
        fadeIn: 100,
        overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            zIndex: 1201,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
}

function blockModal(block){

    $(block).block({
        centerY: false,
        centerX: false,
        message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            padding: '40px 15px',
            backgroundColor: 'transparent'
        }
    });
}

function blockElement(block){

    $(block).block({
        message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
        centerX: 0,
        centerY: 0,
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            width: 35,
            top: '10px',
            left: '',
            right: '10px',
            bottom: 0,
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });

}

function addSymbols(e) {
	var suffixes = ["", "K", "M", "B"];
	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

	if(order > suffixes.length - 1)
		order = suffixes.length - 1;

	var suffix = suffixes[order];
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

function showDefaultText(chart, text) {
  var dataPoints = chart.options.data[0].dataPoints;
  var isEmpty = !(dataPoints && dataPoints.length > 0);

  if (!isEmpty) {
    for (var i = 0; i < dataPoints.length; i++) {
      isEmpty = !dataPoints[i].y;
      if (!isEmpty)
        break;
    }
  }

  if (!chart.options.subtitles)
    chart.options.subtitles = [];
  if (isEmpty) {
    chart.options.subtitles.push({
      text: text,
      verticalAlign: 'center',
    });
    chart.options.data[0].showInLegend = false;
  } else {
    chart.options.data[0].showInLegend = true;
  }
}

function getChart(dt, container, title, name){
    var chart = new CanvasJS.Chart(container, {
	    animationEnabled: true,
        theme: "light2",
        axisY: {
            crosshair: {
			    enabled: true,
                snapToDataPoint: true
		    },
            title: title,
            labelFormatter: addSymbols,
        },
        toolTip:{
		    shared:true
	    },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries,
	    },
        data: [
            {
                type: "area",
                name: name,
                showInLegend: true,
                // indexLabel: "{y}",
                indexLabelPlacement: "outside",
                indexLabelOrientation: "horizontal",
                // indexLabelFontColor: "#fff",
                indexLabelFontSize: 10,
                indexLabelFontFamily: "calibri",
                color: "#00b7c2", //ijo
                // yValueFormatString: "#,###,,,.##"
            }
        ]
    });
    chart.options.data[0].dataPoints = dt;
    showDefaultText(chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 10;
        }
        chart.render();
    }
    chart.render();
}

function customerDashboard(txtGroup, txtCustID){

       
    blockUI();

    $.ajax({
        type: "POST",
        url: "{{ url('customerDashboard') }}",
        // async: false,
        data: {
            '_token': '{{ csrf_token() }}',
            'txtGroup': txtGroup,
            'txtCustID': txtCustID
        },
        success: function(data) {

            if (txtCustID) {

                var refresh = document.getElementById("divRefresh")
                refresh.style.display = "block";

            }

            var count = parseInt(data['count']);

            if (count > 1) {

                $('#ListCustomer').html(data['list_customer']);
                $('#NotShipYet').html(data['NotShipYet']);
                $('#UnpaidInv').html(data['UnpaidInv']);
                $('#ReadyToShip').html(data['ReadyToShip']);
                $('#Last12Mo').html(data['Last12Mo']);
                // $('#ListNotShipYet').html(data['list_order_blm_kirim_val']);

               if (data['list_prod_last_year'].length > 0) {

                    var dp1 =  [];
                    var dp2 =  [];
                    for (var i = 0; i < data['list_prod_last_year'].length; i++) {

                        dp1.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].amt_total) });
                        dp2.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].wgt) });

                    }
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }
                else {

                    var dp1 =  [];
                    var dp2 =  [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }

            }

            else {


                $('#NotShipYet').html(data['NotShipYet']);
                $('#UnpaidInv').html(data['UnpaidInv']);
                $('#ReadyToShip').html(data['ReadyToShip']);
                $('#Last12Mo').html(data['Last12Mo']);
                // $('#ListNotShipYet').html(data['list_order_blm_kirim_val']);
               

                if (data['list_prod_last_year'].length > 0) {

                    var dp1 =  [];
                    var dp2 =  [];
                    for (var i = 0; i < data['list_prod_last_year'].length; i++) {

                        dp1.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].amt_total) });
                        dp2.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].wgt) });

                    }
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();
            
                }
                else {

                    var dp1 =  [];
                    var dp2 =  [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }

            }
        }
    });


}

function customerDashboardPerCust(txtGroup, txtCustID){

    blockUI();

    $.ajax({
        type: "POST",
        url: "{{ url('customerDashboard') }}",
        // async: false,
        data: {
            '_token': '{{ csrf_token() }}',
            'txtGroup': txtGroup,
            'txtCustID': txtCustID
        },
        success: function(data) {

            if (txtCustID) {

                var refresh = document.getElementById("divRefresh")
                refresh.style.display = "block";

            }

            var count = parseInt(data['count']);

            if (count > 1) {

                $('#ListCustomer').html(data['list_customer']);
                $('#NotShipYet').html(data['NotShipYet']);
                $('#UnpaidInv').html(data['UnpaidInv']);
                $('#ReadyToShip').html(data['ReadyToShip']);
                $('#Last12Mo').html(data['Last12Mo']);
                // $('#ListNotShipYet').html(data['list_order_blm_kirim_val']);

               if (data['list_prod_last_year'].length > 0) {

                    var dp1 =  [];
                    var dp2 =  [];
                    for (var i = 0; i < data['list_prod_last_year'].length; i++) {

                        dp1.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].amt_total) });
                        dp2.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].wgt) });

                    }
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }
                else {

                    var dp1 =  [];
                    var dp2 =  [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }

            }

            else {


                $('#NotShipYet').html(data['NotShipYet']);
                $('#UnpaidInv').html(data['UnpaidInv']);
                $('#ReadyToShip').html(data['ReadyToShip']);
                $('#Last12Mo').html(data['Last12Mo']);
                // $('#ListNotShipYet').html(data['list_order_blm_kirim_val']);
               

                if (data['list_prod_last_year'].length > 0) {

                    var dp1 =  [];
                    var dp2 =  [];
                    for (var i = 0; i < data['list_prod_last_year'].length; i++) {

                        dp1.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].amt_total) });
                        dp2.push({  label: data['list_prod_last_year'][i].descr,  y: parseInt(data['list_prod_last_year'][i].wgt) });

                    }
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }
                else {

                    var dp1 =  [];
                    var dp2 =  [];
                    dp1.push({ y: 0 });
                    dp2.push({ y: 0 });
                    var container  = "chartContainer1";
                    var container2  = "chartContainer2";
                    var title1 = "IDR";
                    var title2 = "KG";
                    var name1 = "AmtOrder";
                    var name2 = "WgtOrder";
                    // getChart(dp1, container, title1, name1);
                    getChart(dp2, container2, title2, name2);
                    $.unblockUI();

                }

            }

        }
    });


}


$(document).ready(function() {

    $('.basic').on('select2:open', function() {
        if (Modernizr.touch) {
            $('.select2-search__field').prop('focus', false);
        }
    });


    @if(Session::get('GROUPID') == 'CUSTOMER')

        txtGroup = '{{ Session::get('GROUPID') }}';   

        var dp1 =  [];
        var dp2 =  [];
        dp1.push({ y: 0 });
        dp2.push({ y: 0 });
        var container  = "chartContainer1";
        var container2  = "chartContainer2";
        var title1 = "IDR";
        var title2 = "KG";
        var name1 = "AmtOrder";
        var name2 = "WgtOrder";
        // getChart(dp1, container, title1, name1);
        getChart(dp2, container2, title2, name2);

        customerDashboard(txtGroup, txtCustID);

    
    @endif

    $('body').on('click', '.chooseCustomer', function(e) {

        txtCustID = $(this).data('id');
        customerDashboardPerCust(txtGroup, txtCustID);
        
    });

    $('#refresh').on('click', function() {

        window.location.href = "{{ url('home') }}";

    });


    

});

</script>

@endsection
{{-- Content Page JS End--}}
