@extends('layouts.auth')


@section('title')
  <title>{{ env('APP_NAME') }} | Login</title>
@endsection

@section('form-card')
  <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
    <!-- Form -->
    <form class="row g-3" method="post" action="{{ route('login') }}"autocomplete="off">
      @csrf
      <div class="col-12 mb-2">
        <p class="text-uppercase fw-light fs-14 auth-form-header">sign into your account</p>
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


@endsection