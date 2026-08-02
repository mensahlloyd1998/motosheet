<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="icon" href="{{ asset('system_img/motosheet-favicon.png') }}" type="image/x-icon">

<title>Add a Vehicle — Motosheet</title>

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
  body{font-family:'Inter',system-ui,sans-serif;color:var(--black);background:var(--white);-webkit-font-smoothing:antialiased;line-height:1.5;min-height:100vh;display:flex;flex-direction:column;}
  a{color:inherit;text-decoration:none;}
  button{font-family:inherit;cursor:pointer;}
  img{max-width:100%;display:block;}
  :focus-visible{outline:2px solid var(--orange);outline-offset:3px;}
  .wrap{max-width:1240px;margin:0 auto;padding:0 32px;}

  /* header (shared with dashboard) */
  header{border-bottom:1px solid var(--line);position:sticky;top:0;background:rgba(255,255,255,0.92);backdrop-filter:blur(10px);z-index:100;}
  .nav{display:flex;align-items:center;justify-content:space-between;padding:16px 32px;max-width:1240px;margin:0 auto;gap:24px;}
  .nav img.brand{height:24px;width:auto;}
  .nav-tabs{display:flex;gap:6px;margin-right:auto;margin-left:36px;}
  .nav-tabs a{font-size:13.5px;font-weight:600;color:var(--text-muted);padding:8px 14px;border-radius:100px;}
  .nav-tabs a.active{background:var(--paper);color:var(--black);}
  .nav-tabs a:hover{color:var(--black);}
  @media(max-width:760px){ .nav-tabs{display:none;} }

  .user-menu{position:relative;}
  .user-btn{display:flex;align-items:center;gap:10px;font-size:13.5px;font-weight:600;background:none;border:none;padding:6px;border-radius:100px;}
  .user-btn:hover{background:var(--paper);}
  .user-avatar{width:30px;height:30px;border-radius:50%;background:var(--paper);border:1px solid var(--line);flex:none;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;color:var(--orange-deep);}
  .user-dropdown{position:absolute;top:calc(100% + 10px);right:0;background:#fff;border:1px solid var(--line);border-radius:6px;min-width:180px;box-shadow:0 8px 24px rgba(13,13,13,0.08);display:none;overflow:hidden;}
  .user-dropdown.show{display:block;}
  .user-dropdown a, .user-dropdown button{display:flex;align-items:center;gap:10px;width:100%;padding:12px 16px;font-size:13.5px;font-weight:500;text-align:left;background:none;border:none;color:var(--black);}
  .user-dropdown a:hover, .user-dropdown button:hover{background:var(--paper);}
  .user-dropdown form{margin:0;}
  .user-dropdown hr{border:none;border-top:1px solid var(--line);}

  /* breadcrumb + page head */
  .eyebrow-row{padding:24px 0 0;display:flex;align-items:center;gap:10px;font-size:12px;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-muted);font-weight:600;}
  .eyebrow-row .sep{color:#d3cfc6;}
  .eyebrow-row .current{color:var(--black);}
  .page-head{padding:14px 0 32px;border-bottom:1px solid var(--line);margin-bottom:36px;}
  .page-head h1{font-size:clamp(26px,3.2vw,36px);font-weight:800;letter-spacing:-0.02em;}
  .page-head .sub{font-size:14.5px;color:var(--text-muted);margin-top:6px;}

  /* alerts */
  .alert{border-radius:var(--radius);padding:14px 16px;font-size:13.5px;margin-bottom:24px;font-weight:500;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  .alert-danger ul{margin:6px 0 0 18px;}

  /* layout */
  .form-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:start;padding-bottom:80px;}
  @media(max-width:960px){ .form-grid{grid-template-columns:1fr;} }

  /* section cards */
  .section-card{border:1px solid var(--line);border-radius:6px;padding:28px;margin-bottom:24px;}
  .section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:4px;}
  .section-desc{font-size:13.5px;color:var(--text-muted);margin-bottom:22px;}

  .field-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;}
  .field-grid.cols-3{grid-template-columns:repeat(3,1fr);}
  @media(max-width:640px){ .field-grid, .field-grid.cols-3{grid-template-columns:1fr;} }

  .field{margin-bottom:18px;}
  .field:last-child{margin-bottom:0;}
  .field label{display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);margin-bottom:7px;}
  .field label .opt{text-transform:none;font-weight:500;letter-spacing:0;color:#b3afa6;}
  .field input[type="text"],
  .field input[type="number"],
  .field select,
  .field textarea{
    width:100%;border:1px solid var(--line);border-radius:var(--radius);padding:12px 13px;
    font-size:14.5px;font-family:inherit;background:#fff;transition:border-color .2s ease;color:var(--black);
  }
  .field input:focus, .field select:focus, .field textarea:focus{border-color:var(--orange);outline:none;}
  .field textarea{resize:vertical;min-height:130px;line-height:1.6;}
  .field select{appearance:none;-webkit-appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236b6862'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:34px;}
  .field small.text-danger{display:block;color:#c0391a;font-size:12px;margin-top:6px;}

  .price-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;align-items:end;}
  @media(max-width:640px){ .price-row{grid-template-columns:1fr;} }
  .price-input-wrap{position:relative;}
  .price-input-wrap span{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:14.5px;}
  .price-input-wrap input{padding-left:44px;}

  .toggle-row{display:flex;align-items:center;justify-content:space-between;border:1px solid var(--line);border-radius:var(--radius);padding:13px 15px;background:var(--paper);}
  .toggle-row .label-block{font-size:13.5px;}
  .toggle-row .label-block strong{display:block;font-size:13.5px;}
  .toggle-row .label-block span{font-size:12px;color:var(--text-muted);}
  .switch{position:relative;width:40px;height:22px;flex:none;}
  .switch input{opacity:0;width:0;height:0;}
  .switch .track{position:absolute;inset:0;background:#d8d4cb;border-radius:100px;transition:background .2s ease;cursor:pointer;}
  .switch .track::before{content:"";position:absolute;width:16px;height:16px;left:3px;top:3px;background:#fff;border-radius:50%;transition:transform .2s ease;}
  .switch input:checked + .track{background:var(--orange);}
  .switch input:checked + .track::before{transform:translateX(18px);}

  /* features */
  .feature-row{display:flex;gap:10px;margin-bottom:10px;}
  .feature-row input{flex:1;}
  .feature-remove{flex:none;width:44px;height:44px;border:1px solid var(--line);border-radius:var(--radius);background:#fff;color:var(--text-muted);display:flex;align-items:center;justify-content:center;}
  .feature-remove:hover{border-color:#c0391a;color:#c0391a;}
  .add-feature-btn{display:inline-flex;align-items:center;gap:8px;font-size:13.5px;font-weight:700;color:var(--orange-deep);background:none;border:none;padding:8px 0;margin-top:4px;}
  .add-feature-btn:hover{color:var(--black);}

  /* photo uploader */
  .dropzone{
    border:2px dashed var(--line);border-radius:6px;padding:36px 20px;text-align:center;
    background:var(--paper);cursor:pointer;transition:border-color .2s ease, background .2s ease;
  }
  .dropzone.dragover{border-color:var(--orange);background:#fff6f1;}
  .dropzone .icon{width:44px;height:44px;border-radius:50%;background:#fff;border:1px solid var(--line);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--orange);font-size:18px;}
  .dropzone p.main{font-size:14.5px;font-weight:600;}
  .dropzone p.sub{font-size:12.5px;color:var(--text-muted);margin-top:4px;}
  .dropzone input[type="file"]{display:none;}

  .photo-count-row{display:flex;justify-content:space-between;align-items:center;margin-top:14px;font-size:13px;}
  .photo-count-row .count.ok{color:#2d6a30;font-weight:700;}
  .photo-count-row .count.low{color:var(--orange-deep);font-weight:700;}

  .photo-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:16px;}
  @media(max-width:640px){ .photo-grid{grid-template-columns:repeat(3,1fr);} }
  .photo-thumb{position:relative;aspect-ratio:1/1;border-radius:4px;overflow:hidden;border:1px solid var(--line);background:#fff;}
  .photo-thumb img{width:100%;height:100%;object-fit:cover;}
  .photo-thumb .cover-tag{position:absolute;bottom:6px;left:6px;background:rgba(13,13,13,0.75);color:#fff;font-size:10px;font-weight:700;padding:3px 7px;border-radius:100px;letter-spacing:0.04em;text-transform:uppercase;}
  .photo-thumb .remove-thumb{
    position:absolute;top:6px;right:6px;width:22px;height:22px;border-radius:50%;
    background:rgba(13,13,13,0.75);color:#fff;border:none;display:flex;align-items:center;justify-content:center;font-size:11px;
  }
  .photo-thumb .remove-thumb:hover{background:#c0391a;}

  /* sticky aside */
  aside.side{position:sticky;top:96px;display:flex;flex-direction:column;gap:20px;}
  .tips-card{background:var(--black);color:#fff;border-radius:6px;padding:26px;}
  .tips-card .section-title{color:var(--orange);}
  .tips-card ul{list-style:none;margin-top:16px;display:flex;flex-direction:column;gap:14px;}
  .tips-card li{display:flex;align-items:flex-start;gap:10px;font-size:13.5px;color:#e6e4e0;line-height:1.5;}
  .tips-card .check{flex:none;width:18px;height:18px;border-radius:50%;background:#1b1a18;border:1px solid var(--orange);display:flex;align-items:center;justify-content:center;margin-top:1px;}
  .tips-card .check svg{width:10px;height:10px;}

  .checklist-card{border:1px solid var(--line);border-radius:6px;padding:22px;}
  .checklist-card .section-title{margin-bottom:14px;}
  .checklist-item{display:flex;align-items:center;gap:10px;font-size:13.5px;padding:9px 0;border-bottom:1px solid var(--line);color:var(--text-muted);}
  .checklist-item:last-child{border-bottom:none;}
  .checklist-item .dot{width:8px;height:8px;border-radius:50%;background:var(--line);flex:none;}
  .checklist-item.done{color:var(--black);font-weight:600;}
  .checklist-item.done .dot{background:var(--orange);}

  .submit-bar{display:flex;justify-content:flex-end;gap:12px;align-items:center;margin-top:8px;}
  .cta-btn{display:inline-flex;align-items:center;gap:8px;background:var(--orange);color:#fff;font-weight:700;font-size:15px;padding:14px 26px;border-radius:var(--radius);border:none;transition:background .2s ease, transform .15s ease;}
  .cta-btn:hover{background:var(--orange-deep);transform:translateY(-1px);}
  .cancel-link{font-size:13.5px;font-weight:600;color:var(--text-muted);padding:14px 8px;}
  .cancel-link:hover{color:var(--black);}

  footer{border-top:1px solid var(--line);padding:20px 32px;text-align:center;font-size:12.5px;color:var(--text-muted);margin-top:auto;}
</style>
</head>
<body>

<header>
    <div class="nav">
        <a href="/">
            <img src="{{ asset('system_img/motosheet-logo.png') }}" class="brand" alt="Motosheet logo">
        </a>
        <div class="nav-tabs">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('cars.index') }}" class="active">My Listings</a>
            <a href="{{ route('offers.index') }}">Offers</a>
        </div>
        <div class="user-menu">
            <button class="user-btn" id="userMenuBtn">
                <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                {{ auth()->user()->name ?? 'Account' }}
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
                <a href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> Account settings</a>
                <hr>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="bi bi-box-arrow-right"></i> Log out</button>
                </form>
            </div>
        </div>
    </div>
</header>

<main class="wrap" style="flex:1;">

    <div class="eyebrow-row">
        <a href="{{ route('cars.index') }}">My Listings</a><span class="sep">/</span><span class="current">Add Vehicle</span>
    </div>

    <div class="page-head">
        <h1>Add a Vehicle</h1>
        <p class="sub">Fill in the details below to create your listing. New listings are saved as a draft until published.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following before continuing:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $currency = optional(auth()->user()->country)->currency_code ?? '';
        $currentYear = date('Y');
    @endphp

    <form method="post" action="{{ route('cars.store') }}" enctype="multipart/form-data" id="carForm">
        @csrf

        <div class="form-grid">
            <div>

                {{-- Vehicle details --}}
                <div class="section-card">
                    <div class="section-title">Vehicle Details</div>
                    <p class="section-desc">The basics buyers see first.</p>

                    <div class="field-grid">
                        <div class="field">
                            <label for="make">Make</label>
                            <input type="text" id="make" name="make" value="{{ old('make') }}" placeholder="e.g. Porsche" required>
                            @error('make') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="model">Model</label>
                            <input type="text" id="model" name="model" value="{{ old('model') }}" placeholder="e.g. 911" required>
                            @error('model') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="field-grid">
                        <div class="field">
                            <label for="trim">Trim <span class="opt">(optional)</span></label>
                            <input type="text" id="trim" name="trim" value="{{ old('trim') }}" placeholder="e.g. Carrera S">
                            @error('trim') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="year">Year Model</label>
                            <input type="number" id="year" name="year" value="{{ old('year') }}" placeholder="e.g. 2022" min="1900" max="{{ $currentYear }}" required>
                            @error('year') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="field-grid cols-3">
                        <div class="field">
                            <label for="condition">Condition</label>
                            <select id="condition" name="condition" required>
                                <option value="" disabled {{ old('condition') ? '' : 'selected' }}>Select</option>
                                <option value="new" {{ old('condition') === 'new' ? 'selected' : '' }}>Brand New</option>
                                <option value="used" {{ old('condition') === 'used' ? 'selected' : '' }}>Used</option>
                                <option value="foreign_used" {{ old('condition') === 'foreign_used' ? 'selected' : '' }}>Foreign Used</option>
                            </select>
                            @error('condition') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="transmission">Transmission</label>
                            <select id="transmission" name="transmission" required>
                                <option value="" disabled {{ old('transmission') ? '' : 'selected' }}>Select</option>
                                <option value="manual" {{ old('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="automatic" {{ old('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                            </select>
                            @error('transmission') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="fuel_type">Fuel Type</label>
                            <select id="fuel_type" name="fuel_type" required>
                                <option value="" disabled {{ old('fuel_type') ? '' : 'selected' }}>Select</option>
                                <option value="petrol" {{ old('fuel_type') === 'petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="diesel" {{ old('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="hybrid" {{ old('fuel_type') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="electric" {{ old('fuel_type') === 'electric' ? 'selected' : '' }}>Electric</option>
                            </select>
                            @error('fuel_type') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="field-grid">
                        <div class="field">
                            <label for="mileage">Mileage (mi)</label>
                            <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" placeholder="e.g. 8200" min="0" required>
                            @error('mileage') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="color">Exterior Color <span class="opt">(optional)</span></label>
                            <input type="text" id="color" name="color" value="{{ old('color') }}" placeholder="e.g. GT Silver Metallic">
                            @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                {{-- Pricing --}}
                <div class="section-card">
                    <div class="section-title">Pricing</div>
                    <p class="section-desc">Set your asking price and whether you'll accept offers below it.</p>

                    <div class="price-row">
                        <div class="field">
                            <label for="price">Asking Price</label>
                            <div class="price-input-wrap">
                                <span>{{ $currency }}</span>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" min="0" step="0.01" required>
                            </div>
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="field">
                            <label>&nbsp;</label>
                            <div class="toggle-row">
                                <div class="label-block">
                                    <strong>Open to offers</strong>
                                    <span>Buyers can negotiate below asking</span>
                                </div>
                                <label class="switch">
                                    <input type="hidden" name="is_negotiable" value="0">
                                    <input type="checkbox" id="is_negotiable" name="is_negotiable" value="1" {{ old('is_negotiable', 1) ? 'checked' : '' }}>
                                    <span class="track"></span>
                                </label>
                            </div>
                            @error('is_negotiable') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="section-card">
                    <div class="section-title">Description</div>
                    <p class="section-desc">Give buyers the details a photo can't — history, condition, standout options.</p>
                    <div class="field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="This vehicle has been carefully maintained...">{{ old('description') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- Features --}}
                <div class="section-card">
                    <div class="section-title">Features & Options</div>
                    <p class="section-desc">Add anything worth calling out — optional, but listings with features get more offers.</p>
                    <div id="featuresList">
                        @php $oldFeatures = old('features', ['']); @endphp
                        @foreach($oldFeatures as $feature)
                            <div class="feature-row">
                                <input type="text" name="features[]" value="{{ $feature }}" placeholder="e.g. Sunroof, Bluetooth, Leather seats">
                                <button type="button" class="feature-remove" onclick="removeFeatureRow(this)"><i class="bi bi-x-lg"></i></button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-feature-btn" onclick="addFeatureRow()">
                        <i class="bi bi-plus-lg"></i> Add another feature
                    </button>
                    @error('features') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Photos --}}
                <div class="section-card">
                    <div class="section-title">Photos</div>
                    <p class="section-desc">Upload a minimum of 5 photos (JPG, PNG or WEBP).</p>

                    <div class="dropzone" id="dropzone">
                        <div class="icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <p class="main">Drag photos here, or click to browse</p>
                        <p class="sub">JPG, PNG or WEBP &middot; up to ~12MB each</p>
                        <input type="file" id="fileInput" name="images[]" accept=".jpg,.jpeg,.png,.webp" multiple>
                    </div>

                    <div class="photo-count-row">
                        <span id="photoCountText" class="count low">0 of 5 minimum photos added</span>
                    </div>

                    <div class="photo-grid" id="photoGrid"></div>

                    @error('images') <small class="text-danger">{{ $message }}</small> @enderror
                    @error('images.*') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>

            {{-- Sticky sidebar --}}
            <aside class="side">
                <div class="tips-card">
                    <div class="section-title">Listing Tips</div>
                    <ul>
                        <li><span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>Shoot photos in daylight, from all four corners plus the interior</li>
                        <li><span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>Be upfront about any wear, damage, or repair history</li>
                        <li><span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>Listings with 8+ photos and full feature lists get more offers</li>
                        <li><span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>New listings save as a draft — you'll publish once it looks right</li>
                    </ul>
                </div>

                <div class="checklist-card">
                    <div class="section-title">Before you publish</div>
                    <div class="checklist-item" id="check-details"><span class="dot"></span> Vehicle details completed</div>
                    <div class="checklist-item" id="check-price"><span class="dot"></span> Price set</div>
                    <div class="checklist-item" id="check-description"><span class="dot"></span> Description written</div>
                    <div class="checklist-item" id="check-photos"><span class="dot"></span> 5+ photos added</div>
                </div>
            </aside>
        </div>

        <div class="submit-bar">
            <a href="{{ route('cars.index') }}" class="cancel-link">Cancel</a>
            <button type="submit" class="cta-btn"><i class="bi bi-plus-lg"></i> Create Listing</button>
        </div>

    </form>

</main>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

<script>
    // ---------- user dropdown ----------
    const menuBtn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => dropdown.classList.remove('show'));

    // ---------- features: add/remove rows ----------
    function addFeatureRow() {
        const list = document.getElementById('featuresList');
        const row = document.createElement('div');
        row.className = 'feature-row';
        row.innerHTML = `
            <input type="text" name="features[]" placeholder="e.g. Sunroof, Bluetooth, Leather seats">
            <button type="button" class="feature-remove" onclick="removeFeatureRow(this)"><i class="bi bi-x-lg"></i></button>
        `;
        list.appendChild(row);
    }
    function removeFeatureRow(btn) {
        const list = document.getElementById('featuresList');
        if (list.children.length > 1) {
            btn.closest('.feature-row').remove();
        } else {
            btn.closest('.feature-row').querySelector('input').value = '';
        }
    }

    // ---------- photo uploader (drag & drop, previews, min-5 enforcement) ----------
    const MIN_PHOTOS = 5;
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const photoGrid = document.getElementById('photoGrid');
    const photoCountText = document.getElementById('photoCountText');
    const checkPhotos = document.getElementById('check-photos');

    let selectedFiles = [];

    dropzone.addEventListener('click', () => fileInput.click());
    dropzone.addEventListener('dragover', (e) => { e.preventDefault(); dropzone.classList.add('dragover'); });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        addFiles(e.dataTransfer.files);
    });
    fileInput.addEventListener('change', (e) => addFiles(e.target.files));

    function addFiles(fileList) {
        Array.from(fileList).forEach(file => {
            if (file.type.startsWith('image/')) selectedFiles.push(file);
        });
        syncInputAndPreviews();
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        syncInputAndPreviews();
    }

    function syncInputAndPreviews() {
        // Rebuild the file input's FileList via DataTransfer so the form submits the current set
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;

        // Rebuild previews
        photoGrid.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const url = URL.createObjectURL(file);
            const thumb = document.createElement('div');
            thumb.className = 'photo-thumb';
            thumb.innerHTML = `
                <img src="${url}" alt="">
                ${index === 0 ? '<span class="cover-tag">Cover</span>' : ''}
                <button type="button" class="remove-thumb" onclick="removeFile(${index})"><i class="bi bi-x"></i></button>
            `;
            photoGrid.appendChild(thumb);
        });

        const count = selectedFiles.length;
        photoCountText.textContent = count >= MIN_PHOTOS
            ? `${count} photos added`
            : `${count} of ${MIN_PHOTOS} minimum photos added`;
        photoCountText.className = 'count ' + (count >= MIN_PHOTOS ? 'ok' : 'low');
        checkPhotos.classList.toggle('done', count >= MIN_PHOTOS);
    }

    // ---------- lightweight "ready to publish" checklist ----------
    function refreshChecklist() {
        const details = document.getElementById('make').value && document.getElementById('model').value && document.getElementById('year').value;
        document.getElementById('check-details').classList.toggle('done', !!details);
        document.getElementById('check-price').classList.toggle('done', !!document.getElementById('price').value);
        document.getElementById('check-description').classList.toggle('done', document.getElementById('description').value.trim().length > 0);
    }
    ['make','model','year','price','description'].forEach(id => {
        document.getElementById(id).addEventListener('input', refreshChecklist);
    });

    // ---------- guard: require at least 5 photos before submit ----------
    document.getElementById('carForm').addEventListener('submit', function (e) {
        if (selectedFiles.length < MIN_PHOTOS) {
            e.preventDefault();
            dropzone.scrollIntoView({ behavior: 'smooth', block: 'center' });
            photoCountText.textContent = `Please add at least ${MIN_PHOTOS} photos (${selectedFiles.length} added so far)`;
            photoCountText.className = 'count low';
        }
    });
</script>

</body>
</html>