<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SunriseWeb</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo/tes2.png') }}">
    <link href="{{ asset('outside/assets/css/loader.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('outside/assets/js/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('outside/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('outside/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('outside/assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('outside/assets/css/elements/breadcrumb.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('outside/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('outside/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('outside/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <style>

        div.dataTables_wrapper div.dataTables_filter input {
            width: 250px !important;
        }
        
        .kka-logo {
                border-radius: 10px;
                background: #fff;
                padding: 5px;

            }

        @media (max-width: 991px) {
            .kka-logo {
                border-radius: 10px;
                background: #fff;
                padding: 5px;
            }
        }
    </style>
    @yield('contentcss')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    {{-- <div id="load"></div> --}}
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR CONTENT -->
    @yield('navbar_content')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
        @yield('content')
        <!--  END CONTENT PART  -->

        <!--  BEGIN FOOTER  -->
        @include('footer')
        </div>
        <!--  END FOOTER PART  -->


    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('outside/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('outside/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('outside/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('outside/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('outside/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('outside/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('outside/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    @yield('contentjs')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>

        $(document).ready(function() {

            $(".CustOrderTreeView").each(function(index){
                if(!$(this).find("li").length){
                    var UserMgmt = document.getElementById('CustOrder');
                    UserMgmt.style.display = 'none';
                }
            });
            
            $(".UserMgmtTreeView").each(function(index){
                if(!$(this).find("li").length){
                    var UserMgmt = document.getElementById('UserMgmt');
                    UserMgmt.style.display = 'none';
                }
            });

        });

    </script>
</body>
</html>
