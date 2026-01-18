@extends('layouts.auth')


@section('title')

<title>{{ env('APP_NAME') ?? 'SET_APP_NAME'}} | Register </title>

@endsection

@section('form-card')

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

@endsection