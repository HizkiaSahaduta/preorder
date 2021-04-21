@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('outside/assets/css/components/custom-modal.css') }}"  />
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('outside/assets/css/widgets/modules-widgets.css') }}">     --}}
<link href="{{ asset('outside/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ asset('outside/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" /> --}}
<style>

.text-success {
    color: #28a745!important;
}

.text-danger {
    color: #dc3545!important;
}

.text-info {
    color: #17a2b8!important;
}

.text-white {
    color: #ffffff!important;
}

/*
==================
    Transaction
==================
*/
.widget-table-one .widget-heading {
  display: flex; }

.widget-table-one .transactions-list {
  padding: 12px 12px;
  /* border: 1px dashed #bfc9d4; */
  border-radius: 6px;
  -webkit-transition: all 0.1s ease;
  transition: all 0.1s ease; }
  .widget-table-one .transactions-list:not(:last-child) {
    margin-bottom: 15px; }
  .widget-table-one .transactions-list:hover {
    -webkit-transform: translateY(-1px) scale(1.01);
    transform: translateY(-1px) scale(1.01); }
  .widget-table-one .transactions-list .t-item {
    display: flex;
    justify-content: space-between; }
    .widget-table-one .transactions-list .t-item .t-company-name {
      display: flex; }
    .widget-table-one .transactions-list .t-item .t-icon {
      margin-right: 12px; }
      .widget-table-one .transactions-list .t-item .t-icon .avatar {
        position: relative;
        display: inline-block;
        width: 38px;
        height: 38px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 1px; }
        .widget-table-one .transactions-list .t-item .t-icon .avatar .avatar-title {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 100%;
          height: 100%;
          background-color: #ffe1e2;
          color: #e7515a; }
      .widget-table-one .transactions-list .t-item .t-icon .icon {
        position: relative;
        display: inline-block;
        padding: 10px;
        background-color: #ffeccb;
        border-radius: 50%; }
        .widget-table-one .transactions-list .t-item .t-icon .icon svg {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 19px;
          height: 19px;
          color: #e2a03f;
          stroke-width: 2; }
    .widget-table-one .transactions-list .t-item .t-name {
      align-self: center; }
      .widget-table-one .transactions-list .t-item .t-name h4 {
        font-size: 15px;
        letter-spacing: 0px;
        font-weight: 600;
        margin-bottom: 0; }
      .widget-table-one .transactions-list .t-item .t-name .meta-date {
        font-size: 12px;
        margin-bottom: 0;
        font-weight: 600;
        color: #888ea8; }
    .widget-table-one .transactions-list .t-item .t-rate {
      align-self: center;
      font-weight: 600; }
      .widget-table-one .transactions-list .t-item .t-rate p {
        margin-bottom: 0;
        font-size: 13px;
        letter-spacing: 0px; }
      .widget-table-one .transactions-list .t-item .t-rate svg {
        width: 14px;
        height: 14px;
        vertical-align: baseline; }
      .widget-table-one .transactions-list .t-item .t-rate.rate-inc p, .widget-table-one .transactions-list .t-item .t-rate.rate-inc svg {
        color: #009688; }
      .widget-table-one .transactions-list .t-item .t-rate.rate-dec p, .widget-table-one .transactions-list .t-item .t-rate.rate-dec svg {
        color: #e7515a; }

/*
==================
    End Transaction
==================
*/

/*
========================
    Timeline
========================
*/

.widget.widget-activity-three {
    position: relative;
    background: #fff;
    border-radius: 8px;
    height: 100%;
}
.widget.widget-activity-three .widget-heading {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px dashed #e0e6ed;
    padding: 20px 20px;
    padding-bottom: 20px;
}
.widget.widget-activity-three .widget-heading h5 {
    font-size: 17px;
    display: block;
    color: #0e1726;
    font-weight: 600;
    margin-bottom: 0;
}
.widget-activity-three .widget-content {
    /* padding: 20px 10px 20px 20px; */
    padding: 0px 0px 0px 0px;

}
.widget-activity-three .mt-container {
    position: relative;
    /* height: 325px; */
    overflow: auto;
    padding: 0 12px 0 12px;
}
.widget-activity-three .timeline-line .item-timeline { display: flex;
    margin-bottom: 20px; }
.widget-activity-three .timeline-line .item-timeline .t-dot { position: relative; }

.widget-activity-three .timeline-line .item-timeline .t-dot div {
    background: #1b55e2;
    border-radius: 50%;
    padding: 5px;
    margin-right: 11px;
    display: flex;
    height: 37px;
    justify-content: center;
    width: 36px;
}
.widget-activity-three .timeline-line .item-timeline .t-dot div.t-primary {
    background-color: #1b55e2;
    /* box-shadow: 0 10px 20px -10px #1b55e2; */
}
.widget-activity-three .timeline-line .item-timeline .t-dot div.t-success {
    background-color: #009688;
    /* box-shadow: 0 10px 20px -10px #009688; */
}
.widget-activity-three .timeline-line .item-timeline .t-dot div.t-danger {
    background-color: #e7515a;
    /* box-shadow: 0 10px 20px -10px #e7515a; */
}
.widget-activity-three .timeline-line .item-timeline .t-dot div.t-warning {
    background-color: #e2a03f;
    /* box-shadow: 0 10px 20px -10px #e2a03f; */
}
.widget-activity-three .timeline-line .item-timeline .t-dot div.t-dark {
    background-color: #3b3f5c;
    /* box-shadow: 0 10px 20px -10px #3b3f5c; */
}
.widget-activity-three .timeline-line .item-timeline .t-dot svg {
    color: #fff;
    height: 20px;
    width: 20px;
    stroke-width: 1.6px;
    align-self: center;
}

.widget-activity-three .timeline-line .item-timeline .t-content {
    width: 100%;
}
.widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent {
    display: flex;
    justify-content: space-between;
}
.widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent h5 {
    font-size: 15px;
    letter-spacing: 0;
    font-weight: 700;
    margin-bottom: 5px;
}
.widget-activity-three .timeline-line .item-timeline .t-content .t-uppercontent span {
    margin-bottom: 0;
    font-size: 11px;
    font-weight: 500;
    color: #888ea8;
}
.widget-activity-three .timeline-line .item-timeline .t-content p {
    margin-bottom: 8px;
    font-size: 13px;
    font-weight: 500;
    color: #888ea8;
}
.widget-activity-three .timeline-line .item-timeline .t-content div.tags {
    
}
.widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge {
    padding: 2px 4px;
    font-size: 11px;
    letter-spacing: 1px;
    transform: none;
}

.widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge-primary {
    background-color: #c2d5ff;
    color: #1b55e2;
    
}

.widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge-success {
    background-color: #e6ffbf;
    color: #009688;
}

.widget-activity-three .timeline-line .item-timeline .t-content div.tags .badge-warning {
    background-color: #ffeccb;
    color: #e2a03f;
    
}
.widget-activity-three .timeline-line .item-timeline .t-dot:after {
    content: '';
    position: absolute;
    border-width: 1px;
    border-style: solid;
    left: 40%;
    transform: translateX(-50%);
    border-color: #bfc9d4;
    width: 0;
    height: auto;
    top: 36px;
    bottom: -20px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0;
}
.widget-activity-three .timeline-line .item-timeline:last-child .t-dot:after { display: none; }

/*
==================
    End Timeline
==================
*/

.widget-content-area {
  box-shadow: none !important; }

td.details-control {
    background: url("{{ asset('img/etc/details_open.png') }}") no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url("{{ asset('img/etc/details_close.png') }}") no-repeat center center;
}

.table > thead > tr > th {
  /* color: #ffffff; */
  font-weight: 700;
  font-size: 11px;
  letter-spacing: 1px;
  text-transform: uppercase;
  /* background : #373a40;   */
}

.table > tbody > tr > td {
    font-size: 11px;
}


.btn_book_id {
    padding: 0.4375rem 1rem;
    font-size: 10px;
}

@media (max-width: 991px) {

    .badge {
        font-size: 9px;  
    }

    .btn {
        padding: 0.4375rem 1.1rem;
        font-size: 10px;
        text-align: left;
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

    .widget-activity-three .widget-content {
        /* padding: 20px 10px 20px 20px; */
        padding: 0px 0px 0px 0px;
    }

    .row [class*="col-"] .widget .widget-header h4 {
        color: #3b3f5c;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        padding: 16px 15px;
    }


}

/* .badge {
  background: transparent; }

.badge-open {
  color: #1a1c20;
  border: 1px dashed #1a1c20; }

.badge-posted {
  color: #e2a03f;
  border: 1px dashed #e2a03f; }

.badge-reject {
  color: #e7515a;
  border: 1px dashed #e7515a; }

.badge-price {
  color: #8dbf42;
  border: 1px dashed #8dbf42; }

.badge-confirm {
  color: #2196f3;
  border: 1px dashed #2196f3; }

.badge-closed {
  color: #9d65c9;
  border: 1px dashed #9d65c9; } */

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Customer Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('List Order') }}">List Order</a></li>
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

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" >
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 id='DocTitle'></h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">

                    
                        {{-- <div class="widget widget-table-one">
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Electricity Bill</h4>
                                                <p class="meta-date">4 Aug 1:00PM</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-dec">
                                            <p><span>-$16.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                        {{-- <div class="widget widget-activity-three">

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        
                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Logs</h5>
                                                    <span class="">27 Feb, 2020</span>
                                                </div>
                                                <p><span>Updated</span> Server Logs</p>
                                                <div class="tags">
                                                    <div class="badge badge-primary">Logs</div>
                                                    <div class="badge badge-success">CPanel</div>
                                                    <div class="badge badge-warning">Update</div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>                                    
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="widget widget-activity-three">
        
                            <div class="widget-content">
    
                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        
                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Logs</h5>
                                                    <span class="">27 Feb, 2020</span>
                                                </div>
                                                <p><span>Updated</span> Server Logs</p>
                                                <div class="tags">
                                                    <div class="badge badge-primary">Logs</div>
                                                    <div class="badge badge-success">CPanel</div>
                                                    <div class="badge badge-warning">Update</div>
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>                                    
                                </div>
                            </div>


                            <div class="widget widget-table-one" style="margin-left: 15px; box-shadow: none">
                                <div class="widget-content">
                                    <div class="transactions-list">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar avatar-xl">
                                                        <span class="avatar-title rounded-circle text-white" style="background-color: #dc3545">LPM</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4 class="text-danger">N/A</h4>
                                                    <p class="meta-date text-danger">Date LPM: : N/A</p>
                                                    <p class="meta-date text-danger">Valid till: N/A</p>
                                                </div>

                                            </div>
                                            <div class="t-rate rate-dec">
                                                <p><span>Wgt: N/A</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="widget widget-table-one" style="margin-left: 25px; box-shadow: none">
                                <div class="widget-content">
                                    <div class="transactions-list">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="avatar avatar-xl">
                                                        <span class="avatar-title rounded-circle text-white" style="background-color: #dc3545">DLV</span>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4 class="text-danger">N/A</h4>
                                                    <p class="meta-date text-danger">Date DLV: N/A</p>
                                                </div>

                                            </div>
                                            <div class="t-rate rate-dec">
                                                <p><span>Wgt: N/A</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                 
                        <a href="javascript:void(0)" class="btn btn-info mb-2" id="btnFilter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                            Search Order by Product Descr
                        </a>

                    @if(Session::get('GROUPID') == 'CUSTOMER')

                        <div class="table-responsive" id="TableListOrderContainer">
                            <table id="TableListOrder" class="table mb-4" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Status</th>
                                        <th>Book.Id</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Sales Person</th>
                                        <th>Images</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    @endif

                    @if(Session::get('GROUPID') != 'CUSTOMER')

                        <div class="table-responsive" id="TableListOrderContainer">
                            <table id="TableListOrder" class="table mb-4" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Status</th>
                                        <th>Book.Id</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Sales Person</th>
                                        <th>Images</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endif

                    <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnBack" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Back to List Order
                    </a>


                    <div id="TrackingOrder" style="display: none">
                    <br>

                        
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="OrderItemListB4" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" id="modalLoadB4">
            <div class="modal-header" id="headerModalB4">
            </div>
			<div class="modal-body">
                    
                <h6>Invoice Address</h6>
                <div>
                    <span id="CustNameB4"></span>
                </div>
                <div>
                    <span id="CustAddressB4"></span>
                </div>
                <div>
                    <span id="CustPhoneB4"></span>
                </div>
                <br>
                <h6>Delivery Address</h6>
                <div>
                    <span id="ShipToB4"></span>
                </div>
                <br>
                   
                <div class="table-responsive" id="TableOrderContainerB4">
                    <table id="TableOrderItemListB4" class="table mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th>No</th>
                                <th>Descr</th>
                            </tr>
                        </thead>
                    </table>
                </div>
				
			</div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade" id="OrderItemList" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" id="modalLoad">
            <div class="modal-header" id="headerModal">
            </div>
			<div class="modal-body">
                    
                <h6>Invoice Address</h6>
                <div>
                    <span id="CustName"></span>
                </div>
                <div>
                    <span id="CustAddress"></span>
                </div>
                <div>
                    <span id="CustPhone"></span>
                </div>
                <br>
                <h6>Delivery Address</h6>
                <div>
                    <span id="ShipTo"></span>
                </div>
                <br>
                   
                <div class="table-responsive" id="TableOrderContainer">
                    <table id="TableOrderItemList" class="table mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th>No</th>
                                <th>Descr</th>
                                <th>Approval</th>
                            </tr>
                        </thead>
                    </table>
                </div>
				
			</div>
            <div class="modal-footer">
                <button class="btn btn-success" id="submitApproval">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Submit</button>
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade" id="OrderItemListAfter" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" id="modalLoadAfter">
            <div class="modal-header" id="headerModalAfter">
            </div>
			<div class="modal-body">
                    
                <h6>Invoice Address</h6>
                <div>
                    <span id="CustNameAfter"></span>
                </div>
                <div>
                    <span id="CustAddressAfter"></span>
                </div>
                <div>
                    <span id="CustPhoneAfter"></span>
                </div>
                <br>
                <h6>Delivery Address</h6>
                <div>
                    <span id="ShipToAfter"></span>
                </div>
                <br>
                   
                <div class="table-responsive" id="TableOrderContainerAfter">
                    <table id="TableOrderItemListAfter" class="table mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th>No</th>
                                <th>Descr</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
				
			</div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade" id="SearchModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modalLoad">
            <div class="modal-header">
                <h4 class="modal-title">Search by Product Descr</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">


                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing layout-spacing">


                        <div class="form-row mb-6">
                            <div class="form-group col-md-12">
                                <label class="text-dark" for="searchkey">Product Description</label>
                                <input type="text" name="searchkey" id="searchkey" class="form-control" placeholder="Eg: ZINIUM® 70 0.55 bmt x 152.00 mm AS 70 G550">
                            </div>
                        </div>

                    </div>
                    
                </div>

            </div>
            <div class="modal-footer">


                <button class="btn btn-success mb2" id="resetSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-ccw"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                Reset</button>

                <button class="btn btn-dark mb2" id="startSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                Search</button>
            </div>
        </div>
    </div>
</div>




@endsection
{{-- Content Page End--}}

{{-- Content Page JS Begin--}}
@section('contentjs')

@if(isset($success))
    <script>
        var success = "{!! $success !!}"
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: success,
            padding: '2em',
        })

    </script>
@endif

@if(isset($error))
    <script>
        var error = '{!! $error !!}'
        swal("Whoops", error, "error");
    </script>
@endif

<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('outside/plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script>

var id, value, searchkey;

function addCommas(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function format(d) {
    // `d` is the original data object for the row
    return '<table class="table">' +
        '<tr>' +
        '<td>Weight:</td>' +
        '<td>' + addCommas(parseFloat(d.wgt_quo).toFixed(2)) + ' KG</td>' +
        '</tr>' +
        '<td>Price:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.unit_price).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Gross Ammount</td>' +
        '<td>IDR ' +  addCommas(parseFloat(d.amt_gross).toFixed(2)) + '</td>' +
        '</tr>' +
        // '<tr>' +
        // '<td>Disc(%):</td>' +
        // '<td>' + addCommas(parseFloat(d.pct_disc).toFixed(2)) + '%</td>' +
        // '</tr>' +
        // '<tr>' +
        // '<td>Amt.Disc:</td>' +
        // '<td>IDR ' + addCommas(parseFloat(d.amt_disc).toFixed(2)) + '</td>' +
        // '</tr>' +
        '<tr>' +
        '<td>Nett Amount</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_net).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>LeatTime:</td>' +
        '<td>' + d.req_ship_week + '</td>' +
        '</tr>' +
        // '<tr>' +
        // '<td>Shipment Request:</td>' +
        // '<td>' + d.dt_req_ship + '</td>' +
        // '</tr>' +
        // '<tr>' +
        // '<td>Req.Week:</td>' +
        // '<td>' + d.req_week + '</td>' +
        // '</tr>' +
        // '<tr>' +
        // '<td>Req.Month:</td>' +
        // '<td>' + d.req_month + '</td>' +
        // '</tr>' +
        // '<tr>' +
        // '<td>Req.Year:</td>' +
        // '<td>' + d.req_year + '</td>' +
        // '</tr>' +
        // '<tr>' +
        // '<td>Application:</td>' +
        // '<td>' + d.aplikasi_note + '</td>' +
        // '</tr>' +
        // '<tr>' +
        '</table>';
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

function getListOrder(){

    blockUI();

    searchkey = $('#searchkey').val();

    var dataTable = $('#TableListOrder').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search",
                "sLengthMenu": "Show :  _MENU_ entries",
                },
            order: [ [1, 'desc'] ],
            stripeClasses: [],
            lengthMenu: [5, 10, 20, 50],
            pageLength: 10,
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                'url':'{!!url("getListOrder")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'searchkey' : searchkey
                    }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'stat', name: 'stat'},
                { data: 'book_id', name: 'book_id' },
                { data: 'fr_date', name: 'fr_date'},
                { data: 'cust_name', name: 'cust_name' },
                // { data: 'amt_net', name: 'amt_net', render: $.fn.dataTable.render.number( ',', '.', 2, 'IDR ' )},
                { data: 'salesman_name', name: 'salesman_name' }, 
                { data: 'images', name: 'images'},
                { data: 'user_id', name: 'user_id'},
                { data: 'Detail', name: 'Detail',orderable:false,searchable:false }
            ],
            initComplete: function(settings, json) {

                if (!dataTable.rows().data().length) {

                    $.unblockUI();

                    swal("Whops", "Data not available", "error");
                }

                else {

                    $.unblockUI();
                }
            },
        });

}

$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#CustOrderNav').attr('data-active','true');
    $('#CustOrderNav').attr('aria-expanded','true');
    $('.CustOrderTreeView').addClass('show');
    $('#ListOrder').addClass('active');

    $('#DocTitle').text("List Order");

    getListOrder();

    $('#btnFilter').on('click', function() {

        $("#SearchModal").modal('show');

    });

    $('#resetSearch').on('click', function() {

        $('#searchkey').val('');
        $("#SearchModal").modal('hide');
        getListOrder();

    });

    $('#startSearch').on('click', function() {

        $("#SearchModal").modal('hide');
        getListOrder();


    });

    var table1 = $('#TableOrderItemListB4').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        dom: 'Pfrtip',
        ajax: {
            'url': '{!!url("getItemDetail2")!!}' + '?id=' +id,
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [{
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": '',
            },
            {
                data: 'item_num',
                name: 'item_num',
                sClass: "center"
            },
            {
                data: 'descr',
                name: 'descr',
                sClass: "center"
            }
        ],
        initComplete: function(settings, json) {

            if (!table1.rows().data().length) {

            }  
            if (!table1.rows().data().length) {
                
            } 
        },
    });

    var table2 = $('#TableOrderItemList').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        dom: 'Pfrtip',
        ajax: {
            'url': '{!!url("getQuoteDetail")!!}' + '?id=' +id,
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [{
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": '',
            },
            {
                data: 'quote_item',
                name: 'quote_item',
                sClass: "center"
            },
            {
                data: 'ord_desc',
                name: 'ord_desc',
                sClass: "center"
            },
            {
                data: 'approval',
                name: 'approval',
                sClass: "center"
            }
        ],
        initComplete: function(settings, json) {

            if (!table2.rows().data().length) {

            }  
            if (!table2.rows().data().length) {
                
            } 
        },
    });

    var table3 = $('#TableOrderItemListAfter').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        dom: 'Pfrtip',
        ajax: {
            'url': '{!!url("getQuoteDetail")!!}' + '?id=' +id,
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [{
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": '',
            },
            {
                data: 'quote_item',
                name: 'quote_item',
                sClass: "center"
            },
            {
                data: 'ord_desc',
                name: 'ord_desc',
                sClass: "center"
            },
            {
                data: 'approval',
                name: 'approval',
                sClass: "center"
            }
        ],
        initComplete: function(settings, json) {

            if (!table3.rows().data().length) {

            }  
            if (!table3.rows().data().length) {
                
            } 
        },
    });

    $('#TableOrderItemListB4 tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = $('#TableOrderItemListB4').DataTable().row(tr);
        // var data = table.row(this).data();
        // console.log(table.row(tr));

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('#TableOrderItemList tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = $('#TableOrderItemList').DataTable().row(tr);
        // var data = table.row(this).data();
        // console.log(table.row(tr));

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('#TableOrderItemListAfter tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = $('#TableOrderItemListAfter').DataTable().row(tr);
        // var data = table.row(this).data();
        // console.log(table.row(tr));

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('body').on('click', '.detailOrderModalB4', function(e) {

        $("#OrderItemListB4").modal();
        block = $('#modalLoadB4');
        blockModal(block);
        id = $(this).data('id');
        var button =  "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><svg aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'><line x1='18' y1='6' x2='6' y2='18'></line><line x1='6' y1='6' x2='18' y2='18'></line></svg></button>";
        var title = "<h5 class='modal-title'>Detail of "+id+"</h5>"+button;
        $('#headerModalB4').html(title);

        $.ajax({
            type: "POST",
            url: "{{ url('detailHdr') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function (data) {

                var cust_name = data['cust_name'];
                if (!cust_name){
                    cust_name = 'N/A';
                }
                var cust_address = data['cust_address'];
                if (!cust_address){
                    cust_address = 'N/A';
                }
                var phone = data['phone'];
                if (!phone){
                    phone = 'N/A';
                }
                var ship_to = data['ship_to'];
                if (!ship_to){
                    ship_to = 'N/A';
                }
                var proj_flag= data['proj_flag'];
                if (!proj_flag){
                    proj_flag = 'N/A';
                }
                else if (proj_flag == 'N'){
                    proj_flag = 'Non Project';
                }
                else if (proj_flag == 'T'){
                    proj_flag = 'Project';
                }
                var pay_term_desc = data['pay_term_desc'];
                if (!pay_term_desc){
                    pay_term_desc = 'N/A';
                }
                var cust_po_num = data['cust_po_num'];
                if (!cust_po_num){
                    cust_po_num = 'N/A';
                }
                var remark1 = data['remark1'];
                if (!remark1){
                    remark1 = 'N/A';
                }

                $('#CustNameB4').text(cust_name);
                $('#CustAddressB4').text(cust_address);
                $('#CustPhoneB4').text(phone);
                $('#ShipToB4').text(ship_to);
                // $('#payment').text(pay_term_desc);
                // $('#projFlag').text(proj_flag);
                // $('#custPoNum').text(cust_po_num);
                // $('#remark1').text(remark1);

                var load = $('#TableOrderItemListB4').DataTable().ajax.url('getItemDetail2?id='+id).load();
                if (load) {
                    $(block).unblock();
                }
            }
        });
    });

    $('body').on('click', '.detailOrderModal', function(e) {

        $("#OrderItemList").modal();
        block = $('#modalLoad');
        blockModal(block);
        id = $(this).data('id');
        var button =  "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><svg aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'><line x1='18' y1='6' x2='6' y2='18'></line><line x1='6' y1='6' x2='18' y2='18'></line></svg></button>";
        var title = "<h5 class='modal-title'>Detail of "+id+"</h5>"+button;
        $('#headerModal').html(title);

        $.ajax({
            type: "POST",
            url: "{{ url('detailHdr') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function (data) {

                var cust_name = data['cust_name'];
                if (!cust_name){
                    cust_name = 'N/A';
                }
                var cust_address = data['cust_address'];
                if (!cust_address){
                    cust_address = 'N/A';
                }
                var phone = data['phone'];
                if (!phone){
                    phone = 'N/A';
                }
                var ship_to = data['ship_to'];
                if (!ship_to){
                    ship_to = 'N/A';
                }
                var proj_flag= data['proj_flag'];
                if (!proj_flag){
                    proj_flag = 'N/A';
                }
                else if (proj_flag == 'N'){
                    proj_flag = 'Non Project';
                }
                else if (proj_flag == 'T'){
                    proj_flag = 'Project';
                }
                var pay_term_desc = data['pay_term_desc'];
                if (!pay_term_desc){
                    pay_term_desc = 'N/A';
                }
                var cust_po_num = data['cust_po_num'];
                if (!cust_po_num){
                    cust_po_num = 'N/A';
                }
                var remark1 = data['remark1'];
                if (!remark1){
                    remark1 = 'N/A';
                }

                $('#CustName').text(cust_name);
                $('#CustAddress').text(cust_address);
                $('#CustPhone').text(phone);
                $('#ShipTo').text(ship_to);
                // $('#payment').text(pay_term_desc);
                // $('#projFlag').text(proj_flag);
                // $('#custPoNum').text(cust_po_num);
                // $('#remark1').text(remark1);

                var load = $('#TableOrderItemList').DataTable().ajax.url('getQuoteDetail?id='+id).load();
                if (load) {
                    $(block).unblock();
                }
            }
        });
    });

    $('body').on('click', '.detailOrderModalAfter', function(e) {

        $("#OrderItemListAfter").modal();
        block = $('#modalLoadAfter');
        blockModal(block);
        id = $(this).data('id');
        var button =  "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><svg aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'><line x1='18' y1='6' x2='6' y2='18'></line><line x1='6' y1='6' x2='18' y2='18'></line></svg></button>";
        var title = "<h5 class='modal-title'>Detail of "+id+"</h5>"+button;
        $('#headerModalAfter').html(title);

        $.ajax({
            type: "POST",
            url: "{{ url('detailHdr') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function (data) {

                var cust_name = data['cust_name'];
                if (!cust_name){
                    cust_name = 'N/A';
                }
                var cust_address = data['cust_address'];
                if (!cust_address){
                    cust_address = 'N/A';
                }
                var phone = data['phone'];
                if (!phone){
                    phone = 'N/A';
                }
                var ship_to = data['ship_to'];
                if (!ship_to){
                    ship_to = 'N/A';
                }
                var proj_flag= data['proj_flag'];
                if (!proj_flag){
                    proj_flag = 'N/A';
                }
                else if (proj_flag == 'N'){
                    proj_flag = 'Non Project';
                }
                else if (proj_flag == 'T'){
                    proj_flag = 'Project';
                }
                var pay_term_desc = data['pay_term_desc'];
                if (!pay_term_desc){
                    pay_term_desc = 'N/A';
                }
                var cust_po_num = data['cust_po_num'];
                if (!cust_po_num){
                    cust_po_num = 'N/A';
                }
                var remark1 = data['remark1'];
                if (!remark1){
                    remark1 = 'N/A';
                }

                $('#CustNameAfter').text(cust_name);
                $('#CustAddressAfter').text(cust_address);
                $('#CustPhoneAfter').text(phone);
                $('#ShipToAfter').text(ship_to);
                // $('#payment').text(pay_term_desc);
                // $('#projFlag').text(proj_flag);
                // $('#custPoNum').text(cust_po_num);
                // $('#remark1').text(remark1);

                var load = $('#TableOrderItemListAfter').DataTable().ajax.url('getQuoteDetail?id='+id).load();
                if (load) {
                    $(block).unblock();
                }
            }
        });
    });

    $('body').on('click', '.deleteOrder', function(e) {
        
        var id = $(this).data('id');

        swal({
            title: 'Are you sure?',
            text: "Delete "+id+" ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('deleteOrder') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'book_id': id
                        },
                            success: function(data) {

                                if ((data['response']) == 'Order Deleted') {
                                    swal("Success", (data['response']), "success");
                                    $('#TableListOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                                }
                                else {
                                    swal("Error", (data['response']), "error");
                                    $('#TableListOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                                }

                            }
                        });

                }
            });



    });

    $('body').on('click', '.confirmOrder', function(e) {
        var id = $(this).data('id');

        swal({
            title: 'Are you sure?',
            text: "Confirm Order "+id+" ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('confirmOrder') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'book_id': id
                        },
                            success: function(data) {

                                if ((data['response']) == 'Order Confirmed') {
                                    swal("Success", (data['response']), "success");
                                    $('#TableListOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                                }
                                else {
                                    swal("Error", (data['response']), "error");
                                    $('#TableListOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                                }

                            }
                        });
                }
            });



    });

    $('body').on('click', '.trackingOrder', function(e) {

        id = $(this).data('id');

        blockUI();

        $.ajax({
            type: "POST",
            url: "{{ url('trackOrder') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function (data) {

                if (data['response']) {

                    $.unblockUI();

                    $("#TableListOrderContainer").hide();
                    $("#btnBack").show();
                    $('#TrackingOrder').show();
                    $('#DocTitle').text("Tracking Order "+id);
                    $('#TrackingOrder').html(data['response']);   

                }
                else {

                    $.unblockUI();
                    swal("Whops", (data['error']), "error");
                                     
                }

            }
        });
        

    });

    $('#btnBack').on('click', function() {

        $("#btnBack").hide();
        $("#TableListOrderContainer").show();
        $('#TrackingOrder').hide();
        $('#DocTitle').text("List Order");
        $('#TableListOrder').DataTable().ajax.url('getListOrder').load();
       

    });

    $('#submitApproval').on('click', function() {

        blockUI();
        
        var data = table2.$('select').serializeArray();

        var listApproval = '';

        jQuery.each( data, function( i, field ) {
            
            listApproval += field.value+","
    
        });

        listApproval = listApproval.slice(0, -1)

        // console.log(listApproval)

        $.ajax({
            type: "POST",
            url: "{{ url('submitApproval') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id,
                'listApproval': listApproval
            },
            success:function(data){

                if (data['error']) {
                    
                    $.unblockUI();
                    swal("Whops", data['error'], "error")
                    $('#TableListOrder').DataTable().ajax.reload();
                    $('#OrderItemList').hide();
                }

                else {

                    $.unblockUI();
                    swal("Success", data['response'], "success")
                    $('#TableListOrder').DataTable().ajax.reload();
                    $('#OrderItemList').hide();
                }

            }
        });



    });

   








});


</script>

@endsection
{{-- Content Page JS End--}}
