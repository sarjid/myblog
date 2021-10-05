<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend/vendors') }}/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('header')
</head>

<body>


    <!-- Left Panel -->
    @include('layouts.backend.partials.sidebar')

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('layouts.backend.partials.header')
        <!-- Header-->

        @yield('content')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    @include('layouts.backend.partials.footer')

</body>

</html>
