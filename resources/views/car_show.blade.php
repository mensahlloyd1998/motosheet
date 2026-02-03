<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('system_img/motosheet-favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('front-assets/css/styles.css') }}">

    <title>{{ $car->make }} {{ $car->model }} {{ $car->trim }}</title>
</head>

@php
    $conditionLabels = [
        'foreign_used' => 'Foreign Used',
        'used' => 'Used',
        'new' => 'Brand New',
    ];

    $overview = [
        'Make'         => $car->make,
        'Model'        => $car->model,
        'Trim'         => $car->trim,
        'Year Model'   => $car->year,
        'Mileage'      => $car->mileage.' mi',
        'Condition'    => $conditionLabels[$car->condition] ?? 'Unknown',
        'Transmission' => ucfirst($car->transmission),
        'Fuel Type'    => ucfirst($car->fuel_type),
    ];
@endphp

<body>

<header class="border-bottom border-secondary mb-5">
    <div class="container-md py-3 d-flex align-items-center">
        <span class="me-2">Made with</span>
        <a href="/">
            <img src="{{ asset('system_img/motosheet-logo.png') }}" class="navbar-brand" width="200" alt="Logo">
        </a>
    </div>
</header>

<main>

    {{-- Top Section --}}
    <section class="container-md mb-5">

        @if($errors->any())
            <div class="alert alert-danger mb-2 fw-light">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mb-5 fw-light" role="alert">
                {{  session('success') }}
            </div>
        @else
            <div class="alert alert-warning mb-5 fw-light" role="alert">
                Submitting an offer does not constitute a commitment to purchase. Final decisions can be made after inspection.
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning mb-2 fw-light">
                {{ session('warning') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">
                {{ $car->make }} {{ $car->model }} {{ $car->trim }}
            </h1>
            @auth

                @if(auth()->user()->id == $car->user_id)
                    <a href="{{ route('cars.qr', ['car'=>$car->id]) }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Print Poster
                    </a>
                @endif

            @endauth

            @guest

            <a href="#make-an-offer" class="btn btn-outline-secondary btn-sm rounded-pill">
                Make Offer
            </a>

            @endguest
            
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge text-bg-secondary">
                    <i class="bi bi-calendar-date-fill text-primary me-1"></i>
                    {{ $car->year }}
                </span>

                <span class="badge text-bg-secondary">
                    <i class="bi bi-file-earmark-medical-fill text-primary me-1"></i>
                    {{ $conditionLabels[$car->condition] ?? 'Unknown' }}
                </span>

                <span class="badge text-bg-secondary d-none d-md-inline-block">
                    <i class="bi bi-fuel-pump-fill text-primary me-1"></i>
                    {{ ucfirst($car->fuel_type) }}
                </span>
            </div>

            <p class="product-price mb-0 text-primary fw-semibold">
                GHS {{ number_format($car->price) }}
            </p>
        </div>

        {{-- Image Grid --}}
        <div class="row g-3 mt-4 image-grid">

            {{-- Main image --}}
            <div class="col-md-7">
                @php $mainImage = $car->images->first(); @endphp

                @if($mainImage)
                    <div class="image-wrapper main-image gallery-trigger"
                         data-image="{{ asset('storage/'.$mainImage->image_path) }}">
                        <img src="{{ asset('storage/'.$mainImage->image_path) }}" class="img-fluid" alt="">
                    </div>
                @endif
            </div>

            {{-- Thumbnails --}}
            <div class="col-md-5">
                <div class="row g-3">
                    @foreach ($car->images->skip(1)->take(4) as $img)
                        <div class="col-6">
                            <div class="image-wrapper gallery-trigger"
                                 data-image="{{ asset('storage/'.$img->image_path) }}">
                                <img src="{{ asset('storage/'.$img->image_path) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- Content --}}
    <div class="container-md">
        <div class="row gx-md-5 align-items-md-start">

            {{-- Left column --}}
            <div class="col-md-8">

                {{-- Overview --}}
                <section class="mb-5">
                    <h2 class="h6 border-bottom border-secondary mb-4 pb-2">Vehicle Overview</h2>

                    <ul class="overview-list row justify-content-between">
                        @foreach($overview as $label => $value)
                            <li class="marker-primary col-md-5 py-2">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">{{ $label }}</span>
                                    <span class="fw-light">{{ $value }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                {{-- Description --}}
                <section class="mb-5">
                    <h2 class="h6 border-bottom border-secondary mb-4 pb-2">Description</h2>
                    <p class="text-dark fw-light">
                        {!! $car->description !!}
                    </p>
                </section>

                {{-- Features --}}
                @if(is_array($car->features) && count(array_filter($car->features)))
                    <section class="mb-5">
                        <h2 class="h6 border-bottom border-secondary mb-4 pb-2">
                            Special Features
                        </h2>

                        <ul class="list-unstyled row">
                            @foreach(array_filter($car->features) as $feature)
                                <li class="col-6 col-md-4 d-flex align-items-center mb-2">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

            </div>

            {{-- Sidebar --}}
            <aside class="col-md-4 mt-md-4 border rounded p-4">

                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle bg-light me-2" style="width:50px;height:50px;"></div>
                    <div>
                        <strong>{{ $car->user->name }}</strong><br>
                        <small class="text-muted">{{ $car->user->phone }}</small>
                    </div>
                </div>

                {{-- Offer Form --}}
                <div id="make-an-offer" class="card bg-secondary border-0">
                    <div class="card-body">
                        <h5 class="h6">Make an Offer</h5>
                        <p class="mb-3">
                            Submit your offer. The seller will contact you if interested.
                        </p>

                        <form method="post" action="{{ route('cars.inquiry.store', ['car'=>$car->slug]) }}">
                            @csrf

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name') }}"
                                        placeholder="Name">
                                    <label>Name *</label>
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone') ?? '+233' }}"
                                        placeholder="Phone Number">
                                    <label>Phone Number *</label>
                                </div>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input
                                        type="number"
                                        name="offer"
                                        step="100"
                                        class="form-control"
                                        value="{{ old('offer') }}"
                                        placeholder="Offer Amount">
                                    <label>Offer Amount *</label>
                                </div>
                                @error('offer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary py-3 w-100" type="submit">
                                <i class="bi bi-send-check-fill me-2"></i>Submit Offer
                            </button>
                        </form>
                    </div>
                </div>

            </aside>

        </div>
    </div>

</main>

<footer class="bg-secondary py-5 mt-5">
    <div class="container-md text-center">
        <img src="{{ asset('system_img/motosheet-logo.png') }}" width="200" class="mb-3">
        <p class="mb-0">Beautiful single-page listings for cars</p>
    </div>
</footer>

{{-- Gallery Modal --}}
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-black">
            <button type="button" class="btn-close btn-close-white ms-auto m-3"
                    data-bs-dismiss="modal"></button>

            <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                <img id="galleryMainImage" class="img-fluid mb-4">

                <div class="d-flex gap-2 flex-wrap justify-content-center gallery-thumbs">
                    @foreach ($car->images as $img)
                        <img src="{{ asset('storage/'.$img->image_path) }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    const mainImage = document.getElementById('galleryMainImage');
    const thumbs = document.querySelectorAll('.gallery-thumbs img');

    document.querySelectorAll('.gallery-trigger').forEach(el => {
        el.addEventListener('click', () => {
            const src = el.dataset.image;
            mainImage.src = src;
            modal.show();
        });
    });

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            mainImage.src = thumb.src;
        });
    });
</script>

</body>
</html>
