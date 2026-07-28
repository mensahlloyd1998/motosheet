@extends('layouts.luno_layout')

@section('page_title')
   Vehicles
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('cars.index') }}">Vehicles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Vehicle</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <x-page-details 
        title="add new vehicle"
        description="Enter the details of a vehicle  to generate a clean, shareable page instantly."
    />
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
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="text-danger mb-0">Required fields are denoted by *</p>
            </div>
            <div class="card-body">
                <form class="row g-3" action="{{ route('cars.store') }}" id="create-form" enctype="multipart/form-data" method="post">
                    @csrf
                    <x-form-floating-field

                        name="make"
                        label="Make *"
                        type="text"
                        col="col-md-4"

                    />

                    <x-form-floating-field

                        name="model"
                        label="Model *"
                        type="text"
                        col="col-md-4"

                    />

                    <x-form-floating-field

                        name="year"
                        label="Year *"
                        type="number"
                        col="col-md-4"

                    />

                    <x-form-floating-field

                        name="trim"
                        label="Trim *"
                        type="text"
                        col="col-md-6"

                    />

                    <x-form-floating-field

                        name="color"
                        label="Exterior Color *"
                        type="text"
                        col="col-md-6"

                    />

                    {{-- Specs --}}
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <select name="transmission" id="transmission" class="form-control">
                                <option value="">Select One</option>
                                <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : ''}}>Manual</option>
                                <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : ''}}>Automatic</option>
                            </select>
                            <label for="transmission">Transmission *</label>
                        </div>
                        @error('transmission') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <select name="fuel_type" id="fuel_type" class="form-control">
                                <option value="">Select One</option>
                                <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : ''}}>Petrol</option>
                                <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : ''}}>Diesel</option>
                                <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : ''}}>Hybrid</option>
                                <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : ''}}>Electric</option>
                            </select>
                            <label for="fuel_type">Fuel Type *</label>
                        </div>
                        @error('fuel_type') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                    </div>


                    <x-form-floating-field

                        name="mileage"
                        label="Mileage in miles *"
                        type="number"
                        col="col-md-6"

                    />

                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <select name="condition" id="condition" class="form-control">
                                <option value="">Select One</option>
                                <option value="new"  {{ old('condition') == 'new' ? 'selected' : ''  }}>New</option>
                                <option value="foreign_used"  {{ old('condition') == 'foreign_used' ? 'selected' : ''  }}>Foreign Used</option>
                                <option value="used"  {{ old('condition') == 'used' ? 'selected' : ''  }}>Used</option>
                            </select>
                            <label for="condition">Condition *</label>
                        </div>
                        @error('condition') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                    </div>

                    <x-form-floating-field

                        name="price"
                        label="Price ({{ auth()->user()->country->currency_code }})*"
                        type="number"
                        col="col-md-6"

                    />

                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <select name="is_negotiable" id="is_negotiable" class="form-control">
                                <option value="">Select One</option>
                                <option value="1" {{old('is_negotiable') == '1' ? 'selected' : ''}}>Is Negotiable</option>
                                <option value="0" {{old('is_negotiable') == '0' ? 'selected' : ''}}>Not Negotiable</option>
                            </select>
                            <label for="is_negotiable">Negotiable *</label>
                        </div>
                        @error('is_negotiable') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3 col-md-12">
                        <div class="form-floating">
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            <label for="description">Description *</label>
                        </div>
                        @error('description') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label fw-medium">Vehicle Features</label>
                        {{-- Features --}}
                        <div id="features-wrapper">
                            <div class="input-group mb-2">
                                <input
                                    type="text"
                                    name="features[]"
                                    class="form-control"
                                    placeholder="e.g. Air Conditioning"
                                >
                                <button type="button" class="btn btn-outline-danger remove-feature" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-feature">
                            <i class="bi bi-plus-circle"></i> Add feature
                        </button>

                        <small class="text-muted d-block mt-1">
                            Add each feature separately (e.g. Bluetooth, Reverse Camera).
                        </small>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label fw-medium">
                            Vehicle Images
                        </label>

                        <input type="file"
                            name="images[]"
                            id="images"
                            class="dropify"
                            data-height="140"
                            data-allowed-file-extensions="jpg jpeg png webp"
                            multiple>

                        @error('images') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        @error('images.*') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                    </div>


                </form>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="document.getElementById('create-form').submit()">Save</button>
                <button type="button" class="btn btn-secondary">Cancel</button>
            </div>
            </div>
        </div>


    </div> <!-- .row end -->
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.dropify').dropify();

        const featuresWrapper = document.getElementById('features-wrapper');
        const addFeatureBtn   = document.getElementById('add-feature');

        addFeatureBtn.addEventListener('click', function () {
            const featureRow = document.createElement('div');
            featureRow.classList.add('input-group', 'mb-2');

            featureRow.innerHTML = `
                <input
                    type="text"
                    name="features[]"
                    class="form-control"
                    placeholder="e.g. Bluetooth"
                >
                <button type="button" class="btn btn-outline-danger remove-feature">
                    <i class="bi bi-trash"></i>
                </button>
            `;

            featuresWrapper.appendChild(featureRow);
            updateRemoveButtons();
        });

        featuresWrapper.addEventListener('click', function (e) {
            if (e.target.closest('.remove-feature')) {
                e.target.closest('.input-group').remove();
                updateRemoveButtons();
            }
        });
    });

    function updateRemoveButtons() {
        const buttons = featuresWrapper.querySelectorAll('.remove-feature');
        buttons.forEach(btn => btn.disabled = buttons.length === 1);
    }

    

</script>

@endsection