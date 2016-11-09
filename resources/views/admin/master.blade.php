<!DOCTYPE html>

<html ng-app="ccms">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CCMS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    @yield('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/skins/skin-blue.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/angularPrint.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="{{URL::asset('js/ang.js') }}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{URL::asset('js/ui-bootstrap-custom-tpls-2.1.3.min.js') }}"></script>
    <script src="{{URL::asset('js/angular-confirm.min.js') }}"></script>
    <script src="{{URL::asset('js/angular-datatables.min.js') }}"></script>

    <script src="{{URL::asset('js/sweet-alert.min.js') }}"></script>
    <script src="{{URL::asset('js/SweetAlert.min.js') }}"></script>
    <script src="{{ URL::asset('js/angularPrint.js') }}"></script>
    <script src="{{URL::asset('js/app.js') }}"></script>

    @yield('scripts')

</head>

<body class="hold-transition skin-blue sidebar-mini" controller="masterController">

<div class="wrapper">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small> @yield('desc')</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.partials.footer')
    @include('admin.partials.control-sidebar')


</div>


</body>
</html>
