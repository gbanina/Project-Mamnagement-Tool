<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TeamBiosis</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::to('assets/fav/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::to('assets/fav/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::to('assets/fav/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::to('assets/fav/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::to('assets/fav/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::to('assets/fav/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::to('assets/fav/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::to('assets/fav/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to('assets/fav/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ URL::to('assets/fav/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to('assets/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::to('assets/fav/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/fav/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ URL::to('assets/fav/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#2A3F54">
    <meta name="msapplication-TileImage" content="{{ URL::to('assets/fav/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#2A3F54">

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
            @if(Auth::user()->currentRole == 'MORPH')
            <div class="row">
                <div class="alert alert-danger fade in" role="alert">
                    You are currently assimilated role of {{Auth::user()->userAccount()->role()->first()->name}}. Click <a href="{{ URL::to('morph-return') }}">here</a> to return to your original role.
                </div>
            </div>
            @endif
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
