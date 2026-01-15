<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="All-in-one sales management application">
  <meta name="keyword" content="POS, Sales, Small Business, Shopify, Dropshipping">
  <link rel="icon" href="{{ asset('/img/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
  <title>{{ env('APP_NAME') }} | Login</title>
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
    <!-- Sign In version 1 -->
    <!-- start: page body -->
    <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <div class="row g-3 justify-content-center">
          
          <div class="col-lg-6 d-flex justify-content-center align-items-center">
            <div>


              <div class="d-flex justify-content-center align-items-center mb-4">
                <img src="{{asset('system_img/motosheet-logo.png')}}" class="" style="filter: saturate(1);" width="220px"/>
              </div>
              <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
                <!-- Form -->
                <form class="row g-3" method="post" action="{{ route('login') }}"autocomplete="off">
                  @csrf
                  <div class="col-12 mb-2">
                    <!-- <h1 class="h2">Welcome</h1>
                    <p class="fw-light mb-0">Enter your email and password to login</p> -->
                    <p class="text-uppercase fw-light fs-14 auth-form-header">sign into you account</p>
                  </div>

                  <div class="col-12">
                      <div class="form-floating mb-0">
                          <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                          <label for="subject" class="fs-7 fw-light">Email Address</label>
                      </div>
                      @error('email') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                  </div>

                  <div class="col-12">
                      <div class="form-floating mb-0">
                          <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                          <label for="password" class="fs-7 fw-light">Password</label>
                      </div>
                      @error('password') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                  </div>

                  <!-- <div class="block mt-4">
                      <label for="remember_me" class="inline-flex items-center">
                          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                          <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                      </label>
                  </div> -->

                  <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-lg w-100 btn-block btn-dark  text-uppercase">login</button>
                  </div>
                  <div class="col-12 mt-4">
                    <span class="text-muted fw-light ">Don't have an account? <a href="{{ route('register') }}">Register here</a></span>
                  </div>
                </form>
                <!-- End Form -->
              </div>

            </div>


          </div>
        </div> <!-- End Row -->
      </div>
    </div>
  </div>
  
  <!-- Jquery Page Js -->
  <script src="./assets/js/theme.js"></script>
</body>

</html>