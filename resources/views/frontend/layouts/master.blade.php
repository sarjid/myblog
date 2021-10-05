<!DOCTYPE html>
<html lang="zxx" class="no-js">
  <head>
    <!-- Mobile Specific Meta -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Favicon-->
    <link rel="shortcut icon" href=" {{ asset('frontend/img') }}/fav.png" />
    <!-- Author Meta -->
    <meta name="author" content="colorlib" />
    <!-- Meta Description -->
    <meta name="description" content="" />
    <!-- Meta Keyword -->
    <meta name="keywords" content="" />
    <!-- meta character set -->
    <meta charset="UTF-8" />
    <!-- Site Title -->
    <title>Blogger</title>

    <link
      href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700"
      rel="stylesheet"
    />
    <!--CSS============================================= -->
    <link rel="stylesheet" href=" {{ asset('frontend/css') }}/linearicons.css" />
    <link rel="stylesheet" href=" {{ asset('frontend/css') }}/font-awesome.min.css" />
    <link rel="stylesheet" href=" {{ asset('frontend/css') }}/bootstrap.css" />
    <link rel="stylesheet" href=" {{ asset('frontend/css') }}/owl.carousel.css" />
    <link rel="stylesheet" href=" {{ asset('frontend/css') }}/main.css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <style>
      .menu1{
        /* border: 1px solid #333; */
        margin-left: -5rem;

      }

      .c1{
        color: #007bff;
      }
    </style>
  </head>
  <body>

    @include('frontend.layouts.partials.header')
    {{-- --------- main content -----  --}}
        @yield('content')
    {{-- ---------- end maincontent --------  --}}

    @include('frontend.layouts.partials.footer')

    @include('frontend.layouts.partials.scripts')

  </body>
</html>
