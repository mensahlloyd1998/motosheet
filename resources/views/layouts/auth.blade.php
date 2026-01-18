<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="All-in-one sales management application">
  <meta name="keyword" content="POS, Sales, Small Business, Shopify, Dropshipping">
  <link rel="icon" href="{{ asset('/img/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
  @yield('title')
  <!-- project css file  -->
  <link rel="stylesheet" href="{{ asset('css/luno-style.css') }}">
  <style>
    body{
      font-family: 'Inter', sans-serif;
      font-weight: 300;
    }
    .auth-form-header{
      font-size: .875rem;
      letter-spacing: 2px;
      text-align:center;
    }
  </style>
  <!-- Jquery Core Js -->
  <script src="{{ asset('js/plugins.js') }}"></script>

</head>

<body id="layout-1" data-luno="theme-blue">
    <!-- start: body area -->
    <div class="wrapper">

        <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">

                        <div>
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <img src="{{asset('system_img/motosheet-logo.png')}}" class="" style="filter: saturate(1);" width="220px"/>
                            </div>

                            @yield('form-card')
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
  
    <!-- Jquery Page Js -->
    <script src="./assets/js/theme.js"></script>
</body>

</html>