@extends('layouts.luno_layout')

@section('page_title')
   Poster Settings
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Poster Configuration</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <div class="col-auto cstm-page-info">
        <h1 class="mt-1 mb-0">Poster Configuration</h1>
        <p class="text-muted">Customize the look and details of your “for sale” signage.</p>

    </div>
@endsection


@section('content')

    @if(auth()->user()->poster_contact_1 == null)
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

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div id="list-item-1" class="card fieldset ">
                <!-- form: profile details ** border border-muted mt-0 **-->
                <span class="fieldset-tile text-muted bg-body">Poster Design:</span>
                <div class="card">
                    <div class="card-body">
                        <form id="profile-update-form" method="post" action="{{ route('profile.updatePoster') }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Poster Design *</label>
                                <div class="col-md-9 col-sm-4">
                                    <select name="poster_design" class="form-control form-control-lg" id="">
                                        <option value="basic">Basic</option>
                                    </select>
                                    @error('poster_design') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Contact Phone 1 *</label>
                                <div class="col-md-9 col-sm-8">
                                    <input type="text" class="form-control form-control-lg" name="phone" placeholder="+233 26 331 9480" value="{{ old('phone') ?? auth()->user()->poster_contact_1 }}">
                                    @error('phone') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Contact Phone 2</label>
                                <div class="col-md-9 col-sm-8">
                                    <input type="text" class="form-control form-control-lg" name="alternative_phone" placeholder="+233 26 331 9480" value="{{ old('alternative_phone') ?? auth()->user()->poster_contact_2  }}">
                                    @error('alternative_phone') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-light me-2" type="reset">Discard</button>
                        <button class="btn btn-primary" onclick="document.getElementById('profile-update-form').submit();" type="submit"><i class="bi bi-floppy2-fill me-2"></i> Save Changes</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('modals')

@endsection

@section('scripts')

@endsection