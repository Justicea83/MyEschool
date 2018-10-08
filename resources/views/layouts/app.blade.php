<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/chosen.min.css')}}">
    <link href="{{asset('/assets/css/chartist.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('/assets/css/owl.carousel.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('/assets/css/owl.theme.default.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('/assets/css/newStyle.css')}}" rel="stylesheet" media="screen">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="{{asset('/assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" media="screen">

    @stack('css')
    <style>
        .sidebar-nav{
            margin-bottom: 45px;
        }
    </style>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="{{asset('js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/plugins/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/plugins/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/js.js')}}"></script>

@stack('js')
</body>
</html>
