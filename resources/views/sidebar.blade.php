<div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>

                {{-- <div class="profile-info">
                    <div class="user-info">
                        <img src="{{ asset('outside/assets/img/kindpng_1055656.png') }}" alt="avatar">
                        <h6 class="">
                            {{ Session::get('NAME1') }}
                            {{ Session::get('NAME2') }}
                            {{ Session::get('NAME3') }}
                        </h6>

                        @if(!Session::get('GROUPID'))
                        <p class="">
                            N/A
                        </p>
                        @else
                        <p class="">
                            {{ Session::get('GROUPID') }}
                        </p>
                        @endif
                    </div>
                </div> --}}


                <ul class="list-unstyled menu-categories ps">
                    <li class="menu">
                        <a href="javascript:void(0);" id="homeNav" data-active="true" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle" onclick="window.location.href='{{ url("home") }}'">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Home</span>
                            </div>
                            <div>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> --}}
                            </div>
                        </a>
                        {{-- <ul class="submenu list-unstyled collapse show" id="starter-kit" data-parent="#accordionExample" style="">
                            <li>
                                <a href="starter_kit_blank_page.html"> Blank Page </a>
                            </li>
                            <li class="active">
                                <a href="starter_kit_breadcrumbs.html"> Breadcrumbs </a>
                            </li>
                            <li>
                                <a href="starter_kit_boxed.html"> Boxed </a>
                            </li>
                            <li>
                                <a href="starter_kit_alt_menu.html"> Alternate Menu </a>
                            </li>
                        </ul> --}}
                    </li>

                    <li class="menu" id="CustOrder">
                        <a href="#submenu3" data-toggle="collapse" class="dropdown-toggle" id="CustOrderNav">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                <span>Customer Order</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="CustOrderTreeView collapse submenu list-unstyled" id="submenu3" data-parent="#submenu3">
                            @if(session()->has('mnuCustReg'))
                            <li id='CustReg'>
                                <a href="{{ url('CustReg') }}">Customer Registration</a>
                            </li>
                            @endif
                            @if(session()->has('mnuRegisteredCust'))
                            <li id='RegisteredCust'>
                                <a href="{{ url('RegisteredCust') }}">Registered Customer</a>
                            </li>
                            @endif
                            @if(session()->has('mnuCreateOrder'))
                            <li id='CreateOrder'>
                                <a href="{{ url('CreateOrder') }}">Create Order</a>
                            </li>
                            @endif
                            @if(session()->has('mnuListOrder'))
                            <li id='ListOrder'>
                                <a href="{{ url('ListOrder') }}">List Order</a>
                            </li>
                            @endif
                            @if(session()->has('mnuOutstandingDeliv'))
                            <li id='OutstandingDeliv'>
                                <a href="{{ url('OutstandingDeliv') }}">Outstanding Delivery</a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="menu" id="UserMgmt">
                        <a href="#submenu2" data-toggle="collapse" class="dropdown-toggle" id="UserMgmtNav">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>User Management</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="UserMgmtTreeView collapse submenu list-unstyled" id="submenu2" data-parent="#submenu2">
                            @if(session()->has('mnuMyAccount'))
                            <li id='MyAccount'>
                                <a href="{{ url('MyAccount') }}">My Account</a>
                            </li>
                            @endif
                            @if(session()->has('mnuChangePass'))
                            <li id='ChangePass'>
                                <a href="{{ url('ChangePass') }}">Change Password</a>
                            </li>
                            @endif
                            @if(session()->has('mnuAddUser'))
                            <li id='AddUser'>
                                <a href="{{ url('AddUser') }}">Add User</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>

            </nav>

        </div>
