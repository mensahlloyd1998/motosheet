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

<title>My Listings — Motosheet</title>

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
  .wrap{max-width:1280px;margin:0 auto;padding:0 32px;}

  /* header */
  header{border-bottom:1px solid var(--line);position:sticky;top:0;background:rgba(255,255,255,0.92);backdrop-filter:blur(10px);z-index:100;}
  .nav{display:flex;align-items:center;justify-content:space-between;padding:16px 32px;max-width:1280px;margin:0 auto;gap:24px;}
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
  .user-dropdown{
    position:absolute;top:calc(100% + 10px);right:0;background:#fff;border:1px solid var(--line);
    border-radius:6px;min-width:180px;box-shadow:0 8px 24px rgba(13,13,13,0.08);
    display:none;overflow:hidden;
  }
  .user-dropdown.show{display:block;}
  .user-dropdown a, .user-dropdown button{
    display:flex;align-items:center;gap:10px;width:100%;padding:12px 16px;font-size:13.5px;font-weight:500;
    text-align:left;background:none;border:none;color:var(--black);
  }
  .user-dropdown a:hover, .user-dropdown button:hover{background:var(--paper);}
  .user-dropdown form{margin:0;}
  .user-dropdown hr{border:none;border-top:1px solid var(--line);}

  /* alerts + toast */
  .alert{border-radius:var(--radius);padding:14px 16px;font-size:13.5px;margin:24px 0 0;font-weight:500;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  .alert-success{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}
  #toast{
    position:fixed;top:20px;right:20px;z-index:1000;display:flex;flex-direction:column;gap:10px;
  }
  #toast .toast-item{
    min-width:260px;max-width:340px;padding:13px 16px;border-radius:6px;font-size:13.5px;font-weight:500;
    box-shadow:0 8px 24px rgba(13,13,13,0.12);animation:slideIn .2s ease;
  }
  .toast-item.ok{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}
  .toast-item.err{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  @keyframes slideIn{ from{opacity:0;transform:translateX(12px);} to{opacity:1;transform:translateX(0);} }

  /* page head */
  .page-head{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;padding:40px 0 28px;flex-wrap:wrap;}
  .page-head .eyebrow{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:10px;}
  .page-head h1{font-size:clamp(26px,3.2vw,36px);font-weight:800;letter-spacing:-0.02em;}
  .page-head .sub{font-size:14.5px;color:var(--text-muted);margin-top:6px;}

  .cta-btn{display:inline-flex;align-items:center;gap:8px;background:var(--orange);color:#fff;font-weight:700;font-size:14px;padding:12px 20px;border-radius:var(--radius);border:none;white-space:nowrap;transition:background .2s ease;}
  .cta-btn:hover{background:var(--orange-deep);}

  /* toolbar */
  .toolbar{display:flex;justify-content:space-between;align-items:center;gap:16px;padding-bottom:24px;flex-wrap:wrap;}
  .search-form{position:relative;flex:1;min-width:220px;max-width:360px;}
  .search-form input{
    width:100%;border:1px solid var(--line);border-radius:100px;padding:11px 16px 11px 40px;
    font-size:14px;font-family:inherit;background:var(--paper);transition:border-color .2s ease, background .2s ease;
  }
  .search-form input:focus{border-color:var(--orange);outline:none;background:#fff;}
  .search-form i{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:14px;}
  .search-form button{position:absolute;right:6px;top:50%;transform:translateY(-50%);background:var(--black);color:#fff;border:none;border-radius:100px;padding:6px 14px;font-size:12.5px;font-weight:600;}
  .search-form button:hover{background:var(--orange-deep);}
  .toolbar-count{font-size:13.5px;color:var(--text-muted);white-space:nowrap;}

  /* table */
  .table-wrap{border:1px solid var(--line);border-radius:6px;overflow:hidden;margin-bottom:40px;}
  table{width:100%;border-collapse:collapse;}
  thead th{
    text-align:left;font-size:11.5px;text-transform:uppercase;letter-spacing:0.08em;font-weight:700;
    color:var(--text-muted);background:var(--paper);padding:14px 20px;border-bottom:1px solid var(--line);
  }
  tbody td{padding:16px 20px;border-bottom:1px solid var(--line);font-size:14.5px;vertical-align:middle;}
  tbody tr:last-child td{border-bottom:none;}
  tbody tr:hover{background:#fcfbf9;}

  .car-cell{display:flex;align-items:center;gap:14px;}
  .car-thumb{width:64px;height:48px;border-radius:4px;object-fit:cover;background:var(--paper);border:1px solid var(--line);flex:none;}
  .car-cell .name{font-weight:700;font-size:14.5px;}
  .car-cell .meta{font-size:12.5px;color:var(--text-muted);margin-top:2px;}

  .price-cell .amount{font-weight:700;}
  .price-cell .tag{display:block;font-size:11.5px;color:var(--text-muted);margin-top:2px;}

  .pill{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;padding:5px 11px;border-radius:100px;background:var(--paper);border:1px solid var(--line);}
  .pill.condition-new{color:var(--orange-deep);border-color:var(--orange);background:#fff;}
  .offers-count{font-weight:700;}
  .offers-count.has-offers{color:var(--orange-deep);}

  /* status select styled as a pill */
  .status-select-wrap{position:relative;display:inline-block;}
  select.status-select{
    appearance:none;-webkit-appearance:none;font-family:inherit;font-size:12px;font-weight:700;
    padding:6px 28px 6px 12px;border-radius:100px;border:1px solid var(--line);background:var(--paper);color:var(--black);
    cursor:pointer;
  }
  .status-select-wrap::after{
    content:"";position:absolute;right:10px;top:50%;width:6px;height:6px;
    border-right:1.5px solid var(--text-muted);border-bottom:1.5px solid var(--text-muted);
    transform:translateY(-65%) rotate(45deg);pointer-events:none;
  }
  select.status-select.status-draft{background:var(--paper);color:var(--text-muted);}
  select.status-select.status-active{background:#eef7ee;color:#2d6a30;border-color:#c9e4c9;}
  select.status-select.status-paused{background:#fff6e9;color:#96660f;border-color:#f0dbb0;}
  select.status-select.status-expired{background:#fdece7;color:#a3320f;border-color:#f3c7b8;}
  select.status-select.status-sold{background:var(--black);color:#fff;border-color:var(--black);}

  .row-actions{display:flex;gap:6px;justify-content:flex-end;}
  .icon-btn{
    width:32px;height:32px;border-radius:4px;border:1px solid var(--line);background:#fff;
    display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--text-muted);
    transition:all .15s ease;
  }
  .icon-btn:hover{border-color:var(--orange);color:var(--orange-deep);}
  .icon-btn.danger:hover{border-color:#c0391a;color:#c0391a;}

  /* mobile cards */
  .car-cards{display:none;flex-direction:column;gap:14px;margin-bottom:40px;}
  .car-card{border:1px solid var(--line);border-radius:6px;padding:16px;display:flex;gap:14px;}
  .car-card .car-thumb{width:88px;height:64px;}
  .car-card-body{flex:1;}
  .car-card-body .top{display:flex;justify-content:space-between;align-items:flex-start;gap:8px;}
  .car-card-body .badges-row{display:flex;gap:6px;flex-wrap:wrap;margin:8px 0;align-items:center;}
  .car-card-actions{display:flex;gap:8px;margin-top:10px;}

  @media(max-width:760px){
    .table-wrap{display:none;}
    .car-cards{display:flex;}
  }

  /* empty state */
  .empty-state{text-align:center;padding:80px 24px;border:1px dashed var(--line);border-radius:6px;}
  .empty-state .icon{
    width:56px;height:56px;border-radius:50%;background:var(--paper);border:1px solid var(--line);
    display:flex;align-items:center;justify-content:center;margin:0 auto 20px;color:var(--orange);font-size:22px;
  }
  .empty-state h3{font-size:19px;font-weight:800;margin-bottom:8px;}
  .empty-state p{font-size:14.5px;color:var(--text-muted);margin-bottom:22px;max-width:36ch;margin-left:auto;margin-right:auto;}

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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="page-head">
        <div>
            <div class="eyebrow">Listings</div>
            <h1>My Listings</h1>
            <p class="sub">Manage your vehicles, track offers, and publish new listings.</p>
        </div>
        <a href="{{ route('cars.create') }}" class="cta-btn">
            <i class="bi bi-plus-lg"></i> Add Vehicle
        </a>
    </div>

    <div class="toolbar">
        {{-- Controller filters on `title`, which already combines year + make + model + trim --}}
        <form class="search-form" method="get" action="{{ route('cars.index') }}">
            <i class="bi bi-search"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search your listings...">
            <button type="submit">Search</button>
        </form>
        <div class="toolbar-count">
            {{ $cars->count() }} {{ Str::plural('listing', $cars->count()) }}
        </div>
    </div>

    @if($cars->count())

        @php
            // Cars::index() only ever returns the authenticated user's own cars,
            // so currency is constant across every row — resolve it once here
            // rather than touching $car->user->country per row (avoids N+1).
            $currency = optional(auth()->user()->country)->currency_code ?? '';
            $conditionLabels = ['foreign_used' => 'Foreign Used', 'used' => 'Used', 'new' => 'Brand New'];
            $fuelLabels = ['petrol' => 'Petrol', 'diesel' => 'Diesel', 'hybrid' => 'Hybrid', 'electric' => 'Electric'];
        @endphp

        {{-- Table (desktop) --}}
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Price</th>
                        <th>Condition</th>
                        <th>Fuel Type</th>
                        <th>Offers</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="carsTableBody">
                    @foreach($cars as $car)
                        @php $thumb = $car->images->first(); @endphp
                        <tr data-row-id="{{ $car->id }}">
                            <td>
                                <div class="car-cell">
                                    @if($thumb)
                                        <img class="car-thumb" src="{{ asset('storage/'.$thumb->image_path) }}" alt="">
                                    @else
                                        <div class="car-thumb"></div>
                                    @endif
                                    <div>
                                        <div class="name">{{ $car->make }} {{ $car->model }} {{ $car->trim }}</div>
                                        <div class="meta">{{ $car->year }} &middot; {{ number_format($car->mileage) }} mi &middot; Added {{ $car->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">
                                <span class="amount">{{ $currency }} {{ number_format($car->price) }}</span>
                                @if($car->price_type === 'negotiable')
                                    <span class="tag">Negotiable</span>
                                @endif
                            </td>
                            <td>
                                <span class="pill {{ $car->condition === 'new' ? 'condition-new' : '' }}">
                                    {{ $conditionLabels[$car->condition] ?? 'Unknown' }}
                                </span>
                            </td>
                            <td>{{ $fuelLabels[$car->fuel_type] ?? ucfirst($car->fuel_type) }}</td>
                            <td>
                                @php $offersCount = $car->inquiries_count ?? 0; @endphp
                                <span class="offers-count {{ $offersCount > 0 ? 'has-offers' : '' }}">{{ $offersCount }}</span>
                            </td>
                            <td>
                                <div class="status-select-wrap">
                                    {{-- /cars/{car}/status is registered without a route name, so we build the URL directly --}}
                                    <select class="status-select status-{{ $car->status }}"
                                            data-car-id="{{ $car->id }}"
                                            data-current="{{ $car->status }}"
                                            data-url="{{ url('/cars/'.$car->id.'/status') }}"
                                            data-pay-url="{{ route('payments.create', ['car' => $car->id]) }}">
                                        <option value="draft"   @selected($car->status === 'draft')>Draft</option>
                                        <option value="active"  @selected($car->status === 'active')>Active</option>
                                        <option value="paused"  @selected($car->status === 'paused')>Paused</option>
                                        <option value="expired" @selected($car->status === 'expired')>Expired</option>
                                        <option value="sold"    @selected($car->status === 'sold')>Sold</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn" href="{{ route('cars.public.show', ['car' => $car->slug]) }}" title="View public page" target="_blank">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                    <a class="icon-btn" href="{{ route('cars.show', ['car' => $car->id]) }}" title="Views & offers insights">
                                        <i class="bi bi-graph-up"></i>
                                    </a>
                                    <a class="icon-btn" href="{{ route('cars.edit', ['car' => $car->id]) }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a class="icon-btn" href="{{ route('cars.qr', ['car' => $car->id]) }}" title="Download QR sign">
                                        <i class="bi bi-qr-code"></i>
                                    </a>
                                    <button type="button" class="icon-btn danger delete-btn" title="Delete"
                                            data-car-id="{{ $car->id }}"
                                            data-url="{{ route('cars.destroy', ['car' => $car->id]) }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Cards (mobile) --}}
        <div class="car-cards" id="carsCardsList">
            @foreach($cars as $car)
                @php $thumb = $car->images->first(); $offersCount = $car->inquiries_count ?? 0; @endphp
                <div class="car-card" data-row-id="{{ $car->id }}">
                    @if($thumb)
                        <img class="car-thumb" src="{{ asset('storage/'.$thumb->image_path) }}" alt="">
                    @else
                        <div class="car-thumb"></div>
                    @endif
                    <div class="car-card-body">
                        <div class="top">
                            <div>
                                <div class="name">{{ $car->make }} {{ $car->model }} {{ $car->trim }}</div>
                                <div class="meta">{{ $currency }} {{ number_format($car->price) }} @if($car->price_type === 'negotiable') &middot; Negotiable @endif</div>
                            </div>
                            <div class="status-select-wrap">
                                <select class="status-select status-{{ $car->status }}"
                                        data-car-id="{{ $car->id }}"
                                        data-current="{{ $car->status }}"
                                        data-url="{{ url('/cars/'.$car->id.'/status') }}"
                                        data-pay-url="{{ route('payments.create', ['car' => $car->id]) }}">
                                    <option value="draft"   @selected($car->status === 'draft')>Draft</option>
                                    <option value="active"  @selected($car->status === 'active')>Active</option>
                                    <option value="paused"  @selected($car->status === 'paused')>Paused</option>
                                    <option value="expired" @selected($car->status === 'expired')>Expired</option>
                                    <option value="sold"    @selected($car->status === 'sold')>Sold</option>
                                </select>
                            </div>
                        </div>
                        <div class="badges-row">
                            <span class="pill {{ $car->condition === 'new' ? 'condition-new' : '' }}">{{ $conditionLabels[$car->condition] ?? 'Unknown' }}</span>
                            <span class="pill">{{ $fuelLabels[$car->fuel_type] ?? ucfirst($car->fuel_type) }}</span>
                            <span class="pill">{{ $offersCount }} {{ Str::plural('offer', $offersCount) }}</span>
                        </div>
                        <div class="car-card-actions">
                            <a class="icon-btn" href="{{ route('cars.public.show', ['car' => $car->slug]) }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i></a>
                            <a class="icon-btn" href="{{ route('cars.show', ['car' => $car->id]) }}"><i class="bi bi-graph-up"></i></a>
                            <a class="icon-btn" href="{{ route('cars.edit', ['car' => $car->id]) }}"><i class="bi bi-pencil"></i></a>
                            <a class="icon-btn" href="{{ route('cars.qr', ['car' => $car->id]) }}"><i class="bi bi-qr-code"></i></a>
                            <button type="button" class="icon-btn danger delete-btn" data-car-id="{{ $car->id }}" data-url="{{ route('cars.destroy', ['car' => $car->id]) }}"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="empty-state">
            <div class="icon"><i class="bi bi-car-front"></i></div>
            @if(request('search'))
                <h3>No listings match "{{ request('search') }}"</h3>
                <p>Try a different search term, or clear the search to see all your listings.</p>
                <a href="{{ route('cars.index') }}" class="cta-btn" style="background:var(--black);">Clear search</a>
            @else
                <h3>You haven't listed a vehicle yet</h3>
                <p>Add your first car to generate a shareable listing page and start receiving offers.</p>
                <a href="{{ route('cars.create') }}" class="cta-btn"><i class="bi bi-plus-lg"></i> Add Vehicle</a>
            @endif
        </div>
    @endif

</main>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

<div id="toast"></div>

<script>
    // ---------- user dropdown ----------
    const menuBtn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => dropdown.classList.remove('show'));

    // ---------- toast helper ----------
    function showToast(message, isError = false) {
        const box = document.getElementById('toast');
        const item = document.createElement('div');
        item.className = 'toast-item ' + (isError ? 'err' : 'ok');
        item.textContent = message;
        box.appendChild(item);
        setTimeout(() => item.remove(), 4000);
    }

    const csrfToken = '{{ csrf_token() }}';

    // ---------- delete (destroy() returns JSON, not a redirect) ----------
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            if (!confirm('Delete this listing? This cannot be undone.')) return;
            try {
                const res = await fetch(btn.dataset.url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });
                if (res.ok) {
                    document.querySelectorAll(`[data-row-id="${btn.dataset.carId}"]`).forEach(el => el.remove());
                    showToast('Vehicle deleted successfully.');
                } else {
                    showToast('Could not delete this listing.', true);
                }
            } catch (e) {
                showToast('Network error — please try again.', true);
            }
        });
    });

    // ---------- status change (draft -> active can require payment, returns 402) ----------
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', async () => {
            const previous = select.dataset.current;
            const next = select.value;

            try {
                const res = await fetch(select.dataset.url, {
                    method: 'POST', // /cars/{car}/status is registered as POST, not PATCH
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ status: next }),
                });

                if (res.ok) {
                    select.dataset.current = next;
                    select.classList.remove('status-' + previous);
                    select.classList.add('status-' + next);
                    showToast('Listing status updated.');
                } else if (res.status === 402) {
                    // Payment required to move draft -> active — send them to the real payment page
                    select.value = previous;
                    showToast('Redirecting you to payment to activate this listing…', true);
                    window.location = select.dataset.payUrl;
                } else {
                    select.value = previous;
                    showToast('That status change isn\'t allowed.', true);
                }
            } catch (e) {
                select.value = previous;
                showToast('Network error — please try again.', true);
            }
        });
    });

</script>

</body>
</html>