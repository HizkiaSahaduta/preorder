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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('OutstandingDeliv') }}">Outstanding Delivery</a></li>
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
                 
                    {{-- <a href="javascript:void(0)" class="btn btn-info mb-2" id="btnFilter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        Search Order by Product Descr
                    </a> --}}

                    <div class="table-responsive" id="TableOutstandingDelivDiv">
                        <table id="TableOutstandingDeliv" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SalesContract</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>ShipmentPlan</th>
                                    <th>ProductName</th>
                                    <th>Thickness</th>
                                    <th>Width</th>
                                    <th>Grade</th>
                                    <th>AS/AZ</th>
                                    <th>Order</th>
                                    <th>Delivered</th>
                                    <th>Outstanding</th>
                                    <th>PPP</th>
                                    <th>Remain</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                  

                    {{-- <a href="javascript:void(0)" class="btn btn-dark mb-2" id="btnBack" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Back to List Order
                    </a> --}}


                </div>
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

function getOutstandingDeliv(){

    blockUI();

    var dataTable = $('#TableOutstandingDeliv').DataTable({
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
                'url':'{!!url("getOutstandingDeliv")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                    }
            },
            columns: [
                { data: 'order_id', name: 'order_id'},
                { data: 'cust_name', name: 'cust_name' },
                { data: 'dt_order', name: 'dt_order' },
                { data: 'leat_time', name: 'leat_time'},
                { data: 'descr', name: 'descr' },
                { data: 'thick', name: 'thick' }, 
                { data: 'width', name: 'width'},
                { data: 'grade_id', name: 'grade_id'},
                { data: 'coat_mass', name: 'coat_mass'},
                { data: 'wgt_ord', name: 'wgt_ord'},
                { data: 'wgt_deliv', name: 'wgt_deliv'},
                { data: 'outstd', name: 'outstd'},
                { data: 'wgt_lpm', name: 'wgt_lpm'},
                { data: 'remain', name: 'remain'}
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
    $('#OutstandingDeliv').addClass('active');

    getOutstandingDeliv();

});


</script>

@endsection
{{-- Content Page JS End--}}
