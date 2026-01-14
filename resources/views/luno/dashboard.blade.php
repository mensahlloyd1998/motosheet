@extends('layouts.luno_layout')

@section('page_title')
   Dashboard
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
   <div class="col">
      <ol class="breadcrumb bg-transparent mb-0">
         <!-- <li class="breadcrumb-item"><a class="text-secondary" href="/">Home</a></li> -->
         <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
   </div>
   @endif
@endsection

@section('page_details')
   <div class="col-auto cstm-page-info">
      <h1 class="mt-1 mb-0">Dashboard</h1>
      <p class="text-muted">
         A quick overview of your vehicle listings, visibility, and activity on Motosheet.
      </p>
   </div>
@endsection


@section('content')
   <div class="row g-3">
      <div class="col-lg-3 col-md-3">
         <div class="card overflow-hidden">
               <div class="card-body">
                  <svg class="position-absolute bi bi-box2-heart-fill top-0 end-0 mt-4 me-3"  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                     <path class="text-primary" d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM8.5 4h6l.5.667V5H1v-.333L1.5 4h6V1h1zM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                  </svg>
                  <div class="mb-2 ">Total Vehicles</div>
                  <div><span class="h4">{{ auth()->user()->cars()->count() }}</span></div>
                  <small class="text-muted">Vehicles you've added to motosheet</small>
               </div>
         </div>
      </div>

      <div class="col-lg-3 col-md-3">
         <div class="card overflow-hidden">
               <div class="card-body">
                  <!-- <svg class="position-absolute bi bi-eye-fill top-0 end-0 mt-4 me-3"  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                     <path class="text-primary" d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM8.5 4h6l.5.667V5H1v-.333L1.5 4h6V1h1zM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                  </svg> -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="position-absolute top-0 end-0 mt-4 me-3 bi bi-file-earmark-fill" viewBox="0 0 16 16">
                     <path class="text-primary"  d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z"/>
                  </svg>
                  <div class="mb-2 ">Total Page Views</div>
                  <div><span class="h4">{{ $totalViews }}</span></div>
                  <small class="text-muted">Views across your vehicles pages</small>
               </div>
         </div>
      </div>


      <div class="col-lg-3 col-md-3">
         <div class="card overflow-hidden">
               <div class="card-body">
                  <!-- <svg class="position-absolute bi bi-box2-heart-fill top-0 end-0 mt-4 me-3"  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                     <path class="text-primary" d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM8.5 4h6l.5.667V5H1v-.333L1.5 4h6V1h1zM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                  </svg> -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="position-absolute top-0 end-0 mt-4 me-3 bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                  <path class="text-primary"  d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                  </svg>
                  <div class="mb-2 ">Active Pages</div>
                  <div><span class="h4">{{ $activePages }}</span></div>
                  <small class="text-muted">{{ auth()->user()->cars()->count() - $activePages }} not publicly accessible pages</small>
               </div>
         </div>
      </div>

      <div class="col-lg-3 col-md-3">
         <div class="card overflow-hidden">
               <div class="card-body">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="position-absolute top-0 end-0 mt-4 me-3 bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                  <path class="text-primary"  d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                  </svg> -->

                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="position-absolute top-0 end-0 mt-4 me-3 bi bi-cash-coin" viewBox="0 0 16 16">
                  <path class="text-primary" fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                  <path class="text-primary" d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                  <path class="text-primary" d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                  <path class="text-primary" d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                  </svg>

                  <div class="mb-2 ">Total Offers</div>
                  <div><span class="h4">{{ $totalOffers }}</span></div>
                  <small class="text-muted">Buyer offers recieved on your listings</small>
               </div>
         </div>
      </div>
   </div>
@endsection