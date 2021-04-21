@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />

<style>

.widget-content-area {
  box-shadow: none !important; }

#Cust .badge {
  background: transparent; }

#Cust .badge-success {
  color: #8dbf42;
  border: 2px dashed #8dbf42; }

  @media (max-width: 991px) {
    .form-group label, label {
        font-size: 12px;
        color: #acb0c3;
        letter-spacing: 1px;
        font-weight: bold;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        font-size: 12px;
    }

    .form-control {
        font-size: 12px;
    }

    .select2-results__option {
        font-size: 12px;
    }

    .table > tbody > tr > td {
        font-size: 11px;
    }

    .table > thead > tr > th {
        font-size: 11px;
    }

    div.dataTables_wrapper div.dataTables_info {
        font-size: 11px; 
    }

    .badge {
        font-size: 11px;  
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Customer Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('CustReg') }}">Registered Customer</a></li>
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

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Registered Customer</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">

                    <div class="form-group col-md-3">
                        <label class="text-dark">Choose Sales Person</label>
                        <select id='txtSalesman' name='txtSalesman' class="form-control basic">
                        @if(isset($listsales))
                            @if( Session::get('GROUPID') == 'SALES')
                                @foreach($listsales as $s)
                                    <option value='{{ $s->salesman_id }}' selected>{{ $s->salesman_name }}</option>
                                @endforeach
                            @else
                                <option></option>
                                @foreach($listsales as $s)
                                <option value='{{ $s->salesman_id }}'>{{ $s->salesman_name }}</option>
                                @endforeach
                            @endif
                        @endif
                        </select>
                    </div>

                    <br>

                    <div class="table-responsive">
                        <table id="Cust" class="table mb-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Cust. Name</th>
                                    <th>Contact Name</th>
                                    <th>Default Pass.</th>
                                    <th>Status</th>
                                    <th>Salesman</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>




@endsection
{{-- Content Page End--}}

{{-- Content Page JS Begin--}}
@section('contentjs')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('outside/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" crossorigin="anonymous"></script>
<script>

function listSalesman(){

    $('#txtSalesman').select2({
        placeholder: 'Choose sales person below',
        allowClear: true
    });

}

$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#CustOrderNav').attr('data-active','true');
    $('#CustOrderNav').attr('aria-expanded','true');
    $('.CustOrderTreeView').addClass('show');
    $('#RegisteredCust').addClass('active');

    var id;

    var dataTable = $('#Cust').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search",
            "sLengthMenu": "Show :  _MENU_ entries",
            },
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("listRegisteredUser/id=")!!}'+id
        },
        columns: [
            {data: 'user_id2', name: 'user_id2'},
            {data: 'name1', name: 'name1'},
            {data: 'name2', name: 'name2'},
            {data: 'cust_pass', name: 'cust_pass'},
            {data: 'active_flag', name: 'active_flag'},
            {data: 'salesman_name', name: 'salesman_name'}
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                swal("Whops", "Data not available", "error");
            }
        },
    });

    listSalesman();

    var count = document.getElementById("txtSalesman").length;
    
    if (count < 2) {
        
        $('#txtSalesman').prop('disabled', true);
    }

    else {

        $('#txtSalesman').prop('disabled', false);

    }

    $('.basic').on('select2:open', function() {
        if (Modernizr.touch) {
            $('.select2-search__field').prop('focus', false);
        }
    });

    $('#txtSalesman').change(function(){

        id = $('#txtSalesman').val();

        if (id) {

            dataTable.ajax.url('{!!url("listRegisteredUser/id=")!!}'+id).load();

        }

        else {

            id = 'undefined';

            dataTable.ajax.url('{!!url("listRegisteredUser/id=")!!}'+id).load();


        }
        
    });

    


    



    



    

});


</script>

@endsection
{{-- Content Page JS End--}}
