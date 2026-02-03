@extends('layouts.luno_layout')

@section('page_title')
   Payments
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payments</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <div class="col-auto cstm-page-info">
      <h1 class=" mt-1 mb-0">Payments</h1>
      <p class="text-muted">A complete list of payments made by your customers.</p>
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

                        <input type="text" name="search" value="{{ $_GET['search'] ?? '' }}" class="form-control fw-light fs-14 cstm-fs-14" placeholder="Search offers by vehicle make or model">

                        <button class="btn btn-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('payments.index') }}" class="btn btn-dark">
                            <i class="bi bi-arrow-repeat"></i>
                        </a>
                        
                        <a href="#" data-bs-target="#create-modal" data-bs-toggle="modal" class="btn btn-primary">
                            New Payment
                        </a>
                            
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

                            <th class="fw-bold text-uppercase text-dark">date</th>
                        
                            <th class="fw-bold text-uppercase text-dark">buyer</th>
                            
                            <th class="fw-bold text-uppercase text-dark">amount</th>
                            <th class="fw-bold text-uppercase text-dark">status</th>
                            <th class="fw-bold text-uppercase text-dark">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $data)
                        <tr>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($payments->count() < 1)
            <div class="col-12">
                <div class="card py-3">
                    <p class="text-center mb-0">
                        0 Payment Records Found
                    </p>
                </div>
                
            </div>
        @endif
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="create-modal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title h3 mb-1 fw-medium">
                        Create New Payment Record
                    </h1>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('create-form').submit();">
                        <i class="bi bi-floppy2-fill"></i>
                        Save
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

