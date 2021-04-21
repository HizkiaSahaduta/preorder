@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/jquery-step/jquery.steps.css') }}">
<style>
#example-vertical.wizard > .content {min-height: 24.5em;}

input[disabled], input[readonly] {
  cursor: not-allowed;
  background-color: #fff !important;
  color: #3b3f5c;
  }

hr.style {
  border-top: 1px dashed #393b44;
}

.text-muted { color: #009688 !important; font-size: 12px; }

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('CustReg') }}">Customer Registration</a></li>
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

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="satu">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Customer Registration</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">


                    <div id="example-vertical">
                        <h3>Choose Customer</h3>
                        <section id='section_1'>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-12">
                                    <label class="text-dark" for="txtCustomer">Choose Customer</label>
                                    <select class="form-control basic" name="txtCustomer" id="txtCustomer">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <hr class="style">

                            <div class="form-row mb-6">
                                <div class="form-group col-md-4 col-4">
                                    <label class="text-dark" for="txtCustID">Customer ID</label>
                                    <input id="txtCustID" type="text" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-8 col-8">
                                    <label class="text-dark" for="txtCustName">Customer Name</label>
                                    <input id="txtCustName" type="text" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-12">
                                    <label class="text-dark" for="txtAddress">Customer Address</label>
                                    <input class="form-control basic" name="txtAddress" id="txtAddress" readonly>
                                </div>
                            </div>


                            <div class="form-row mb-6">
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtCity">City</label>
                                    <input id="txtCity" type="txtCity" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtProv">Prov</label>
                                    <input id="txtProv" type="text" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-4 col-4">
                                    <label class="text-dark" for="txtFax">Fax</label>
                                    <input id="txtFax" type="text" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4 col-4">
                                    <label class="text-dark" for="txtPhone">Phone</label>
                                    <input id="txtPhone" type="text" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4 col-4">
                                    <label class="text-dark" for="txtContact">Attn</label>
                                    <input id="txtContact" type="text" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-row mb-6" id="Salesman" style="display: none">
                                <div class="form-group col-md-12 col-12">
                                    <label class="text-dark" for="txtSalesman">Sales Person</label>
                                    <select class="form-control basic" name="txtSalesman" id="txtSalesman">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-success" id="reset">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                        Reset Form
                                    </button>
                                </div>
                            </div>
                              
                        </section>
                        <h3>Credentials</h3>
                        <section id='section_2'>
                            <div class="form-row mb-6">
                                <div class="form-group col-md-10">
                                    <label class="text-dark" for="txtCustEmail">Cust. Email</label>
                                    <input id="txtCustEmail" type="text" class="form-control">
                                    <small id="txtCustEmailhelp" class="form-text text-muted mb-4"></small>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-10">
                                    <label class="text-dark" for="txtCustPwd">Cust. Password</label>
                                    <input id="txtCustPwd" type="text" class="form-control">
                                    <br>
                                    <button type="submit" class="btn btn-success" id="genPwd">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                        Generate
                                    </button>
                                </div>
                            </div>
                        </section>
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
<script src="{{ asset('outside/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('outside/plugins/jquery-step/jquery.steps.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" crossorigin="anonymous"></script>
<script>

var count, txtGroup, txtSalesid, txtCustID;

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

function genPwd(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

function listSalesman(txtGroup, txtSalesid, txtCustID){
    
    $.ajax({
        type: "POST",
        url: "{{ url('listSalesman') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'txtGroup': txtGroup,
            'txtSalesid': txtSalesid,
            'txtCustID': txtCustID
        },
        success: function(data) {

            count = Object.keys(data).length;

            if (count < 2) {

                $('select[name="txtSalesman"]').empty();
                $('select[name="txtSalesman"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="txtSalesman"]').append('<option value="'+element.salesman_id+'" selected>'+element.salesman_name+'</option>');
                });
                $('#txtSalesman').prop('disabled', true);

            }

            else {
                
                $('select[name="txtSalesman"]').empty();
                $('select[name="txtSalesman"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    $('select[name="txtSalesman"]').append('<option value="'+element.salesman_id+'">'+element.salesman_name+'</option>');
                });
                $('#txtSalesman').prop('disabled', false);
            }
        }
    });


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
    $('#CustReg').addClass('active');

    $('.basic').on('select2:open', function() {
        if (Modernizr.touch) {
            $('.select2-search__field').prop('focus', false);
        }
    });

    $("#example-vertical").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        cssClass: 'circle wizard',
        onStepChanging: function (event, currentIndex, newIndex)
        {

            var txtCustID = $('#txtCustID').val();
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            if (newIndex === 1 && !txtCustID)
            {
                swal('Whops', 'Please choose customer first', 'error')
                return false;
                
            }
            if (newIndex === 1 && txtCustID)
            {
                return true;
                
            }
        },
        onFinished: function (event, currentIndex)
        {

            var txtCustEmail = $('#txtCustEmail').val();
            var txtCustPwd = $('#txtCustPwd').val();

            if (!txtCustEmail && !txtCustPwd) {
                swal('Whops', 'Please provide email and password for customer registration purpose','error')
            }
            else if (!txtCustEmail && txtCustPwd) {
                swal('Whops', 'Please provide email for customer registration purpose','error')
            }
            else if (txtCustEmail && !txtCustPwd) {
                swal('Whops', 'Please provide password for customer registration purpose','error')
            }
            else {

                blockUI();
                var txtCustEmail = $('#txtCustEmail').val();
                var txtCustPwd = $('#txtCustPwd').val();
                var txtCustName = $('#txtCustName').val();
                var txtContact = $('#txtContact').val();
                var txtCustID = $('#txtCustID').val();
                var txtSalesman = $('#txtSalesman').val();

                $.ajax({
                    type: "GET",
                    url: "{{url('checkEmail/id=')}}"+txtCustEmail,
                    success: function(data) {

                        if ((data['response'])) {

                            $.unblockUI();
                            swal('Whops', data['response'], 'error' );

                        }

                        else {

                            $.ajax({
                                type: "POST",
                                url: "{{ url('SaveCustReg') }}",
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    'txtCustEmail': txtCustEmail,
                                    'txtCustPwd': txtCustPwd,
                                    'txtCustName': txtCustName,
                                    'txtContact': txtContact,
                                    'txtCustID': txtCustID,
                                    'txtSalesman': txtSalesman
                                },
                                success: function(data) {

                                    if ((data['response']) == 'Customer Registered') {

                                        $.unblockUI();
                                        
                                        swal('Success', data['response'], 'success' )
                                        .then(function(){
                                            window.location.replace("{{ url('RegisteredCust') }}");
                                        }
                                        );
                                    }

                                    else {

                                        $.unblockUI();
                                        swal('Whops', data['detail'], 'error' );

                                    }
                
                                }
                            });
                            
                        }
  
                    }
                });

                

            }
            
        }
    });

    $("#txtCustomer").select2({
        placeholder: "Type any existing Customer ID or Customer Name...",
        allowClear: true,
        minimumInputLength: 3,
        ajax: {
            url: "{{ url('getCust') }}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                return {
                    text: item.cust_id + " || " + item.cust_name + " (" + item.address1 + ", " + item.city + ")" ,
                    id: item.cust_id
                }
                })
            };
            
            },
            cache: true
        }
    });

    $('#txtCustomer').change(function(){

        var id = $('#txtCustomer').val();

        if (id) {

            blockUI();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "checkCustomer/id="+id,
                success: function (data) {

                    if (data['response'] == 'Ok') {

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "getCustID/id="+id,
                            success: function (data) {

                                $.unblockUI();
                                $('#txtCustID').val(data.cust_id);
                                $('#txtCustName').val(data.cust_name);
                                $('#txtAddress').val(data.address1+", "+data.address2);
                                $('#txtCity').val(data.city);
                                $('#txtProv').val(data.prov);
                                $('#txtFax').val(data.fax);
                                $('#txtPhone').val(data.phone);
                                $('#txtContact').val(data.contact_name);
                                $('#txtCustEmail').val(data.email);

                                if (data.email) {
                                    document.getElementById("txtCustEmailhelp").innerHTML = "This registered email will be used as Customer registration";
                                }
                                else{
                                    document.getElementById("txtCustEmailhelp").innerHTML = "This customer doesn't have any email registered, please ask them for Customer registration purpose";
                                }

                            }
                        }); 
                   
                    }

                    else{

                        $.unblockUI();
                        swal('Whops', data['response'], 'error' );
                        $('#txtCustomer').val(null).trigger('change');
                        $('#txtCustID').val('');
                        $('#txtCustName').val('');
                        $('#txtAddress').val('');
                        $('#txtCity').val('');
                        $('#txtProv').val('');
                        $('#txtFax').val('');
                        $('#txtPhone').val('');
                        $('#txtContact').val('');
                        $('#txtCustEmail').val('');
                        document.getElementById("txtCustEmailhelp").innerHTML = "-";

                        
                    }
                }
            });       

        }
        else {

            $('#txtCustID').val('');
            $('#txtCustName').val('');
            $('#txtAddress').val('');
            $('#txtCity').val('');
            $('#txtProv').val('');
            $('#txtFax').val('');
            $('#txtPhone').val('');
            $('#txtContact').val('');
            $('#txtCustEmail').val('');
            document.getElementById("txtCustEmailhelp").innerHTML = "-";
        }
    });

    $('#genPwd').on('click', function() {

        $('#txtCustPwd').val(genPwd(8));
        
    });

    $('#reset').on('click', function() {

        $('#txtCustomer').val(null).trigger('change');
        $('#txtCustID').val('');
        $('#txtCustName').val('');
        $('#txtAddress').val('');
        $('#txtCity').val('');
        $('#txtProv').val('');
        $('#txtFax').val('');
        $('#txtPhone').val('');
        $('#txtContact').val('');
        $('#txtCustEmail').val('');
        document.getElementById("txtCustEmailhelp").innerHTML = "-";

    });

    @if(Session::get('GROUPID') != 'SALES')

        var txtGroup = '{{ Session::get('GROUPID') }}';
        listSalesman(txtGroup, txtSalesid, txtCustID);
        Salesman.style.display = "block";

    @endif


    

});


</script>

@endsection
{{-- Content Page JS End--}}
