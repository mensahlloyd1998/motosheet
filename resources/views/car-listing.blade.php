

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,500&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('system_img/motosheet-favicon.png') }}" type="image/x-icon">

<title>{{ $car->make }} {{ $car->model }} {{ $car->trim }} for sale</title>
<meta name="description" content="{{ $car->year }} {{ $car->make }} {{ $car->model }} {{ $car->trim }} for sale.">

<style>
  :root{
    --black:#0d0d0d;
    --white:#ffffff;
    --paper:#f6f5f2;
    --line:#e7e4dd;
    --orange:#ff5a1f;
    --orange-deep:#d8460f;
    --text-muted:#6b6862;
    --radius:2px;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  html{scroll-behavior:smooth;}
  body{font-weight:300;font-family:'Inter',system-ui,sans-serif;color:var(--black);background:var(--white);-webkit-font-smoothing:antialiased;line-height:1.5;}
  img{max-width:100%;display:block;}
  a{color:inherit;text-decoration:none;}
  button{font-family:inherit;cursor:pointer;}
  .wrap{max-width:1240px;margin:0 auto;padding:0 32px;}
  :focus-visible{outline:2px solid var(--orange);outline-offset:3px;}

  /* alerts */
  .alert{border-radius:var(--radius);padding:16px 18px;font-size:14px;margin:24px auto 0;max-width:1176px;font-weight:500;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  .alert-success{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}
  .alert-warning{background:var(--paper);color:#6b5636;border:1px solid var(--line);}
  .alert a{color:var(--orange-deep);font-weight:700;}

  header{position:sticky;top:0;z-index:100;background:rgba(255,255,255,0.92);backdrop-filter:blur(10px);border-bottom:1px solid var(--line);}
  .nav{display:flex;align-items:center;justify-content:space-between;padding:18px 32px;max-width:1240px;margin:0 auto;}
  .nav .made-with{font-size:12px;color:var(--text-muted);display:flex;align-items:center;gap:8px;}
  .nav img.brand{height:26px;width:auto;}

  .eyebrow-row{padding:28px 0 0;display:flex;align-items:center;gap:10px;font-size:12px;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);font-weight:600;}

  .title-row{display:flex;justify-content:space-between;align-items:flex-end;gap:24px;padding:14px 0 28px;flex-wrap:wrap;border-bottom:1px solid var(--line);}
  h1{font-size:clamp(28px,4.2vw,48px);font-weight:800;letter-spacing:-0.02em;line-height:1.05;}
  .badges{display:flex;gap:8px;margin-top:14px;flex-wrap:wrap;}
  .badge{font-size:12px;font-weight:600;letter-spacing:0.03em;padding:7px 13px;border:1px solid var(--line);border-radius:100px;color:var(--black);background:var(--paper);display:inline-flex;align-items:center;gap:6px;}
  .badge.condition{background:#fff;border-color:var(--orange);color:var(--orange-deep);}
  .badge .bi{color:var(--orange);}
  .cta-btn{display:inline-block;background:var(--orange);color:#fff;font-weight:700;font-size:14px;padding:12px 22px;border-radius:var(--radius);border:none;white-space:nowrap;transition:background .2s ease;}
  .cta-btn:hover{background:var(--orange-deep);}
  @media(max-width:576px){ .cta-btn{display:none;} }

  .gallery-section{padding:32px 0 8px;}
  .gallery{display:grid;grid-template-columns:1fr 108px;gap:14px;}
  .main-frame{position:relative;border-radius:var(--radius);overflow:hidden;background:var(--paper);aspect-ratio:16/10;cursor:pointer;}
  .main-frame img{width:100%;height:100%;object-fit:cover;}
  .frame-count{position:absolute;bottom:16px;right:16px;background:rgba(13,13,13,0.75);color:#fff;font-size:12px;font-weight:600;padding:6px 12px;border-radius:100px;}
  .thumb-col{display:flex;flex-direction:column;gap:14px;overflow:hidden;}
  .thumb{border-radius:var(--radius);overflow:hidden;aspect-ratio:1/1;cursor:pointer;border:2px solid transparent;opacity:0.7;transition:opacity .2s ease;background:var(--paper);}
  .thumb img{width:100%;height:100%;object-fit:cover;}
  .thumb:hover{opacity:1;}
  @media(max-width:700px){ .gallery{grid-template-columns:1fr;} .thumb-col{flex-direction:row;overflow-x:auto;} .thumb{min-width:74px;width:74px;flex:none;} }

  .content-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;padding:56px 0;align-items:start;}
  @media(max-width:960px){ .content-grid{grid-template-columns:1fr;} }
  .section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:16px;}
  .desc-text{font-size:14.5px;line-height:1.75;color:#2c2a27;max-width:70ch;}

  .spec-plate{background:var(--black);color:#fff;padding:56px 0;margin-top:8px;}
  .spec-plate .section-title{color:var(--orange);margin-bottom:28px;}
  .plate-grid{display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid #2a2a28;border-left:1px solid #2a2a28;}
  .plate-cell{border-right:1px solid #2a2a28;border-bottom:1px solid #2a2a28;padding:20px 22px;}
  .plate-cell .k{font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#8c8a86;font-weight:600;margin-bottom:8px;}
  .plate-cell .v{font-size:14px;font-weight:400;letter-spacing:-0.01em;}
  @media(max-width:860px){ .plate-grid{grid-template-columns:repeat(2,1fr);} }
  @media(max-width:480px){ .plate-grid{grid-template-columns:1fr;} }

  .features-section{padding:64px 20px; margin: 0 auto;}
  .features-list{display:grid;grid-template-columns:repeat(2,1fr);column-gap:40px;row-gap:0;margin-top:8px;}
  @media(max-width:640px){ .features-list{grid-template-columns:1fr;} }
  .feature-item{display:flex;align-items:flex-start;gap:12px;font-size:14px;padding:14px 0;border-bottom:1px solid var(--line);}
  .feature-item .check{flex:none;width:20px;height:20px;border-radius:50%;background:var(--paper);border:1px solid var(--orange);display:flex;align-items:center;justify-content:center;margin-top:1px;}
  .feature-item .check svg{width:11px;height:11px;}

  aside.offer-card{position:sticky;top:96px;border:1px solid var(--line);border-radius:6px;padding:26px;background:var(--white);box-shadow:0 1px 2px rgba(13,13,13,0.04);}
  .seller-row{display:flex;align-items:center;gap:12px;margin-bottom:22px;padding-bottom:22px;border-bottom:1px solid var(--line);}
  .seller-avatar{width:46px;height:46px;border-radius:50%;background:var(--paper);border:1px solid var(--line);flex:none;}
  .seller-row strong{font-size:15px;}
  .seller-row small{color:var(--text-muted);font-size:13px;}
  .offer-card h2{font-size:16px;font-weight:800;margin-bottom:6px;}
  .offer-card .offer-copy{font-size:13.5px;color:var(--text-muted);margin-bottom:18px;line-height:1.6;}
  .field{margin-bottom:14px;}
  .field label{display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);margin-bottom:6px;}
  .field input{width:100%;border:1px solid var(--line);border-radius:var(--radius);padding:12px 13px;font-size:14.5px;font-family:inherit;background:#fff;transition:border-color .2s ease;}
  .field input:focus{border-color:var(--orange);outline:none;}
  .field small.text-danger{display:block;color:#c0391a;font-size:12px;margin-top:5px;}
  .submit-btn{width:100%;background:var(--black);color:#fff;font-weight:700;font-size:14.5px;padding:14px;border:none;border-radius:var(--radius);margin-top:4px;transition:background .2s ease;display:flex;align-items:center;justify-content:center;gap:8px;}
  .submit-btn:hover{background:var(--orange-deep);}

  footer{background:var(--black);color:#8c8a86;padding:40px 0;text-align:center;margin-top:24px;}
  footer img{margin:0 auto 14px;}
  footer p{font-size:13px;}

  /* gallery modal */
  .gmodal{position:fixed;inset:0;background:rgba(13,13,13,0.97);display:none;z-index:1000;flex-direction:column;align-items:center;justify-content:center;padding:32px;}
  .gmodal.show{display:flex;}
  .gmodal img.main{max-width:90vw;max-height:70vh;object-fit:contain;border-radius:4px;}
  .gmodal-close{position:absolute;top:24px;right:32px;background:none;border:none;color:#fff;font-size:28px;line-height:1;}
  .gmodal-thumbs{display:flex;gap:10px;margin-top:24px;flex-wrap:wrap;justify-content:center;max-width:80vw;}
  .gmodal-thumbs img{width:64px;height:64px;object-fit:cover;border-radius:3px;cursor:pointer;opacity:0.6;transition:opacity .2s ease;}
  .gmodal-thumbs img:hover{opacity:1;}

  .d-flex{
    display:flex;
    gap:1rem;
  }
</style>
</head>
<body>

<header>
    <div class="nav">
        <div class="d-flex flex">
            <span class="made-with">Made with</span>
            <a href="/">
                <img src="{{ asset('system_img/motosheet-logo.png') }}" class="brand" alt="Motosheet logo">
            </a>
        </div>
        
    </div>
</header>

<main class="wrap">

    @php 
        $conditionLabels = [
            'new' => 'New',
            'foreign_used' => 'Foreign Used',
            'used' => 'Used'
        ]
    @endphp

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @else
        @guest
            <div class="alert alert-warning">
                <p class="mb-0">Interested? <a href="#make-an-offer">Make an offer</a>. Submitting an offer does not constitute a commitment to purchase. Final decisions can be made after inspection.</p>
            </div>
        @endguest
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    @auth
        <div class="alert alert-warning">
            <p class="mb-0">Your motosheet is live and shareable. <a href="{{ route('cars.qr', ['car' => $car->id]) }}">Generate a sign</a> with a QR code to direct people to it instantly.</p>
        </div>
    @endauth

    <div class="title-row">
        <div>
            <h1>{{ $car->make }} {{ $car->model }} {{ $car->trim }}</h1>
            <div class="badges">
                <span class="badge"><i class="bi bi-calendar-date-fill"></i>&nbsp;{{ $car->year }}</span>
                <span class="badge condition">{{ $conditionLabels[$car->condition] ?? 'Unknown' }}</span>
                <span class="badge"><i class="bi bi-fuel-pump-fill"></i>&nbsp;{{ ucfirst($car->fuel_type) }}</span>
            </div>
        </div>
        <a href="#make-an-offer" class="cta-btn">Make an Offer</a>
    </div>

    {{-- Gallery: main + up to 7 thumbnails (8 images total) --}}
    <section class="gallery-section">
        @php $mainImage = $car->images->first(); @endphp
        <div class="gallery">
            @if($mainImage)
                <div class="main-frame gallery-trigger" data-image="{{ asset('storage/'.$mainImage->image_path) }}">
                    <img src="{{ asset('storage/'.$mainImage->image_path) }}" alt="{{ $car->make }} {{ $car->model }}">
                    <span class="frame-count">{{ $car->images->count() }} photos</span>
                </div>
            @endif
            <div class="thumb-col">
                @foreach($car->images->skip(1)->take(7) as $img)
                    <div class="thumb gallery-trigger" data-image="{{ asset('storage/'.$img->image_path) }}">
                        <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $car->make }} {{ $car->model }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="content-grid">
        <div>
            <div class="section-title">Description</div>
            <div class="desc-text">{!! $car->description !!}</div>
        </div>

        <aside class="offer-card">
            <div class="seller-row">
                <div class="seller-avatar"></div>
                <div>
                    <strong>{{ $car->user->name }}</strong><br>
                    <small>{{ $car->user->phone }}</small>
                </div>
            </div>

            <div id="make-an-offer">
                <h2>Make an Offer</h2>
                <p class="offer-copy">Submit your offer. The seller will contact you if interested.</p>

                <form method="post" action="{{ route('cars.inquiry.store', ['car' => $car->slug]) }}">
                    @csrf

                    <div class="field">
                        <label>Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Full name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label>Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone') ?? '+'.$car->user->country->phone_code }}" placeholder="Phone number">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label>Offer Amount ({{ $car->user->country->currency_code }}) *</label>
                        <input type="number" name="offer" step="100" value="{{ old('offer') }}" placeholder="Offer amount">
                        @error('offer') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button class="submit-btn" type="submit">
                        <i class="bi bi-send-check-fill"></i> Submit Offer
                    </button>
                </form>
            </div>
        </aside>
    </div>

</main>

{{-- Vehicle Overview (signature spec plate) --}}
@php
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
<section class="spec-plate">
    <div class="wrap">
        <div class="section-title">Vehicle Overview</div>
        <div class="plate-grid">
            @foreach($overview as $label => $value)
                <div class="plate-cell">
                    <div class="k">{{ $label }}</div>
                    <div class="v">{{ $value }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Features --}}
@if(is_array($car->features) && count(array_filter($car->features)))
    <section class="features-section wrap">
        <div class="section-title">Special Features</div>
        <div class="features-list">
            @foreach(array_filter($car->features) as $feature)
                <div class="feature-item">
                    <span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>
                    {{ $feature }}
                </div>
            @endforeach
        </div>
    </section>
@endif

<footer>
    <div class="wrap">
        <img src="{{ asset('system_img/motosheet-logo.png') }}" width="180" alt="Motosheet logo">
        <p>Beautiful single-page listings for cars</p>
    </div>
</footer>

{{-- Gallery Modal --}}
<div class="gmodal" id="galleryModal">
    <button class="gmodal-close" id="galleryClose" aria-label="Close gallery">&times;</button>
    <img id="galleryMainImage" class="main" alt="">
    <div class="gmodal-thumbs">
        @foreach($car->images as $img)
            <img src="{{ asset('storage/'.$img->image_path) }}" alt="">
        @endforeach
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<script>
    const modal = document.getElementById('galleryModal');
    const mainImage = document.getElementById('galleryMainImage');
    const closeBtn = document.getElementById('galleryClose');
    const thumbs = document.querySelectorAll('.gmodal-thumbs img');

    document.querySelectorAll('.gallery-trigger').forEach(el => {
        el.addEventListener('click', () => {
            mainImage.src = el.dataset.image;
            modal.classList.add('show');
        });
    });

    closeBtn.addEventListener('click', () => modal.classList.remove('show'));
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('show'); });

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => { mainImage.src = thumb.src; });
    });
</script>

</body>
</html>
