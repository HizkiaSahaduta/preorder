@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<link href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/jquery-step/jquery.steps.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/assets/css/elements/alert.css') }}">
<style>

.widget-content-area {
  box-shadow: none !important; }

#example-vertical.wizard > .content {min-height: 24.5em;}

input[disabled], input[readonly] {
  cursor: not-allowed;
  background-color: #fff !important;
  color: #3b3f5c;
  }

hr.style {
  border-top: 1px dashed #888ea8;
}

.form-group label, label {
  font-weight: bold;
}

td.details-control {
    background: url("{{ asset('img/etc/details_open.png') }}") no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url("{{ asset('img/etc/details_close.png') }}") no-repeat center center;
}

/* th {
    text-align: center;
}

.table > tbody > tr > td {
    text-align: center;
} */

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

    .badge {
        font-size: 9px;  
    }

    .p_style {
        font-size: 11px;  
    }

    .btn {
        padding: 0.4375rem 1.1rem;
        font-size: 11px;
    }

    .input-group-text {
        font-size: 0.75rem;
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
}

.badge {
  background: transparent; }

.badge-primary {
  color: #1b55e2;
  border: 1px dashed #1b55e2; }

.badge-warning {
  color: #e2a03f;
  border: 1px dashed #e2a03f; }

.badge-danger {
  color: #e7515a;
  border: 1px dashed #e7515a; }

.badge-success {
  color: #8dbf42;
  border: 1px dashed #8dbf42; }

.badge-info {
  color: #2196f3;
  border: 1px dashed #2196f3; }

.text-muted { color: #009688 !important; font-size: 12px;}

.infobox-1 {
    width: 100%;
}

.info-icon svg {
    width: 50px;
    height: 50px;
    stroke-width: 1px;
    margin-bottom: 20px;
    color: #1b55e2;
}

.modal-content {
  border: none;
  box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.2); }
  .modal-content .modal-footer {
    border-top: none; }
    .modal-content .modal-footer [data-dismiss="modal"] {
      background-color: #fff;
      color: #1b55e2;
      font-weight: 700;
      border: 1px solid #e8e8e8;
      padding: 10px 25px; }
    .modal-content .modal-footer .btn[data-dismiss="modal"] svg {
      margin-right: 5px;
      width: 18px;
      vertical-align: bottom; }
    .modal-content .modal-footer #btn-n-add {
      background-color: #1b55e2;
      color: #fff;
      font-weight: 600;
      border: 1px solid #1b55e2;
      padding: 10px 25px; }
    .modal-content .modal-footer #btn-n-save {
      font-weight: 600;
      padding: 10px 25px; }

.modal-backdrop {
  background-color: #ebedf2; }

.modal-content svg.close {
  position: absolute;
  right: 15px;
  top: 10px;
  font-size: 12px;
  font-weight: 600;
  padding: 3px;
  background: #fff;
  border-radius: 5px;
  opacity: 1;
  box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  transition: .600s;
  color: #3b3f5c; }
</style>
@endsection
{{-- Content CSS End--}}

{{-- Content Navbar Content Begin--}}
@section('navbar_content')
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" 
y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Customer Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Edit Order</a></li>
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto ">
			<li class="nav-item more-dropdown">
				<div class="dropdown  custom-dropdown-icon">
					<a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Hello, {{ 
Auth::user()->name1 }}</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">

                        @if(session()->has('mnuMyAccount'))
                        <a class="dropdown-item" data-value="UserProfile" href="{{ url('MyAccount') }}">My Account</a>
                        @endif

                        @if(session()->has('mnuMyAccount'))
                        <a class="dropdown-item" data-value="UserProfile" href="{{ url('ChangePass') }}">Change Password</a>
                        @endif

						<a class="dropdown-item" data-value="Logout" href="{{ route('logout') }}" 
onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
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
                            <h4>Edit Order {{ $book_id }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">

                    <div id="example-vertical">
                        <h3>Order Header</h3>
                        <section id='section_1'>
                            <div class="form-row mb-6">
                                <div class="form-group col-md-12">
                                    <label class="text-dark" for="txtCustomer">Customer</label>
                                    <select class="form-control basic" name="txtCustomer" id="txtCustomer">
                                        <option value="{{ $cust_id }}" selected>{{ $cust_id." | ".$cust_name }}</option>
                                     </select>
                                </div>
                                <input type="hidden" value="{{ $book_id }}" id="setBookId">
                                <input type="hidden" value="{{ $str1 }}" id="txtStr1">
                                <input type="hidden" value="{{ $disc_loco }}" id="txtDiscLoco">
                            </div>

                            <hr class="style">

                            <div class="form-row mb-6">
                                <div class="form-group col-md-5 col-5">
                                    <label class="text-dark" for="txtStrata">Strata</label>
                                    <input class="form-control basic" value="{{ "00".$strata }}" name="txtStrata" id="txtStrata" readonly>
                                </div>
                                <div class="form-group col-md-7 col-7">    
                                    <label class="text-dark" for="txtShipTerm">Ship Term</label>  
                                    <select class="form-control basic" name="txtShipTerm" id="txtShipTerm">
                                        @if ( $deliv_mode == 'FRANCO')
                                        <option></option>
                                        <option value="FRANCO" selected>FRANCO</option>
                                        <option value="LOCO">LOCO</option>
                                        @else
                                        <option></option>
                                        <option value="FRANCO">FRANCO</option>
                                        <option value="LOCO" selected>LOCO</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-4 col-4">
                                    <label class="text-dark" for="txtCustID">Cust. ID</label>
                                    <input id="txtCustID" value="{{ $cust_id }}" type="text" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-8 col-8">
                                    <label class="text-dark" for="txtCustName">Cust. Name</label>
                                    <input id="txtCustName" value="{{ $cust_name }}" type="text" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtAddress">Cust. Address</label>
                                    <input class="form-control basic" value="{{ $cust_address }}" name="txtAddress" id="txtAddress" readonly>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtPhone">Phone</label>
                                    <input id="txtPhone" value="{{ $phone }}" type="text" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-12">
                                    <label class="text-dark" for="txtConsignee">Consignee</label>
                                    <small id="txtConsigneeBadge"></small>
                                    <select class="form-control basic" name="txtConsignee" id="txtConsignee">
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtSalesman">Salesman</label>
                                    <select class="form-control basic" name="txtSalesman" id="txtSalesman">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtProjectFlag">Project Flag</label>
                                    <select class="form-control basic" name="txtProjectFlag" id="txtProjectFlag">
                                        @if ( $proj_flag == 'T')
                                        <option value="N">Non Project</option>
                                        <option value="T" selected>Project</option>
                                        @else
                                        <option value="N" selected>Non Project</option>
                                        <option value="T">Project</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtPayment">Payment</label>
                                    <select class="form-control basic" name="txtPayment" id="txtPayment">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label class="text-dark" for="txtPayment">Cust. PO Number</label>
                                    <input type="text" value="{{ $cust_po_num }}" name="txtCustPoNumber" id="txtCustPoNumber" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-6">
                                <div class="form-group col-md-6">
                                    <label class="text-dark" for="txtRemark">Remark</label>
                                    <textarea class="form-control" id="txtRemark" name="txtRemark" rows="3">{{ $remark1 }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-dark" for="txtAddRemark">Additional Remark</label>
                                    <textarea class="form-control" id="txtAddRemark" name="txtAddRemark" rows="3">{{ $remark2 }}</textarea>
                                </div>
                            </div>
                        </section>

                        <h3>Add Item</h3>
                        <section id='section_2'>

                            <small class="text-muted">BookId#&nbsp; <small id="hdrInvoiceNo"></small></small>
                            <br>
                            <h5>Bill To</h5>
                            <div>
                                <span class="p_style" id="hdrCustName"></span>
                            </div>
                            <div>
                                <span class="p_style" id="hdrCustAddress"></span>
                            </div>
                            <div>    
                                <span class="p_style" id="hdrCustPhone"></span>
                            </div>
                            <hr class="style">
                            <h5>Ship To</h5>
                            <div>
                                <span class="p_style" id="hdrShipTo"></small>
                            </div>
                            <br>
                            <button class="btn btn-success" style="float: left" id="add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                Item
                            </button>
                            <button class="btn btn-secondary" id="ShowOrderItemList">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 
1-8 0"></path></svg>
                                Order Item List
                            </button>
                            <br>
                            <br>

                            <div id="AddItem" style="display: none">
                                <hr class="style">
                                <a href="javascript:void(0)" style="float: right; font-size: 12px" class="close_form">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    Close
                                </a>
                                <br>
                                <p class="p_style">
                                    Here's form to add an item to this order using product search.
                                </p>
                                <p class="p_style">
                                    If you wanna adding an item without searching product first, you can use <a href="javascript:void(0)" id="byremark" style="color: #8dbf42; font-weight: 
bold;">this</a> instead.
                                </p>
                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtCommodity">Commodity</label>
                                        <select class="form-control basic" name="txtCommodity" id="txtCommodity">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtBrand">Brand</label>
                                        <select class="form-control basic" name="txtBrand" id="txtBrand">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtBrandCoat">Coat (AS-AZ)</label>
                                        <select class="form-control basic" name="txtBrandCoat" id="txtBrandCoat">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtGrade">Grade</label>
                                        <select class="form-control basic" name="txtGrade" id="txtGrade">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtThickness">Thick</label>
                                        <small id="txtThicknessBadge"></small>
                                        <select class="form-control basic" name="txtThickness" id="txtThickness">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <label class="text-dark" for="txtWidth">Width</label>
                                        <small id="txtWidthBadge"></small>
                                        <select class="form-control basic" name="txtWidth" id="txtWidth">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12 col-12">
                                        <label class="text-dark" for="txtColor">Color</label>
                                        <small id="txtColorBadge"></small>
                                        <select class="form-control basic" name="txtColor" id="txtColor">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtProduct">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 
16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                        Product</label>
                                        <small id="txtProductBadge"></small>
                                        <select class="form-control basic product" name="txtProduct" id="txtProduct">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="ItemProperty" style="display: none">
                                <hr class="style">
                                <div id="info1" style="display: none">
                                    <a href="javascript:void(0)" style="float: right; font-size: 12px" class="close_form">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        Close
                                    </a>
                                    <br>
                                    <p class="p_style">
                                        Here's form to add an item to this order without searching product first.
                                    </p>
                                    <p class="p_style">
                                        If you prefer adding an item using product search, you can use <a href="javascript:void(0)" id="byproduct"
                                        style="color: #8dbf42; font-weight: bold;">this</a> instead.
                                    </p>
                                </div>
                                <div id="info2" style="display: none">
                                    <p class="p_style">Here's product attribute form that you might filled in for an item you've choosen above</p>
                                </div>
                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtWeight">Weight (KG)</label>
                                        <div class="input-group mb-6">
                                            <input class="form-control" type="number" min="0" step="10" onkeyup="if(this.value<0){this.value= this.value * -1};" id="txtWeight" name="txtWeight"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">kilogram (KG)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-6">
                                        <label class="text-dark" for="txtPrice">Unit Price</label>
                                        <input class="form-control" id="txtPrice" name="txtPrice" readonly/>
                                        <input type="hidden" id="txtPriceVal" name="txtPriceVal">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-dark" for="txtExtraPrice">Extra Price</label>
                                        <input class="form-control" value='0' id="txtExtraPrice" name="txtExtraPrice" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"/>
                                        <input type="hidden" id="txtExtraPriceVal" name="txtExtraPriceVal">
                                    </div>
                                </div>

                                {{-- <div class="form-row mb-6" id="AmtGross" style="display: none">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtPrice">Amt. Gross</label>
                                        <input id="txtAmtGross" type="text" class="form-control">
                                    </div>
                                </div> --}}

                                <div class="form-row mb-6">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtItemRemark">Remark</label>
                                        <textarea class="form-control" id="txtItemRemark" name="txtItemRemark" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-row mb-6" id="ApplNote" style="display: none">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark" for="txtApplNote">Appl. Note</label>
                                        <select class="form-control basic" name="txtApplNote" id="txtApplNote">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-6" style="display: none">
                                    <div class="form-group col-md-12 col-12">
                                        <label class="text-dark" for="txtReqDate">Req. Date</label>
                                        <input id="txtReqDate" class="form-control flatpickr flatpickr-input active" type="text">
                                    </div>
                                </div>

                                <div class="form-row mb-6" style="display: none">
                                    <div class="form-group col-md-4 col-4">
                                        <label class="text-dark" for="txtReqWeek">Req. Week</label>
                                        <select class="form-control basic" name="txtReqWeek" id="txtReqWeek">
                                            <option></option>
                                            <option value="1st Week">1st Week</option>
                                            <option value="2nd Week">2nd Week</option>
                                            <option value="3rd Week">3rd Week</option>
                                            <option value="4th Week">4th Week</option>
                                            <option value="5th Week">5th Week</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-4" style="display: none">
                                        <label class="text-dark" for="txtReqMonth">Req. Month</label>
                                        <select class="form-control basic" name="txtReqMonth" id="txtReqMonth">
                                            <option></option>
                                            <option value="Jan">Jan</option>
                                            <option value="Feb">Feb</option>
                                            <option value="Amr">Mar</option>
                                            <option value="Apr">Apr</option>
                                            <option value="May">May</option>
                                            <option value="Jun">Jun</option>
                                            <option value="Jul">Jul</option>
                                            <option value="Aug">Aug</option>
                                            <option value="Sep">Sep</option>
                                            <option value="Oct">Oct</option>
                                            <option value="Nov">Nov</option>
                                            <option value="Dec">Dec</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-4" style="display: none">
                                        <label class="text-dark" for="txtReqYear">Req. Year</label>
                                        <select class="form-control basic" name="txtReqYear" id="txtReqYear">
                                            <option></option>
                                            @for ($i = $year_now; $i <= $year_later; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-block mb-4 mr-2" id="saveOrderItem">Add Item</button>
                            </div>
                        </section>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="OrderItemList" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Order Item List</h5>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>
			<div class="modal-body">
            
                <div class="table-responsive" id="TableOrderContainer" style="display: none">
                    <table id="TableOrderItemList" class="table mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th>No</th>
                                <th>Descr</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div id="InfoContainer" style="display: none">    
                    <div class="alert alert-arrow-left alert-icon-left alert-light-warning mb-4" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <strong>Whops!</strong> Your list is empty.
                    </div>
                </div>

				
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal">Discard</button>
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
<script src="{{ asset('outside/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('outside/plugins/jquery-step/jquery.steps.min.js') }}"></script>
<script src="{{ asset('outside/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" 
crossorigin="anonymous"></script>
<script>

var count, txtGroup, txtSalesid, txtCustID, ConsigneeID, cek_bottom_price, txtPriceConst ;
var setBookId = $('#setBookId').val();



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

function listCustomer(txtGroup, txtSalesid, txtCustID){
    
    $.ajax({
        type: "POST",
        url: "{{ url('listCustomer') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'txtGroup': txtGroup,
            'txtSalesid': txtSalesid,
            'txtCustID': txtCustID
        },
        success: function(data) {

            count = Object.keys(data).length;

            if (count < 2) {


                @if(Session::get('GROUPID') == 'SALES')

                    $('select[name="txtCustomer"]').empty();
                    $('select[name="txtCustomer"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'" selected>'+element.cust_id+' | '+element.cust_name+'</option>');
                    });
                    $('#txtCustomer').prop('disabled', false);


                @endif
                
                @if(Session::get('GROUPID') == 'CUSTOMER')

                    $('select[name="txtCustomer"]').empty();
                    $('select[name="txtCustomer"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'" selected>'+element.cust_id+' | '+element.cust_name+'</option>');
                    });
                    $('#txtCustomer').prop('disabled', true);


                @endif

            }

            else {
                
                $('select[name="txtCustomer"]').empty();
                $('select[name="txtCustomer"]').prepend('<option></option>');
                $.each(data, function(index, element) {
                    if ( element.cust_id == '{{ $cust_id }}') {
                        $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'" selected>'+element.cust_id+' | '+element.cust_name+'</option>');
                    }
                    else {
                        $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'">'+element.cust_id+' | '+element.cust_name+'</option>');
                    }
                });
                $('#txtCustomer').prop('disabled', false);

            }
        }
    });


    $('#txtCustomer').select2({
        placeholder: 'Choose customer below',
        allowClear: true
    });

    

}

function searchCustomer(){

    $('#txtCustomer').select2({
      placeholder: "Type any existing custid or custname . . .",
      allowClear: true,
	    minimumInputLength: 3,
        ajax: {
            url: "{{url('listAllCustomer')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                return {
                    text: item.cust_id + " || " + item.cust_name,
                    id: item.cust_id,
                }
                })
            };

            },
            cache: false
        }
    });
}

function getCustDetails(id){
    
    $.ajax({
            url: "{{url('getCustDetails/id=')}}"+id,  
            type: "GET",
            dataType: 'json',
            success: function(data){
                $('#txtStrata').val("00"+data.strata);
                $('#txtStr1').val(data.str1);
                $('#txtCustID').val(data.cust_id);
                $('#txtCustName').val(data.cust_name);
                $('#txtAddress').val(data.address1+" "+data.address2+", "+data.city+", "+data.prov);
                $('#txtPhone').val(data.phone);
                $('#txtDiscLoco').val(data.disc_loco);
            }
    });
}

function listConsignee(id){

    var html;
    
    if (!id) {

        $('#txtConsignee').select2({
            placeholder: "Choose customer first",
        });
        $('select[name="txtConsignee"]').empty();
        $('select[name="txtConsignee"]').prepend('<option></option>');
        html = "<span class='shadow-none badge badge-danger'>N/A</span>";
        $('#txtConsigneeBadge').empty();
        $('#txtConsigneeBadge').append(html);
    }

    else {

        $.ajax({
            type: "GET",
            dataType: "json",
            async: true,
            url: "{{url('getConsignee/id=')}}"+id, 
            success: function (data) {

                if (data.length < 1) {

                    html = "<span class='shadow-none badge badge-danger'>N/A</span>";
                    $('#txtConsigneeBadge').empty();
                    $('#txtConsigneeBadge').append(html);
                    $('select[name="txtConsignee"]').empty();
                    $('select[name="txtConsignee"]').prepend('<option></option>');
                        $.each(data, function(index, element) {

                            if ( element.cons_id == '{{ $cons_id }}') {
                                $('select[name="txtConsignee"]').append('<option value="'+element.cons_id+'" selected>'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                            }
                            else {
                                $('select[name="txtConsignee"]').append('<option value="'+element.cons_id+'">'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                            }
                            
                        });
                }
                else {

                    html = "<span class='shadow-none badge badge-success'>"+data.length+" found</span>";
                    $('#txtConsigneeBadge').empty();
                    $('#txtConsigneeBadge').append(html);
                    $('select[name="txtConsignee"]').empty();
                    $('select[name="txtConsignee"]').prepend('<option></option>');
                        $.each(data, function(index, element) {

                            if ( element.cons_id == '{{ $cons_id }}') {
                                $('select[name="txtConsignee"]').append('<option value="'+element.cons_id+'" selected>'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                            }
                            else {
                                $('select[name="txtConsignee"]').append('<option value="'+element.cons_id+'">'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                            }
                            
                        });

                }
            }
        });

        $('#txtConsignee').select2({
            placeholder: 'Choose consignee below',
            allowClear: true
        });
    }
    
}

function setCustDetailsEmpty(){

    $('#txtCustID').val('');
    $('#txtCustName').val('');
    $('#txtAddress').val('');
    $('#txtPhone').val('');

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
                    if ( element.salesman_id == '{{ $salesman_id }}') {
                        $('select[name="txtSalesman"]').append('<option value="'+element.salesman_id+'" selected>'+element.salesman_name+'</option>');
                    }
                    else {
                        $('select[name="txtSalesman"]').append('<option value="'+element.salesman_id+'">'+element.salesman_name+'</option>');
                    }
                });
                $('#txtSalesman').prop('disabled', false);
            }
        }
    });


    $('#txtSalesman').select2({
        placeholder: 'Choose salesman below',
        allowClear: true
    });

    

}

function listProjectFlag () {

    $('#txtProjectFlag').select2({
        placeholder: 'Choose customer below',
        allowClear: true
    });

}

function listPayment(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listPayment')}}",
        success: function (data) {
            $('select[name="txtPayment"]').empty();
            $('select[name="txtPayment"]').prepend('<option></option>');
            $.each(data, function(index, element) {

                if ( element.pay_term_id == '{{ $pay_term_id }}') {
                    $('select[name="txtPayment"]').append('<option value="'+element.pay_term_id+'" selected>'+element.pay_term_desc+'</option>');
                }
                else {
                    $('select[name="txtPayment"]').append('<option value="'+element.pay_term_id+'">'+element.pay_term_desc+'</option>');
                }
           
            });
        }
    });

    $('#txtPayment').select2({
        placeholder: 'Choose payment below',
        allowClear: true
    });

}

function updateOrderHeader(){

    setBookId = $('#setBookId').val();
    var mill_id = 'SR';
    var txtCustID = $('#txtCustID').val();
    var txtCustName = $('#txtCustName').val();
    var txtAddress = $('#txtAddress').val();
    var txtPhone = $('#txtPhone').val();

    var e = document.getElementById("txtConsignee");
    var txtConsId = e.options[e.selectedIndex].value;
    var txtShipTo = e.options[e.selectedIndex].text;

    var f = document.getElementById("txtShipTerm");
    var txtDelivMode = f.options[f.selectedIndex].value;

    var txtSalesman = $('#txtSalesman').val();
    var txtRemark = $('#txtRemark').val();
    var txtAddRemark = $('#txtAddRemark').val();
    var txtPayment = $('#txtPayment').val();
    var txtProjectFlag = $('#txtProjectFlag').val();
    var txtCustPoNumber = $('#txtCustPoNumber').val();

    if (setBookId) {

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('getOrderHeader/id=')}}"+setBookId,  
            success: function (data) {

                var db_cust_id = data['cust_id'];
                var db_deliv_mode = data['deliv_mode'];
                var db_cons_id = data['cons_id'];
                var db_salesman_id = data['salesman_id'];
                var db_proj_flag= data['proj_flag'];
                var db_pay_term_id = data['pay_term_id'];
                var db_cust_po_num = data['cust_po_num'];
                var db_remark1 = data['remark1'];
                var db_remark2 = data['remark2'];

                if ((txtCustID != db_cust_id) || (txtDelivMode != db_deliv_mode) || (txtConsId != db_cons_id) || (txtSalesman != db_salesman_id) || (txtProjectFlag != db_proj_flag) || (txtPayment != db_pay_term_id) || (txtCustPoNumber != db_cust_po_num) || (txtRemark != db_remark1) || (txtAddRemark != db_remark2) ){

                    $.ajax({
                        type:"POST",
                        url:"{{ url('updateOrderHeader') }}",
                        data:{
                        '_token': '{{ csrf_token() }}',
                        'book_id': setBookId,
                        'mill_id': mill_id,
                        'cust_id': txtCustID,
                        'deliv_mode' : txtDelivMode,
                        'cust_name': txtCustName,
                        'cust_address': txtAddress,
                        'phone': txtPhone,
                        'cons_id': txtConsId,
                        'ship_to': txtShipTo,
                        'salesman_id': txtSalesman,
                        'remark1': txtRemark,
                        'remark2': txtAddRemark,
                        'pay_term_id': txtPayment,
                        'proj_flag': txtProjectFlag,
                        'cust_po_num': txtCustPoNumber
                        },
                        success:function(data) {

                            if((data['response']) == 'Order Updated'){
                                swal("Success", (data['response']) , "success");

                                $('#hdrCustName').text(txtCustName);
                                $('#hdrCustAddress').text(txtAddress);
                                $('#hdrCustPhone').text(txtPhone);
                                $('#hdrShipTo').text(txtShipTo);

                            }
                            else{
                                swal("Error", (data['response']) , "error");
                            }
                        }
                    });

                }
                else {

                    $('#hdrCustName').text(txtCustName);
                    $('#hdrCustAddress').text(txtAddress);
                    $('#hdrCustPhone').text(txtPhone);
                    $('#hdrShipTo').text(txtShipTo);
                }
            }
        });
    }
    else {
        swal("Error", "BookId not set", "error");
    }
   

}

function listCommodity(){
	var descr;
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listCommodity')}}", 
        success: function (data) {
            $('select[name="txtCommodity"]').empty();
            $('select[name="txtCommodity"]').prepend('<option></option>');
            $.each(data, function(index, element) {
				if (element.descr == 'GALVALUM') {
					descr = 'FULL WIDTH';
				}
				else {
					descr = 'SLITTED';
				}
				$('select[name="txtCommodity"]').append('<option value="'+element.commodity_id+'">'+descr+'</option>');
			});
        }
    });

    $('#txtCommodity').select2({
        placeholder: 'Choose commodity below',
        allowClear: true
    });
  

}

function listBrand(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listBrand')}}", 
        success: function (data) {
            $('select[name="txtBrand"]').empty();
            $('select[name="txtBrand"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtBrand"]').append('<option value="'+element.brand_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#txtBrand').select2({
        placeholder: 'Choose brand below',
        allowClear: true
    });

}

function listCoat(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listCoat')}}", 
        success: function (data) {
            $('select[name="txtBrandCoat"]').empty();
            $('select[name="txtBrandCoat"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtBrandCoat"]').append('<option value="'+element.coat_mass+'">AS'+element.coat_mass+' | '+element.brand_name+'</option>');
            });
        }
    });

    $('#txtBrandCoat').select2({
        placeholder: 'Choose coat below',
        allowClear: true
    });

}

function listGrade(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listGrade')}}", 
        success: function (data) {
            $('select[name="txtGrade"]').empty();
            $('select[name="txtGrade"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtGrade"]').append('<option value="'+element.grade_id+'">'+element.grade_id+'</option>');
            });
        }
    });

    $('#txtGrade').select2({
        placeholder: 'Choose grade below',
        allowClear: true
    });

}

function allThickness(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('allThickness')}}", 
        success: function (data) {
            $('select[name="txtThickness"]').empty();
            $('select[name="txtThickness"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtThickness"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtThickness').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function commodityThickness(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('commodityThickness/id=')}}"+id, 
        success: function (data) {
            $('select[name="txtThickness"]').empty();
            $('select[name="txtThickness"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtThickness"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtThickness').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function brandThickness(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('brandThickness/id=')}}"+id, 
        success: function (data) {
            $('select[name="txtThickness"]').empty();
            $('select[name="txtThickness"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtThickness"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtThickness').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function getThickness(a, b){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('getThickness/a=')}}"+a+ "&b=" +b, 
        success: function (data) {
            $('select[name="txtThickness"]').empty();
            $('select[name="txtThickness"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtThickness"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtThickness').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });


}

function allWidth(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('allWidth')}}", 
        success: function (data) {
            $('select[name="txtWidth"]').empty();
            $('select[name="txtWidth"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtWidth"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtWidth').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function commodityWidth(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('commodityWidth/id=')}}"+id, 
        success: function (data) {
            $('select[name="txtWidth"]').empty();
            $('select[name="txtWidth"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtWidth"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtWidth').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function brandWidth(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('brandWidth/id=')}}"+id, 
        success: function (data) {
            $('select[name="txtWidth"]').empty();
            $('select[name="txtWidth"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtWidth"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtWidth').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function getWidth(a, b){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('getWidth/a=')}}"+a+ "&b=" +b, 
        success: function (data) {
            $('select[name="txtWidth"]').empty();
            $('select[name="txtWidth"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtWidth"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#txtWidth').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function allColour(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('allColour')}}", 
        success: function (data) {
            $('select[name="txtColor"]').empty();
            $('select[name="txtColor"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtColor"]').append('<option value="'+element.color_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#txtColor').select2({
        placeholder: 'Choose color below',
        allowClear: true
    });

}

function getColour(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('getColour/id=')}}"+id, 
        url: "getColour/id="+id,
        success: function (data) {
            $('select[name="txtColor"]').empty();
            $('select[name="txtColor"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtColor"]').append('<option value="'+element.color_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#txtColor').select2({
        placeholder: 'Choose color below',
        allowClear: true
    });

}

function listAppl(){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('listAppl')}}", 
        success: function (data) {
            $('select[name="txtApplNote"]').empty();
            $('select[name="txtApplNote"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="txtApplNote"]').append('<option value="'+element.appl_name+'">'+element.appl_name+'</option>');
            });
        }
    });

    $('#txtApplNote').select2({
        placeholder: 'Choose appl below',
        allowClear: true
    });

}

function listReqWeek(){
    $('#txtReqWeek').select2({
        placeholder: "Week Req."
    });
}

function listReqMonth(){
    $('#txtReqMonth').select2({
        placeholder: "Month Req."
    });
}

function listReqYear(){
    $('#txtReqYear').select2({
        placeholder: "Year Req."
    });
}

function listProduct(){
    $('#txtProduct').select2({
        placeholder: "Choose parameter first",
    });
    setBadgeNotReady();
}

function setBadgeNotReady(){

    $('select[name="txtProduct"]').empty();
    html = "<span class='shadow-none badge badge-danger'>N/A</span>";
    $('#txtProductBadge').empty();
    $('#txtProductBadge').append(html);
}

function setNullProduct(){

    var product = $('#txtProduct').val();

    if (product){
        ItemProperty.style.display = "block";
        info2.style.display = "block";

        $('html, body').animate({
            scrollTop: $("#ItemProperty").offset().top
        }, 1200);
    }
    else {
        ItemProperty.style.display = "none";
        info2.style.display = "none";
        setBadgeNotReady();
    }
}

function getProduct(){

        var commodity = $('#txtCommodity').val();
        var brand= $('#txtBrand').val();
        var coat = $('#txtBrandCoat').val();
        var grade = $('#txtGrade').val();
        var thick = $('#txtThickness').val();
        var width = $('#txtWidth').val();
        var colour = $('#txtColor').val();
        var allreq = '';

        if (commodity) {

            allreq = allreq+'&commodity='+commodity.trim();
        }

        if (brand) {

            allreq = allreq+'&brand='+brand.trim();
        }

        if (coat) {

            allreq = allreq+'&coat='+coat.trim();
        }

        if (grade) {

            allreq = allreq+'&grade='+grade.trim();
        }

        if (thick) {

            allreq = allreq+'&thick='+thick.trim();
        }

        if (width) {

            allreq = allreq+'&width='+width.trim();
        }

        if (colour) {

            allreq = allreq+'&colour='+colour.trim();
        }


        if (!allreq) {

            setBadgeNotReady();
            listProduct();

        }

        else if (allreq) {

            $.ajax({
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "POST",
                dataType: "json",
                async: true,
                url: '{!!url("getProduct")!!}'+'?'+allreq,
                    success: function (data) {
                        if (data.length < 1 ){

                            html = "<span class='shadow-none badge badge-danger'>N/A</span>";
                            $('#txtProductBadge').empty();
                            $('#txtProductBadge').append(html);
                            $('select[name="txtProduct"]').empty();
                            $('select[name="txtProduct"]').prepend('<option></option>');
                            // console.log(data.length);

                            $.each(data, function(index, element) {
                                $('select[name="txtProduct"]').append('<option value="'+element.prod_code+'">'+element.descr+'</option>');
                            });

                        }
                        else {

                            html = "<span class='shadow-none badge badge-success'>"+data.length+" product found</span>";
                            $('#txtProductBadge').empty();
                            $('#txtProductBadge').append(html);
                            $('select[name="txtProduct"]').empty();
                            $('select[name="txtProduct"]').prepend('<option></option>');
                            // console.log(data.length);

                                $.each(data, function(index, element) {
                                    $('select[name="txtProduct"]').append('<option value="'+element.prod_code+'">'+element.descr+'</option>');
                                });
                        }

                    }
                });

                $('#txtProduct').select2({
                    placeholder: 'Choose product below',
                    allowClear: true
                });


            }
}

function setEmpty(){
    
    $('#txtCommodity').val('').trigger('change');
    $('#txtBrand').val('').trigger('change');
    $('#txtBrandCoat').val('').trigger('change');
    $('#txtGrade').val('').trigger('change');
    $('#txtThickness').val('').trigger('change');
    $('#txtWidth').val('').trigger('change');
    $('#txtColor').val('').trigger('change');
    $('#txtProduct').val('').trigger('change');
    $('#txtWeight').val('');
    $('#txtPrice').val('');
    $('#txtAmtGross').val('');
    $('#txtItemRemark').val('');
    $('#txtApplNote').val('').trigger('change');
    $('#txtReqDate').val('').trigger('change');
    $('#txtReqWeek').val('').trigger('change');
    $('#txtReqMonth').val('').trigger('change');
    $('#txtReqYear').val('').trigger('change');
}

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

function listOrderItem() {

    setBookId = $('#setBookId').val();
    $('#TableOrderItemList').DataTable().ajax.url("{{url('getItemDetail?id=')}}"+setBookId).load();
    TableOrderContainer.style.display = "block";
    InfoContainer.style.display = "none";

}

function submitOrder() {

    setBookId = $('#setBookId').val();

    swal({
        title: 'Are you sure?',
        text: "Posted this order",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        padding: '2em'
        }).then(function(result) {
            
            if (result.value) {

                if (setBookId) {

                    $.ajax({
                        type:"POST",
                        url:"{{ url('submitOrder') }}",
                        data:{
                        '_token': '{{ csrf_token() }}',
                        'book_id': setBookId
                        },
                        success:function(data) {

                            if((data['response']) == 'Order Submitted'){

                                swal("Success", (data['response']) , "success")
                                    .then(function(){
                                        $(location).attr("href", "{{ url('ListOrder') }}");
                                    }
                                    );
                            }
                            else if((data['response']) == "There's something error when submitting order"){
                                swal("error", (data['response']) , "error");
                            }
                            else if((data['response']) == "Book Id not found"){
                                swal("error", (data['response']) , "error");
                            }
                            else{
                                swal("Error", (data['response']) , "error");
                            }
                        }
                    });

                    }

                else {
                swal("Whops", "Book Id havent set yet", "error");
                }
            }
        });
}

function listShipTerm () {

    $('#txtShipTerm').select2({
        placeholder: 'Choose ship term below',
        allowClear: true
    });

}

function roundNumber(num, scale) {
  if(!("" + num).includes("e")) {
    return +(Math.round(num + "e+" + scale)  + "e-" + scale);
  } else {
    var arr = ("" + num).split("e");
    var sig = ""
    if(+arr[1] + scale > 0) {
      sig = "+";
    }
    return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
  }
}

function  formatNumber (num) {

    var curr = num.toFixed(2).replace(',', '.');
    var parts = curr.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");           
} 

function FormatCurrency(ctrl) {
    if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
        return;
    }

    var val = ctrl.value;

    val = val.replace(/,/g, "")
    ctrl.value = "";
    val += '';
    x = val.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';

    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }

    ctrl.value = x1 + x2;
}

function CheckNumeric() {
    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
}



$(document).ready(function() {

    $('#homeNav').attr('data-active','false');
    $('#homeNav').attr('aria-expanded','false');
    $('#CustOrderNav').attr('data-active','true');
    $('#CustOrderNav').attr('aria-expanded','true');
    $('.CustOrderTreeView').addClass('show');
    //$('#CreateOrder').addClass('active');

    $("#example-vertical").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        cssClass: 'circle wizard',
        onStepChanging: function (event, currentIndex, newIndex)
        {

            var txtConsignee =  $('#txtConsignee').val();
            var txtShipTerm =  $('#txtShipTerm').val();
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            if (newIndex === 1 && !txtShipTerm)
            {
                swal('Whops', 'Please choose ship term first', 'error')
                return false;
                
            }
            if (newIndex === 1 && !txtConsignee)
            {
                swal('Whops', 'Please choose consignee first', 'error')
                return false;
                
            }
            if (newIndex === 1 && txtConsignee && txtShipTerm)
            {
                AddItem.style.display = 'none';
                ItemProperty.style.display = 'none';
                setEmpty();
                setBadgeNotReady();
                updateOrderHeader();
                listCommodity();listBrand();listCoat();
                listGrade();allThickness();allWidth();
                allColour();listAppl();listReqWeek();
                listReqMonth();listReqYear();listProduct();
                return true;
                
            }
        },
        onFinished: function (event, currentIndex)
        {

            submitOrder();
            
        }
    });

    $('#hdrInvoiceNo').text(setBookId);
    var id = '{{$cust_id}}';
    listProjectFlag(); listPayment(); listConsignee(id); listShipTerm();

    var f1 = flatpickr(document.getElementById('txtReqDate'), {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        disableMobile: "true",
    });

    $('.basic').on('select2:open', function() {
        if (Modernizr.touch) {
            $('.select2-search__field').prop('focus', false);
        }
    });

    $('#add').on('click', function() {
        event.preventDefault();
        AddItem.style.display = 'block';

        $('html, body').animate({
            scrollTop: $("#AddItem").offset().top
        }, 1200);

    });

    $('#ShowOrderItemList').on('click', function() {

        $('#OrderItemList').modal();

    });

    $('.close_form').on('click', function() {
        event.preventDefault();
        AddItem.style.display = 'none';
        ItemProperty.style.display = 'none';
        setEmpty();
        setBadgeNotReady();

    });

    $('#byremark').on('click', function() {
        setEmpty();
        setBadgeNotReady();
        ItemProperty.style.display = "block";
        AddItem.style.display = "none";
        info1.style.display = "block";
        info2.style.display = "none";
    });

    $('#byproduct').on('click', function() {
        setEmpty();
        setBadgeNotReady();
        ItemProperty.style.display = "none";
        AddItem.style.display = "block";
        info1.style.display = "none";
        info2.style.display = "block";
    });

    $('#txtCustomer').change(function(){

        var id = $( "#txtCustomer").val();

        if (id) {

            getCustDetails(id);
            listConsignee(id);

        }

        else {

            listConsignee(ConsigneeID);
            setCustDetailsEmpty();

        }
    });

    $('#txtCommodity').change(function(){

        setBadgeNotReady();
        setNullProduct();
        var commodity = $('#txtCommodity').val();
        var brand = $('#txtBrand').val();
        $('select[name="txtThickness]').empty();
        $('select[name="txtWidth"]').empty();


        if (!commodity && !brand){

            $('#txtThicknessBadge').empty();
            $('#txtWidthBadge').empty();
            allThickness();
            allWidth();
        }

        else if (commodity && !brand){

            html1 = "<span class='shadow-none badge badge-success'>"+commodity+" bound</span>";
            $('#txtThicknessBadge').empty();
            $('#txtThicknessBadge').append(html1);

            html2 = "<span class='shadow-none badge badge-success'>"+commodity+" bound</span>";
            $('#txtWidthBadge').empty();
            $('#txtWidthBadge').append(html2);

            commodityThickness(commodity);
            commodityWidth(commodity);

        }

        else if (!commodity  && brand){

            html1 = "<span class='shadow-none badge badge-success'>"+brand+" bound</span>";
            $('#txtThicknessBadge').empty();
            $('#txtThicknessBadge').append(html1);

            html2 = "<span class='shadow-none badge badge-success'>"+brand+" bound</span>";
            $('#txtWidthBadge').empty();
            $('#txtWidthBadge').append(html2);

            brandThickness(brand);
            brandWidth(brand);

        }

        else{
            
            html1 = "<span class='shadow-none badge badge-success'>"+commodity+'-'+brand+" bound</span>";
            $('#txtThicknessBadge').empty();
            $('#txtThicknessBadge').append(html1);

            html2 = "<span class='shadow-none badge badge-success'>"+commodity+'-'+brand+" bound</span>";
            $('#txtWidthBadge').empty();
            $('#txtWidthBadge').append(html2);

            getThickness(commodity, brand);
            getWidth(commodity, brand);

        }

        getProduct();

    });

    $('#txtBrand').change(function(){

        setBadgeNotReady();
        setNullProduct();
        var commodity = $('#txtCommodity').val();
        var brand = $('#txtBrand').val();
        $('select[name="txtThickness]').empty();
        $('select[name="txtWidth"]').empty();
        $('select[name="txtColor"]').empty();

        if (!brand){

            $('#txtColorBadge').empty();
            allColour();
        }

        else {

            html = "<span class='shadow-none badge badge-success'>"+brand+" bound</span>";
            $('#txtColorBadge').empty();
            $('#txtColorBadge').append(html);
            getColour(brand);
        }


        if (!commodity && !brand){

            $('#txtThicknessBadge').empty();
            $('#txtWidthBadge').empty();
            allThickness();
            allWidth();
        }

        else if (commodity && !brand){

            html1 = "<span class='shadow-none badge badge-success'>"+commodity+" bound</span>";
            $('#txtThicknessBadge').empty();
            $('#txtThicknessBadge').append(html1);

            html2 = "<span class='shadow-none badge badge-success'>"+commodity+" bound</span>";
            $('#txtWidthBadge').empty();
            $('#txtWidthBadge').append(html2);

            commodityThickness(commodity);
            commodityWidth(commodity);

        }

        else if (!commodity  && brand){

            html1 = "<span class='shadow-none badge badge-success'>"+brand+" bound</span>";
            $('#txtThicknessBadge').empty();
            $('#txtThicknessBadge').append(html1);

            html2 = "<span class='shadow-none badge badge-success'>"+brand+" bound</span>";
            $('#txtWidthBadge').empty();
            $('#txtWidthBadge').append(html2);

            brandThickness(brand);
            brandWidth(brand);

        }

        else{
            
            html1 = "<span class='shadow-none badge badge-success'>"+commodity+'-'+brand+" bound</span>";
            $('#txtThicknessBadge').empty();
            $('#txtThicknessBadge').append(html1);

            html2 = "<span class='shadow-none badge badge-success'>"+commodity+'-'+brand+" bound</span>";
            $('#txtWidthBadge').empty();
            $('#txtWidthBadge').append(html2);

            getThickness(commodity, brand);
            getWidth(commodity, brand);

        }

        getProduct();

    });

    $('#txtBrandCoat').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#txtGrade').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#txtThickness').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#txtWidth').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#txtColor').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });
  
    $('#txtProduct').change(function(){

        setNullProduct();

        $('#txtPrice').val('');


        var txtStrata = $('#txtStrata').val();
        var txtCustID = $('#txtCustID').val();
        var txtStr1 = $('#txtStr1').val();
        var txtDiscLoco = $('#txtDiscLoco').val();
        var txtDelivMode = $('#txtShipTerm').val();
        var txtProduct = $('#txtProduct').val();
        var txtFinalPrice;
        // alert(txtStrata+", "+txtCustID+", "+txtStr1+", "+txtDelivMode)

        // var block = $('#txtPrice');
        // blockElement(block);

        if (txtProduct) {

            $.ajax({
            url: "{{url('getPrice')}}",  
            type: "POST",
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                'txtStrata': txtStrata,
                'txtCustID': txtCustID,
                'txtStr1' : txtStr1,
                'txtDelivMode' : txtDelivMode,
                'txtProduct' : txtProduct

            },
            success: function(data) {

                if (data.length > 0) {


                    $.each(data, function(index, element) {

                        if (txtDelivMode == "LOCO") {

                            if (element.commodity_id == "SLT") {

                                txtFinalPrice = (parseFloat(element.stdprice) - parseFloat(element.DiskonStrata) - parseFloat(element.DiskonQuality) - parseFloat(txtDiscLoco) + parseFloat(element.BiayaSlit)) / 1.1;
                                txtFinalPrice = roundNumber(txtFinalPrice, 2)
                                $('#txtPrice').val(formatNumber(txtFinalPrice));
                                $('#txtPriceVal').val(txtFinalPrice);

                                $('#txtExtraPriceVal').val(parseFloat(element.DiskonStrata).toFixed(2));

                                txtPriceConst =   Number($('#txtPrice').val().replace(/[^0-9.-]+/g,""));


                            }
                            else {

                                txtFinalPrice = (parseFloat(element.stdprice) - parseFloat(element.DiskonStrata) - parseFloat(element.DiskonQuality) - parseFloat(txtDiscLoco)) / 1.1;
                                txtFinalPrice = roundNumber(txtFinalPrice, 2)
                                $('#txtPrice').val(formatNumber(txtFinalPrice));
                                $('#txtPriceVal').val(txtFinalPrice);

                                $('#txtExtraPriceVal').val(parseFloat(element.DiskonStrata).toFixed(2));

                                txtPriceConst =   Number($('#txtPrice').val().replace(/[^0-9.-]+/g,""));
                            }
                        }
                        else {

                            if (element.commodity_id == "SLT") {

                                txtFinalPrice = (parseFloat(element.stdprice) - parseFloat(element.DiskonStrata) - parseFloat(element.DiskonQuality) + parseFloat(element.BiayaSlit)) / 1.1;
                                txtFinalPrice = roundNumber(txtFinalPrice, 2)
                                $('#txtPrice').val(formatNumber(txtFinalPrice));
                                $('#txtPriceVal').val(txtFinalPrice);

                                $('#txtExtraPriceVal').val(parseFloat(element.DiskonStrata).toFixed(2));

                                txtPriceConst =   Number($('#txtPrice').val().replace(/[^0-9.-]+/g,""));

                            }
                            else {

                                txtFinalPrice = (parseFloat(element.stdprice) - parseFloat(element.DiskonStrata) - parseFloat(element.DiskonQuality)) / 1.1;
                                txtFinalPrice = roundNumber(txtFinalPrice, 2)
                                $('#txtPrice').val(formatNumber(txtFinalPrice));
                                $('#txtPriceVal').val(txtFinalPrice);

                                $('#txtExtraPriceVal').val(parseFloat(element.DiskonStrata).toFixed(2));

                                txtPriceConst =   Number($('#txtPrice').val().replace(/[^0-9.-]+/g,""));

                            }

                        }

                        
            
                    });


                }

                else {

                    swal("Whops", (data['response']), "error");

                }
            }
            });


        }

        



    });

    $('#txtExtraPrice').blur(function(){

        var txtExtraPriceVal =  parseFloat($('#txtExtraPriceVal').val()).toFixed(2);
        var txtExtraPrice = Number($('#txtExtraPrice').val().replace(/[^0-9.-]+/g,""));

        // alert(txtExtraPriceVal+", "+txtExtraPrice)

        if (txtExtraPrice > txtExtraPriceVal) {

            swal("Whops", "Sorry, Extra Price cant be more than Srata Price ("+txtExtraPriceVal+")","error")
            $('#txtExtraPrice').val('0');
            $('#txtExtraPrice').focus();
        }

        else {
            
            var txtPrice2 = parseFloat(txtPriceConst + txtExtraPrice).toFixed(2);
            txtPrice2 = roundNumber(txtPrice2, 2)
            $('#txtPrice').val(formatNumber(txtPrice2))
            


        }

        
    });

    $('#txtExtraPrice').on('focus', function() {
        
        var a = $(this)
            .one('mouseup.mouseupSelect', function() {
                a.select();
                return false;
            })
            .one('mousedown', function() {
                // compensate for untriggered 'mouseup' caused by focus via tab
                a.off('mouseup.mouseupSelect');
            })
            .select();
    });

    $('#saveOrderItem').on('click', function() {

        event.preventDefault();
        //header
        var prod_code = $('#txtProduct').val();
        var mill_id = 'SR';
        var cust_id = $('#txtCustID').val();
        var cust_name = $('#txtCustName').val();
        var cust_address = $('#txtAddress').val();
        var phone = $('#txtPhone').val();

        var e = document.getElementById("txtConsignee");
        var cons_id = e.options[e.selectedIndex].value;
        var ship_to = e.options[e.selectedIndex].text;

        var f = document.getElementById("txtShipTerm");
        var deliv_mode = f.options[f.selectedIndex].value;

        var salesman_id = $('#txtSalesman').val();
        var remark1 = $('#txtRemark').val();
        var remark2 = $('#txtAddRemark').val();
        var pay_term_id = $('#txtPayment').val();
        var proj_flag = $('#txtProjectFlag').val();
        var cust_po_num = $('#txtCustPoNumber').val();
        
        //item_attribute
        var weight = $('#txtWeight').val();
        var unit_price = Number($('#txtPrice').val().replace(/[^0-9.-]+/g,"")).toFixed(2);
        var extra_price = Number($('#txtExtraPrice').val().replace(/[^0-9.-]+/g,"")).toFixed(2);
        var atr_remark = $('#txtItemRemark').val();
        var appl_note = $('#txtApplNote').val();
        var req_date = $('#txtReqDate').val();
        var req_week = $('#txtReqWeek').val();
        var req_month = $('#txtReqMonth').val();
        var req_year = $('#txtReqYear').val();

        // var amt_gross = $('#amt_gross').val();
        // var amt_disc = $('#amt_disc').val();
        // var pct_disc = $('#pct_disc').val();
        // var amt_net = $('#amt_net').val();

        var amt_gross = '';
        var amt_disc =  '';
        var pct_disc = '';
        var amt_net =  '';
        
        
        //function saveOrderItem
        function saveOrderItem(){

            $.ajax({
                type: "POST",
                url: "{{ url('saveEditOrderItem') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'prod_code': prod_code,
                    'mill_id': mill_id,
                    'book_id': setBookId,
                    'cust_id': cust_id,
                    'deliv_mode' : deliv_mode,
                    'cust_name': cust_name,
                    'cust_address': cust_address,
                    'phone': phone,
                    'cons_id': cons_id,
                    'ship_to': ship_to,
                    'salesman_id': salesman_id,
                    'remark1': remark1,
                    'remark2': remark2,
                    'pay_term_id': pay_term_id,
                    'proj_flag': proj_flag,
                    'cust_po_num': cust_po_num,
                    'weight': weight,
                    'unit_price': unit_price,
                    'extra_price': extra_price,
                    'amt_gross': amt_gross,
                    'amt_disc': amt_disc,
                    'pct_disc': pct_disc,
                    'amt_net': amt_net,
                    'atr_remark': atr_remark,
                    'appl_note': appl_note,
                    'req_date': req_date,
                    'req_week': req_week,
                    'req_month': req_month,
                    'req_year': req_year
                },
                success: function(data) {
                    if ((data['response']) == 'Item Added') {
                        //$('#setBookId').val((data['invoiceNo']));
                        swal("Success", (data['response']), "success");
                        //$('#hdrInvoiceNo').text((data['invoiceNo']));
                        // divInvoiceNo.style.display = "block";
                        listOrderItem();
                        // searchForm.style.display = "none";
                        // setEmpty();
                        // setBadgeNotReady();
                        // document.getElementById("confirmLater").disabled = false;
                        // document.getElementById("toStep3").disabled = false;
                    } else {
                        swal("Error", (data['response']), "error");
                        // searchForm.style.display = "none";
                        // setEmpty();
                        // setBadgeNotReady();
                    }
                }
            });
        }

        if(!prod_code && !atr_remark){
            swal('Whoops', 'If you not choose any product, at least describe your order at remark field', 'error');
        }

        else {

            if (unit_price && prod_code){
                if (unit_price < cek_bottom_price){
                    swal("Whoops", "Price cannot be under bottom price", "error");
                    $('#txtPrice').val('');
                    // $('#amt_gross').val('');
                    // $('#amt_gross').val('');
                    // $('#pct_disc').val('');
                    // $('#amt_disc').val('');
                    // $('#amt_net').val('');
                    $('#txtPrice').focus();
                }
                else{
                    saveOrderItem();
                }

            }
            else if (unit_price && atr_remark){
                saveOrderItem();
            }
            else if (!unit_price && atr_remark){
                saveOrderItem();
            }
            else if (!unit_price && prod_code){
                saveOrderItem();
            }
        }

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
            'url': '{!!url("getItemDetail")!!}' + '?id=' +setBookId,
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
            },
            {
                data: 'Action',
                name: 'Action',
                orderable:false,
                searchable:false,
                sClass: "center"
            }
        ],
        initComplete: function(settings, json) {

            if (table.rows().data().length) {

                TableOrderContainer.style.display = "block";
                InfoContainer.style.display = "none";
                // infoItem.style.display = "none";

            } else if (!table.rows().data().length) {

                TableOrderContainer.style.display = "none";
                InfoContainer.style.display = "block";
                // infoItem.style.display = "block";
                
            } else {

                swal("Whops!", "Something error", "error");
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

    $('body').on('click', '.deleteItem', function(e) {
      
      e.preventDefault();
      var book_id = $(this).data('id1');
      var item_num = $(this).data('id2');

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
            }).then(function(result) {
                
                if (result.value) {
                    
                    $.ajax({
                    type: "POST",
                    url: "{{ url('deleteOrderItem') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'book_id': book_id,
                        'item_num': item_num
                        },
                            success: function(data) {
                                if ((data['response']) == 'Item Deleted') {
                                    swal("Success", (data['response']), "success");
                                    listOrderItem();
                                }
                                else if ((data['response']) == 'All item has been deleted, order canceled'){
                                    swal("Info", (data['response']), "info")
                                    .then(function(){
                                        $(location).attr("href", "{{ url('CreateOrder') }}");
                                    }
                                    );
                                }
                                else {
                                    swal("Error", (data['response']), "error");
                                }
                            }
                        });

                }
            });
    });

    @if(Session::get('GROUPID') == 'SALES')

        txtGroup = '{{ Session::get('GROUPID') }}';
        txtSalesid = '{{ Session::get('SALESID') }}';

        listCustomer(txtGroup, txtSalesid, txtCustID);
        listConsignee(ConsigneeID);
        listSalesman(txtGroup, txtSalesid, txtCustID);

        // UnitPrice.style.display = "block";
        //  AmtGross.style.display = "block";
        ApplNote.style.display = "block";
        

    @endif

    @if(Session::get('GROUPID') == 'CUSTOMER')

        txtGroup = '{{ Session::get('GROUPID') }}';
        txtCustID = '{{ Session::get('CUSTID') }}';
        
        
        listCustomer(txtGroup, txtSalesid, txtCustID);
        listConsignee(txtCustID);
        listSalesman(txtGroup, txtSalesid, txtCustID);

        // UnitPrice.style.display = "block";
        //  AmtGross.style.display = "none";
        ApplNote.style.display = "none";
        
    @endif

    @if(Session::get('GROUPID') == 'DEVELOPMENT' || Session::get('GROUPID') == 'MARKETING MANAGEMENT' )

        txtGroup = '{{ Session::get('GROUPID') }}';

        searchCustomer();
        listConsignee(ConsigneeID);
        listSalesman(txtGroup, txtSalesid, txtCustID);

        // UnitPrice.style.display = "block";
        // AmtGross.style.display = "block";
        ApplNote.style.display = "block";

    @endif

   






});


</script>

@endsection
{{-- Content Page JS End--}}

