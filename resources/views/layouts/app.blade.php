<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ url('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <!--Jquery Datatables-->
    <link rel="stylesheet" href="{{ url('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
    <!--Alertify-->
    <link rel="stylesheet" href="{{ url('assets/vendor/alertify/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/alertify/css/themes/default.css') }}">
    <!--Datepicker-->
    <link rel="stylesheet" href="{{ url('assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}">
    <!--Select2-->
    <link rel="stylesheet" href="{{ url('assets/vendor/select2/css/select2.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('css/my-style.css') }}">
    @yield('additional_styles')

    <title>@yield('page_title')</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('layouts.partials.navbar')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        @include('layouts.partials.sidebar')
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                @include('layouts.partials.pageheader')
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <!--Flash Session message-->
                <div class="row">
                  <div class="col-md-12">
                    @if(Session::has('successMessage'))
                      <div class="alert alert-success alert-dismissible" role="alert" id="alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Success...!</strong> <span id="success-info"> {{ Session::get('successMessage') }}</span>
                      </div>
                    @endif
                    @if(Session::has('errorMessage'))
                      <div class="alert alert-danger alert-dismissible" role="alert" id="alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Error...!</strong> <span id="danger-info"> {{ Session::get('errorMessage') }}</span>
                      </div>
                    @endif
                    @if(Session::has('warningMessage'))
                      <div class="alert alert-warning alert-dismissible" role="alert" id="alert-warning">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Warning...!</strong> <span id="warning-info"> {{ Session::get('warningMessage') }}</span>
                      </div>
                    @endif
                  </div>
                </div>
              <!--//Flash Session message-->
                @yield('content')
                
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('layouts.partials.footer')
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{ url('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ url('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- main js -->
    <script src="{{ url('assets/libs/js/main-js.js') }}"></script>
    <!-- chart chartist js -->
    <script src="{{ url('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <!-- sparkline js -->
    <script src="{{ url('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <!-- morris js -->
    <script src="{{ url('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ url('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <!-- chart c3 js -->
    <script src="{{ url('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ url('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <script src="{{ url('assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
    <script src="{{ url('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>

    <!--Alertify-->
    <script src="{{ url('assets/vendor/alertify/alertify.js') }}"></script>
    <!--Select2-->
    <script src="{{ url('assets/vendor/select2/js/select2.min.js') }}"></script>
    <!--Datepicker-->
    <script src="{{ url('assets/vendor/datepicker/moment.js') }}"></script>
    <script src="{{ url('assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/esbu.js') }}"></script>
    @yield('additional_scripts')
</body>
 
</html>