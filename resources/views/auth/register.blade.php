<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="All-in-one sales management application">
  <meta name="keyword" content="POS, Sales, Small Business, Shopify, Dropshipping">
  <link rel="icon" href="{{ asset('/img/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
  <title>{{ env('APP_NAME') }} | Register</title>
  <!-- project css file  -->
  <link rel="stylesheet" href="{{ asset('css/luno-style.css') }}">
  <!-- Jquery Core Js -->
  <script src="{{ asset('js/plugins.js') }}"></script>
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

            <div class="">
              <div class="d-flex justify-content-center align-items-center mb-4">
                <img src="{{asset('system_img/motosheet-logo.png')}}" class="" style="filter: saturate(1);" width="220px"/>
              </div>
            <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
              <!-- Form -->
              <form class="row g-3" method="post" action="{{ route('register') }}"autocomplete="off">
                @csrf
                <div class="col-12 mb-2">
                    <!-- <h1 class="h2">Welcome</h1>
                    <p class="fw-light mb-0">Enter your email and password to login</p> -->
                    <p class="text-uppercase fw-light fs-14 auth-form-header">create an  account</p>
                  </div>

                <div class="col-12">
                    <div class="form-floating mb-0">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        <label for="" class="fs-7 fw-light">Full Name</label>
                    </div>
                    @error('name')
                    <p class="text-danger mb-0">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-12">
                    <div class="form-floating mb-0">
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        <label for="" class="fs-7 fw-light">Email Address</label>
                    </div>
                    @error('email')
                    <p class="text-danger mb-0">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="form-floating mb-0">
                        <input type="password" class="form-control" id="password" name="password" value="" required>
                        <label for="" class="fs-7 fw-light">Password</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating mb-0">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" required>
                        <label for="" class="fs-7 fw-light">Confirm Password</label>
                    </div>
                </div>

                <!-- <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label fw-light" for="flexCheckDefault"> I accept the <a href="#" title="" class="text-primary">Terms and Conditions</a>
                    </label>
                  </div>
                </div> -->
                <div class="col-12 text-center mt-4">
                  <button type="submit" class="btn btn-lg w-100 btn-block btn-dark  text-uppercase">Register</button>
                </div>
                <div class="col-12 mt-4">
                  <span class="text-muted fw-light ">Already have an account? <a href="{{ route('login') }}">Login here</a></span>
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
  <script src="{{ route('assets/js/theme.js') }}"></script>
</body>

</html>