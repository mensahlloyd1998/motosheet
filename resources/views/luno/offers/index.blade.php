@extends('layouts.luno_layout')

@section('page_title')
   Offers
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Offers</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <div class="col-auto cstm-page-info">
      <h1 class=" mt-1 mb-0">Offers</h1>
      <p class="text-muted">Manage your vehicle listings, track offers and controller visibility.</p>
    </div>
@endsection

@section('content')


    @if(auth()->user()->phone == null)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning mb-2">
                    <span class="cstm-fs-14">Provide contact details to be included on posters/labels</span>
                </div>

            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success mb-2">
                    <span class="cstm-fs-14">{{  session('success') }}</span>
                </div>

            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger mb-2">
                    <span class="cstm-fs-14">{{  session('error') }}</span>
                </div>

            </div>
        </div>
    @endif

    <div class="row mt-2">

        <div class="col-12">
            <div class="card p-0 mb-4">
                <form action="#" method="GET" class="mb-0">
                    @csrf
                    <div class="input-group">

                        <input type="text" name="search" value="{{ $_GET['search'] ?? '' }}" class="form-control fw-light fs-14 cstm-fs-14" placeholder="Search Vehicles">

                        <button class="btn btn-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('offers.index') }}" class="btn btn-dark">
                            <i class="bi bi-arrow-repeat"></i>
                        </a>
                        
                        <!-- <a href="#" data-bs-target="#create-modal" data-bs-toggle="modal" class="btn btn-primary">
                            Add Vehicle
                        </a> -->
                            
                    </div>
                </form>
            </div>
        </div>


    </div>

    <div class="row g-2">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table align-middle table-bordered mb-0 custom-table-2">
                    <thead>
                        <tr class="py-3">
                            <th class="fw-light text-dark">vehicle</th>
                            <th class="fw-light text-dark">buyer</th>
                            <th class="fw-light text-dark">offer</th>
                            <th class="fw-light text-dark">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offers as $data)
                        <tr>
                            @php
                                $imagePath = optional($data->car->images->first())->image_path
                                    ?? 'system_img/user_placeholder.jpg';
                            @endphp
                            <td>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="border border-dashed me-2 rounded"
                                        style="
                                            height:50px;
                                            width:50px;
                                            background-image:url('{{ asset('storage/'.$imagePath) }}');
                                            background-size:cover;
                                            background-position:center;
                                            background-repeat:no-repeat;
                                        ">
                                    </div>
                                    <div>
                                        <span class="fw-normal"><a href="{{ route('cars.public.show', ['car'=> $data->car->slug]) }}" target="_blank" class="table-row-title">{{$data->car->title}}</a></span><br>
                                        <small class="text-muted">
                                            Exterior Color : {{ $data->car->exterior_color ?? '---'}}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-capitalize">{{ $data->name }}</span><br>
                                <small class="text-muted">{{ $data->phone }}</small>
                            </td>
                            <td>
                                <span class="text-capitalize">{{ $data->offer_price }}</span><br>
                                <small class="text-muted"></small>
                            </td>
                            <td>
                                <a href="#" class="btn btn-link  btn-md text-primary ">
                                    <i class="bi bi-pencil-square fs-6"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($offers->count() < 1)
            <div class="col-12">
                <div class="card py-3">
                    <p class="text-center mb-0">
                        0 Offers Found
                    </p>
                </div>
                
            </div>
        @endif
    </div>
@endsection

