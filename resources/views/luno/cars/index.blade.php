@extends('layouts.luno_layout')

@section('page_title')
   Vehicles
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <div class="col-auto cstm-page-info">
      <h1 class=" mt-1 mb-0">Vehicles</h1>
      <p class="text-muted">Manage your vehicle listings, track offers and controller visibility.</p>
    </div>
@endsection

@section('content')


    @if(auth()->user()->phone == null)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning mb-2">
                    <span class="cstm-fs-14">{{  session('success') }}</span>
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
                        <a href="{{ route('cars.index') }}" class="btn btn-dark">
                            <i class="bi bi-arrow-repeat"></i>
                        </a>
                        
                        <a href="#" data-bs-target="#create-modal" data-bs-toggle="modal" class="btn btn-primary">
                            Add Vehicle
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
                            <th class="fw-light text-dark">vehicle</th>
                            <th class="fw-light text-dark">page status</th>
                            <th class="fw-light text-dark">price</th>
                            <th class="fw-light text-dark">metrics</th>
                            <th class="fw-light text-dark">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $data)

                        @php
                            $imagePath = optional($data->images->first())->image_path
                                ?? 'system_img/user_placeholder.jpg';
                        @endphp
                        <tr>
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
                                        <span class="fw-normal"><a href="{{ route('cars.public.show', ['car'=> $data->slug]) }}" class="table-row-title">{{$data->title}}</a></span><br>
                                        <small class="text-muted">
                                            {{ $data->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-capitalize">{{ $data->status}}</span><br>
                                <!-- <small class="text-muted"></small> -->
                            </td>
                            <td>
                                <span>GHS {{ $data->price}}</span><br>
                                <!-- <small class="text-muted">Negotiable</small> -->
                            </td>
                            <td>
                                <span>{{ $data->pageViews()->count() }} views</span><br>
                                <span class="fs-12 cstm-fs-12">{{ $data->inquiries()->count() }} offers</span>
                            </td>
                            <td>
                                @if($data->is_paid == 0)

                                    @if($data->status == 'draft')
                                        <!--Unpaid & Draft (new car page)-->
                                        <a href="#" class="btn btn-link  btn-md text-muted " onclick="activate({{ $data->id }})">
                                            <i class="bi bi-toggle-off fs-4"></i>
                                        </a>
                                    @endif

                                @else

                                    @if($data->status == 'paused')

                                        <!--Paid & Paused (paused by user/seller)-->
                                        <a href="#" class="btn btn-link  btn-md text-muted" title="unpause" onclick="reactivate({{ $data->id }})">
                                            <i class="bi bi-toggle-off fs-4"></i>
                                        </a>

                                    @elseif($data->status == 'active')

                                        <!--Paid & Active (paused by user/seller)-->
                                        <a href="#" class="btn btn-link  btn-md text-success" title="pause" onclick="deactivate({{ $data->id }})">
                                            <i class="bi bi-toggle-on fs-4"></i>
                                        </a>

                                    @endif



                                @endif


                                <a href="{{ route('cars.qr', ['car'=>$data->id]) }}" class="btn btn-link  btn-md text-secondary" title="Download Sale Poster">
                                    <i class=" fs-6 bi bi-image"></i>
                                </a>

                                <a href="#" class="btn btn-link  btn-md text-primary " onclick="show_edit_form({{ $data->id }})">
                                    <i class="bi bi-pencil-square fs-6"></i>
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-link btn-md text-danger"
                                    onclick="deleteCar({{ $data->id }})"
                                    title="delete"
                                >
                                    <i class="bi bi-trash fs-6"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        @if ($cars->count() < 1)
            <div class="col-12">
                <div class="card py-3">
                    <p class="text-center mb-0">
                        No vehicles yet. Add your first vehicle to create a Motosheet page.
                    </p>
                </div>
                
            </div>
        @endif
    </div>
@endsection

@section('modals')

    <div class="modal fade" id="create-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content p-3 p-md-4">

                {{-- Header --}}
                <div class="modal-header border-0">
                    <div>
                        <h1 class="modal-title h3 mb-1 fw-medium">
                        Create Vehicle Page
                        </h1>
                        <p class="text-muted mb-0">
                        Enter the vehicle details. Motosheet will generate a clean, shareable page instantly.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Form --}}
                <form class="modal-body pt-0" action="{{ route('cars.store') }}" id="create-form" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="row">

                        {{-- Identity --}}
                        <div class="mb-3 col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="make" name="make" placeholder="Toyota">
                                <label for="make">Make *</label>
                            </div>
                            @error('make') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="model" name="model" placeholder="Corolla">
                                <label for="model">Model *</label>
                            </div>
                            @error('model') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="year" name="year" placeholder="2020">
                                <label for="year">Year *</label>
                            </div>
                            @error('year') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="trim" name="trim" placeholder="SE">
                                <label for="trim">Trim</label>
                            </div>
                            @error('trim') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="color" name="color" placeholder="SE">
                                <label for="color">Exterior Color</label>
                            </div>
                            @error('color') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        {{-- Specs --}}
                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="transmission" id="transmission" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="manual">Manual</option>
                                    <option value="automatic">Automatic</option>
                                </select>
                                <label for="transmission">Transmission *</label>
                            </div>
                            @error('transmission') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="fuel_type" id="fuel_type" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="electric">Electric</option>
                                </select>
                                <label for="fuel_type">Fuel Type *</label>
                            </div>
                            @error('fuel_type') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="mileage" name="mileage" placeholder="Mileage">
                                <label for="mileage">Mileage in miles *</label>
                            </div>
                            @error('mileage') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="condition" id="condition" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="new">New</option>
                                    <option value="foreign_used">Foreign Used</option>
                                    <option value="used">Used</option>
                                </select>
                                <label for="condition">Condition *</label>
                            </div>
                            @error('condition') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        {{-- Pricing --}}
                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="number" step="100" class="form-control" id="price" name="price" placeholder="">
                                <label for="price">Price (GHS) *</label>
                            </div>
                            @error('price') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="is_negotiable" id="is_negotiable" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="1">Is Negotiable</option>
                                    <option value="0">Not Negotiable</option>
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
                        </div>

                    </div>
                </form>

                {{-- Footer --}}
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



    <div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content p-3 p-md-4">

                {{-- Header --}}
                <div class="modal-header border-0">
                    <div>
                        <h1 class="modal-title h3 mb-1 fw-medium">
                            Edit Car Page
                        </h1>
                        <p class="text-muted mb-0">
                        Update details, manage images, and control how this vehicle appears on Motosheet.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Form --}}
                <form class="modal-body pt-0" action="" id="edit-form" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="row">

                        {{-- Identity --}}
                        <div class="mb-3 col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-make" name="make" placeholder="Toyota">
                                <label for="make">Make *</label>
                            </div>
                            @error('make') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-model" name="model" placeholder="Corolla">
                                <label for="model">Model *</label>
                            </div>
                            @error('model') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="edit-year" name="year" placeholder="2020">
                                <label for="year">Year *</label>
                            </div>
                            @error('year') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-trim" name="trim" placeholder="SE">
                                <label for="trim">Trim</label>
                            </div>
                            @error('trim') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-color" name="color" placeholder="SE">
                                <label for="color">Exterior Color</label>
                            </div>
                            @error('color') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        {{-- Specs --}}
                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="transmission" id="edit-transmission" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="manual">Manual</option>
                                    <option value="automatic">Automatic</option>
                                </select>
                                <label for="transmission">Transmission *</label>
                            </div>
                            @error('transmission') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="fuel_type" id="edit-fuel_type" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="electric">Electric</option>
                                </select>
                                <label for="fuel_type">Fuel Type *</label>
                            </div>
                            @error('fuel_type') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="edit-mileage" name="mileage" placeholder="Mileage">
                                <label for="mileage">Mileage in miles *</label>
                            </div>
                            @error('mileage') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="condition" id="edit-condition" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="new">New</option>
                                    <option value="foreign_used">Foreign Used</option>
                                    <option value="used">Used</option>
                                </select>
                                <label for="condition">Condition *</label>
                            </div>
                            @error('condition') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        {{-- Pricing --}}
                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <input type="number" step="100" class="form-control" id="edit-price" name="price" placeholder="">
                                <label for="price">Price (GHS) *</label>
                            </div>
                            @error('price') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="form-floating">
                                <select name="is_negotiable" id="edit-is_negotiable" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="1">Is Negotiable</option>
                                    <option value="0">Not Negotiable</option>
                                </select>
                                <label for="is_negotiable">Negotiable *</label>
                            </div>
                            @error('is_negotiable') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3 col-md-12">
                            <div class="form-floating">
                                <textarea name="description" id="edit-description" class="form-control">{{ old('description') }}</textarea>
                                <label for="description">Description *</label>
                            </div>
                            @error('description') <p class="fs-12 text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-4 col-md-12">
                            <h6 class="mb-2">Car Images</h6>

                            <div id="carImagesGrid" class="row g-3"></div>

                            <small class="text-muted d-block mt-2">
                            At least 5 images are required for an active page.
                            </small>
                        </div>





                        <div class="mb-3 col-12">
                            <label class="form-label fw-medium">
                                Vehicle Images
                            </label>

                            <input type="file"
                                name="images[]"
                                id="edit-images"
                                class="dropify"
                                data-height="140"
                                data-allowed-file-extensions="jpg jpeg png webp"
                                multiple>
                        </div>

                    </div>
                </form>

                {{-- Footer --}}
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('edit-form').submit();">
                        <i class="bi bi-floppy2-fill"></i>
                        Save Changes
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
    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.dropify').dropify();
        });

        $(document).on('click', '.delete-image', function () {
            const imageId = $(this).data('id');
            const carId   = $(this).data('car-id');

            if (!confirm('Delete this image?')) return;

            $.ajax({
                url: `/cars/images/${imageId}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: () => loadCarImages(carId),
                error: (xhr) => alert(xhr.responseJSON?.message || 'Cannot delete image')
            });
        });

        $(document).on('click', '.set-cover', function () {
            const imageId = $(this).data('img-id');
            const carId   = $(this).data('car-id');

            $.post(`/cars/images/${imageId}/set-cover`, {
                _token: $('meta[name="csrf-token"]').attr('content')
            }, () => {
                loadCarImages(carId);
            });
        });

        function show_edit_form(carId) {
            const $modal = $('#edit-modal');
            const $modalContent = $modal.find('.modal-content');
            
            // Store original content before showing spinner
            const originalContent = $modalContent.html();
            
            // Show spinner while keeping modal structure
            $modalContent.html(`
                <div class="modal-header">
                    <h5 class="modal-title">Loading...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);
            
            // Initialize modal if not already shown
            const modal = new bootstrap.Modal($modal[0]);
            modal.show();
            
            $.ajax({
                url: `/cars/${carId}/get-details`,
                type: 'GET',
                success: function(response) {
                    // Restore original modal structure
                    $modalContent.html(originalContent);
                    
                    // Populate form fields
                    $('#edit-make').val(response.car.make);
                    $('#edit-model').val(response.car.model);
                    $('#edit-trim').val(response.car.trim);
                    $('#edit-year').val(response.car.year);
                    $('#edit-color').val(response.car.color);
                    $('#edit-mileage').val(response.car.mileage);
                    $('#edit-price').val(response.car.price);
                    $('#edit-transmission').val(response.car.transmission);
                    $('#edit-description').text(response.car.description);
                    $('#edit-fuel_type').val(response.car.fuel_type);
                    $('#edit-condition').val(response.car.condition);
                    $('#edit-is_negotiable').val(response.car.price_type == 'negotiable'? 1 : 0);

                    loadCarImages(carId)
                    
                    // Set form action and method
                    $('#edit-form').attr('action', `/cars/${carId}`);
                    $('#edit-form').attr('method', 'POST');
                    $('#edit-form input[name="_method"]').remove();
                    $('#edit-form').append('<input type="hidden" name="_method" value="PUT">');
                    
                    // Update modal title
                    $modal.find('.modal-title').text(`Edit ${response.car.title}`);
                    
                    // Re-show modal with content
                    modal.show();
                },
                error: function(xhr) {
                    modal.hide();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to load car details',
                        toast: true,
                        timer: 5000
                    });
                    
                    // Restore original content for next attempt
                    $modalContent.html(originalContent);
                }
            });
        }


        function loadCarImages(carId) {
            $('#carImagesGrid').html('<p class="text-muted">Loading images...</p>');

            $.get(`/cars/${carId}/images`, function (res) {

                let html = '';

                res.images.forEach(img => {
                    html += `
                        <div class="col-4 col-md-3">
                            <div class="position-relative border rounded overflow-hidden">

                                <img src="${img.url}"
                                    class="img-fluid"
                                    style="aspect-ratio:1/1;object-fit:cover;">

                                ${img.is_cover
                                    ? `<span class="badge bg-dark position-absolute top-0 start-0 m-1">Cover</span>`
                                    : ''}

                                <div class="position-absolute bottom-0 start-0 end-0 d-flex ">
  
                                    <a href="#" class="mx-2 mb-2 btn btn-sm rounded-circle btn-success set-cover" title="Set as Cover Image" data-car-id="${carId}" data-img-id="${img.id}">
                                        <i class="bi bi bi-stars fs-6"></i>
                                    </a>



                                    <a href="#" class=" mb-2 btn btn-sm rounded-circle btn-danger delete-image" title="Delete Image" data-id="${img.id}">
                                        <i class="bi bi bi-trash fs-6"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    `;
                });

                $('#carImagesGrid').html(html);
            });
        }


        function activate(carId){
            $.ajax({
                url: `/cars/${carId}/pay`,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res){
                    if (res.authorization_url) {
                        window.location.href = res.authorization_url;
                    }
                },
                error: function (xhr){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred'
                    });
                }
            });
        }


        function deactivate(carId){
            $.ajax({
                url: `/cars/${carId}/status`,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    status: 'paused'
                },
                success: function(res){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message || 'Car Page Status Updated'
                    });
                    location.reload();
                },
                error: function (xhr){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred'
                    });
                }
            });
        }

        function reactivate(carId){
            $.ajax({
                url: `/cars/${carId}/status`,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    status: 'active'
                },
                success: function(res){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message || 'Car Page Status Updated'
                    });
                    location.reload();
                },
                error: function (xhr){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred'
                    });
                }
            });
        }



        function deleteCar(carId) {
            Swal.fire({
                title: 'Delete vehicle?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: `/cars/${carId}`,
                    type: 'DELETE',
                    data: {
                        '_token': "{{csrf_token()}}",
                    },
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Vehicle removed successfully.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Reload or remove row
                        location.reload();
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Failed to delete vehicle'
                        });
                    }
                });
            });
        }





    </script>
@endsection