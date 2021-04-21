@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('outside/assets/css/components/custom-modal.css') }}"  />
<link href="{{ asset('outside/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
<style>

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
}

.badge {
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
  border: 1px dashed #9d65c9; }

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Cust. Order</a></li>
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

                    <div class="table-responsive" id="TableListOrderContainer">
                        <table id="TableListOrder" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>BookId</th>
                                    <th>Status</th>
                                    <th>Tr.Date</th>
                                    <th>Cust.Name</th>
                                    <th>Total</th>
                                    <th>Salesman</th>
                                    <th>Images</th>
                                    <th>CreatedBy</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

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
<div class="modal fade" id="OrderItemList" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content" id="modalLoad">
            <div class="modal-header" id="headerModal">
            </div>
			<div class="modal-body">
                    
                <h6>Bill To</h6>
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
                <h6>Ship To</h6>
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

var id, value;
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
        '<td>' + addCommas(parseFloat(d.wgt).toFixed(2)) + ' KG</td>' +
        '</tr>' +
        '<td>Price:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.unit_price).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Gross:</td>' +
        '<td>IDR ' +  addCommas(parseFloat(d.amt_gross).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Disc(%):</td>' +
        '<td>' + addCommas(parseFloat(d.pct_disc).toFixed(2)) + '%</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Disc:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_disc).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Net:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_net).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Remark:</td>' +
        '<td>' + d.remark + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Dt.ReqShip:</td>' +
        '<td>' + d.dt_req_ship + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Week:</td>' +
        '<td>' + d.req_week + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Month:</td>' +
        '<td>' + d.req_month + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Year:</td>' +
        '<td>' + d.req_year + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>ApplNote:</td>' +
        '<td>' + d.aplikasi_note + '</td>' +
        '</tr>' +
        '<tr>' +
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

$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#CustOrderNav').attr('data-active','true');
    $('#CustOrderNav').attr('aria-expanded','true');
    $('.CustOrderTreeView').addClass('show');
    $('#ListOrder').addClass('active');

    $('#DocTitle').text("List Order");


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
            'url': '{!!url("getListOrder")!!}',
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'book_id', name: 'book_id' },
            { data: 'stat', name: 'stat'},
            { data: 'fr_date', name: 'fr_date'},
            { data: 'cust_name', name: 'cust_name' },
            { data: 'amt_net', name: 'amt_net', render: $.fn.dataTable.render.number( ',', '.', 2, 'IDR ' )},
            { data: 'salesman_name', name: 'salesman_name' }, 
            { data: 'images', name: 'images'},
            { data: 'user_id', name: 'user_id'},
            { data: 'Detail', name: 'Detail',orderable:false,searchable:false }
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                swal("Whops", "Data not available", "error");
            }
        },
    });

    var table = $('#TableOrderItemList').DataTable({
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
            'url': '{!!url("getItemDetail")!!}' + '?id=' +id,
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

            if (!table.rows().data().length) {

            }  
            if (!table.rows().data().length) {
                
            } 
        },
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

                var load = $('#TableOrderItemList').DataTable().ajax.url('getItemDetail?id='+id).load();
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






});


</script>

@endsection
{{-- Content Page JS End--}}
