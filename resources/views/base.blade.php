<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TeamBiosis</title>

    <!-- Bootstrap -->
    <link href="{{ URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::to('css/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::to('css/green.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::to('css/custom.min.css')}}" rel="stylesheet">

    <!-- Custom Tweeks -->
    <link href="{{ URL::to('css/admin.css')}}" rel="stylesheet">

        <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::to('js/bootstrap.min.js')}}"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            @include('main-nav')
            @include('top-nav')
          </div>

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Project Management Tool by <a href="https://google.com">OurAwsomeCompany</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <!-- Bootstrap Progress Bar-->
    <script src="{{ URL::to('js/bootstrap-progressbar.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ URL::to('js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ URL::to('js/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ URL::to('js/icheck.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::to('js/custom.min.js')}}"></script>

    @yield('js_include')

  </body>
</html>
