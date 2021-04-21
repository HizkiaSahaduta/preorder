@extends('main')

{{-- Content Page CSS Begin--}}
@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/plugins/magnific-popup/magnific-popup.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<style>
hr.style {
  border-top: 1px dashed #888ea8;
}

.badge {
  background: transparent; }

.badge-danger {
  color: #e7515a;
  border: 1px dashed #e7515a; }

.btn-block {
    width: 50%;
}

.img-fluid {
    max-width: 50%;
    height: auto;
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
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Upload Image</a></li>
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
                            <br>   
                            <a href="{{ url('ListOrder') }}" class="btn btn-dark" style="margin-left: 15px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                Back to List Order
                            </a>
                        </div>
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Image of {{ Session::get('book_id_temp') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content-area">

                    <h6>Uploaded Photos</h6>
                    <div class="masonry-gallery-wrapper">
                        <div class="popup-gallery">
                            <div class="gallery-sizer"></div>
                            <div id="uploaded_image"></div>
                        </div>
                    </div>
                    
                    @if($userid == $checkCreatedBy)
                    <hr class="style">
                    <h6>Upload Order Photos</h6>

                    <div class="form-row mb-6">
                        <div class="form-group col-md-12 col-12">
                            <form id="dropzoneForm" class="dropzone" action="{{ url('ImgUpload') }}">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <div class="form-row mb-6">
                        <div class="form-group col-md-12 col-12">
                            <button class="btn btn-primary" style="float: left" id="submit-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
                                Upload
                            </button>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>





@endsection
{{-- Content Page End--}}

{{-- Content Page JS Begin--}}
@section('contentjs')

@if(\Session::has('success'))
<script>
    var msg = "{{ Session::get('success') }}"
    swal("Success", msg, "success");
</script>
@endif

@if(\Session::has('alert'))
  <script>
      var error = "{{ Session::get('alert') }}"
      swal("Error", error, "error");

  </script>
@endif

<script src="{{ asset('outside/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script>
$(function () {
    $(".popup-gallery").magnificPopup({
        delegate: "a",
        type: "image",
        closeOnContentClick: !0,
        fixedContentPos: !0,
        tLoading: "Loading image #%curr%...",
        mainClass: "mfp-img-mobile mfp-no-margins mfp-with-zoom",
        gallery: { enabled: !0, navigateByImgClick: !0, preload: [0, 1] },
        image: {
            verticalFit: !0,
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function (e) {
                return e.el.attr("title") + "<small>SunriseWeb - Cust.Order</small>";
            },
            zoom: { enabled: !0, duration: 300 },
        },
    });
});

Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    acceptedFiles : ".jpg,.jpeg",
    addRemoveLinks: true,
    "error": function(file, message, xhr) {
       if (xhr == null) this.removeFile(file); // perhaps not remove on xhr errors
       swal("Whops", message+" (.jpg, .jpeg only)", "error");
    },
    init:function(){
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;

      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });

      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
        }
        load_images();
      });

    }

  };

  load_images();

  function load_images()
  {
    $.ajax({
      url:"{{ url('ImgFetch') }}",
      success:function(data)
      {
        $('#uploaded_image').html(data);
      }
    })
  }

$(document).ready(function() {

  $('body').on('click', '.remove_image', function(){
    var name = $(this).attr('id');

    swal({
        title: 'Are you sure?',
        text: "Delete image "+name+" ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        padding: '2em'
        }).then(function(result) {
            
            if (result.value) {
                
                $.ajax({
                    url:"{{ url('ImgDelete') }}",
                    data:{name : name},
                    success:function(data){
                        if ((data['response']) == "Image deleted") {
                            swal("Success", (data['response']), "success");
                            load_images();
                        }
                        else {
                            swal("Error", "Something error", "error");
                            load_images();
                        }
                    }
                })

            }
        });

  });



});


</script>

@endsection
{{-- Content Page JS End--}}
