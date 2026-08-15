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

<title>{{ $car->make }} {{ $car->model }} {{ $car->trim }} — Vehicle Details</title>

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

  /* header (shared) */
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

  /* breadcrumb */
  .eyebrow-row{padding:24px 0 0;display:flex;align-items:center;gap:10px;font-size:12px;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-muted);font-weight:600;}
  .eyebrow-row .sep{color:#d3cfc6;}
  .eyebrow-row .current{color:var(--black);}

  /* vehicle header card */
  .vehicle-card{border:1px solid var(--line);border-radius:6px;padding:28px;margin:20px 0 24px;display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap;}
  .vehicle-thumb{width:160px;height:120px;border-radius:6px;object-fit:cover;background:var(--paper);border:1px solid var(--line);flex:none;}
  .vehicle-info{flex:1;min-width:240px;}
  .vehicle-info h1{font-size:clamp(22px,2.6vw,28px);font-weight:800;letter-spacing:-0.02em;display:flex;align-items:center;gap:10px;}
  .copy-btn{background:none;border:none;color:var(--text-muted);font-size:15px;padding:4px;}
  .copy-btn:hover{color:var(--orange-deep);}
  .vehicle-meta{font-size:13.5px;color:var(--text-muted);margin-top:8px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
  .vehicle-meta .amount{color:var(--black);font-weight:700;}

  .status-select-wrap{position:relative;display:inline-block;}
  select.status-select{
    appearance:none;-webkit-appearance:none;font-family:inherit;font-size:12px;font-weight:700;
    padding:6px 26px 6px 12px;border-radius:100px;border:1px solid var(--line);background:var(--paper);color:var(--black);cursor:pointer;
  }
  .status-select-wrap::after{content:"";position:absolute;right:10px;top:50%;width:6px;height:6px;border-right:1.5px solid var(--text-muted);border-bottom:1.5px solid var(--text-muted);transform:translateY(-65%) rotate(45deg);pointer-events:none;}
  select.status-select.status-draft{background:var(--paper);color:var(--text-muted);}
  select.status-select.status-active{background:#eef7ee;color:#2d6a30;border-color:#c9e4c9;}
  select.status-select.status-paused{background:#fff6e9;color:#96660f;border-color:#f0dbb0;}
  select.status-select.status-expired{background:#fdece7;color:#a3320f;border-color:#f3c7b8;}
  select.status-select.status-sold{background:var(--black);color:#fff;border-color:var(--black);}

  .stat-chips{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px;}
  .stat-chip{border:1px solid var(--line);border-radius:4px;padding:10px 16px;background:var(--paper);min-width:90px;}
  .stat-chip .k{font-size:10.5px;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);font-weight:700;margin-bottom:4px;}
  .stat-chip .v{font-size:15px;font-weight:700;letter-spacing:-0.01em;}

  .vehicle-actions{display:flex;gap:8px;flex:none;flex-wrap:wrap;}
  .icon-btn{width:36px;height:36px;border-radius:4px;border:1px solid var(--line);background:#fff;display:flex;align-items:center;justify-content:center;font-size:15px;color:var(--text-muted);transition:all .15s ease;}
  .icon-btn:hover{border-color:var(--orange);color:var(--orange-deep);}

  /* metrics row */
  .metrics-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;}
  @media(max-width:700px){ .metrics-row{grid-template-columns:1fr;} }
  .metric-card{border:1px solid var(--line);border-radius:6px;padding:22px;}
  .metric-card .k{font-size:11.5px;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px;}
  .metric-card .k i{color:var(--orange);}
  .metric-card .v{font-size:30px;font-weight:800;letter-spacing:-0.02em;}
  .metric-card .trend{font-size:12.5px;color:var(--text-muted);margin-top:6px;}

  /* chart card */
  .chart-card{border:1px solid var(--line);border-radius:6px;padding:28px;margin-bottom:48px;}
  .chart-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:8px;flex-wrap:wrap;}
  .section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:6px;}
  .chart-head h2{font-size:18px;font-weight:800;}
  .chart-head p{font-size:13.5px;color:var(--text-muted);margin-top:4px;max-width:52ch;}
  .legend-row{display:flex;gap:18px;flex-wrap:wrap;}
  .legend-item{display:flex;align-items:center;gap:7px;font-size:12.5px;font-weight:600;color:var(--text-muted);}
  .legend-dot{width:9px;height:9px;border-radius:50%;}
  .legend-dot.offers{background:var(--orange);}
  .legend-dot.views{background:var(--black);}
  #performanceChart{margin-top:12px;}

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
        <a href="{{ route('cars.index') }}">My Listings</a><span class="sep">/</span><span class="current">{{ $car->make }} {{ $car->model }} {{ $car->trim }}</span>
    </div>

    @php
        $currency = optional($car->user->country)->currency_code ?? '';
        $thumb = optional($car->images->first())->image_path;
        $conditionLabels = ['foreign_used' => 'Foreign Used', 'used' => 'Used', 'new' => 'Brand New'];
        $fuelLabels = ['petrol' => 'Petrol', 'diesel' => 'Diesel', 'hybrid' => 'Hybrid', 'electric' => 'Electric'];
        $publicUrl = route('cars.public.show', ['car' => $car->slug]);

        $totalViews = collect($viewsData)->sum();
        $totalOffers = collect($offersData)->sum();
        $conversion = $totalViews > 0 ? round(($totalOffers / $totalViews) * 100, 1) : 0;
    @endphp

    {{-- Vehicle header --}}
    <div class="vehicle-card">
        @if($thumb)
            <img class="vehicle-thumb" src="{{ asset('storage/'.$thumb) }}" alt="{{ $car->make }} {{ $car->model }}">
        @else
            <div class="vehicle-thumb"></div>
        @endif

        <div class="vehicle-info">
            <h1>
                {{ $car->make }} {{ $car->model }} {{ $car->trim }}
                <button type="button" class="copy-btn" id="copyLinkBtn" title="Copy listing link">
                    <i class="bi bi-copy"></i>
                </button>
            </h1>
            <span id="publicUrlText" style="display:none;">{{ $publicUrl }}</span>

            <div class="vehicle-meta">
                <div class="status-select-wrap">
                    <select class="status-select status-{{ $car->status }}"
                            id="statusSelect"
                            data-car-id="{{ $car->id }}"
                            data-current="{{ $car->status }}">
                        <option value="draft"   @selected($car->status === 'draft')>Draft</option>
                        <option value="active"  @selected($car->status === 'active')>Active</option>
                        <option value="paused"  @selected($car->status === 'paused')>Paused</option>
                        <option value="expired" @selected($car->status === 'expired')>Expired</option>
                        <option value="sold"    @selected($car->status === 'sold')>Sold</option>
                    </select>
                </div>
                <span>&middot;</span>
                <span class="amount">{{ $currency }} {{ number_format($car->price) }}</span>
                @if($car->price_type === 'negotiable')<span>&middot; Negotiable</span>@endif
                <span>&middot;</span>
                <span>Added {{ $car->created_at->format('M d, Y') }}</span>
            </div>

            <div class="stat-chips">
                <div class="stat-chip"><div class="k">Year Model</div><div class="v">{{ $car->year }}</div></div>
                <div class="stat-chip"><div class="k">Condition</div><div class="v">{{ $conditionLabels[$car->condition] ?? 'Unknown' }}</div></div>
                <div class="stat-chip"><div class="k">Fuel Type</div><div class="v">{{ $fuelLabels[$car->fuel_type] ?? ucfirst($car->fuel_type) }}</div></div>
                <div class="stat-chip"><div class="k">Mileage</div><div class="v">{{ number_format($car->mileage) }} mi</div></div>
            </div>
        </div>

        <div class="vehicle-actions">
            <a class="icon-btn" href="{{ $publicUrl }}" target="_blank" title="View public page"><i class="bi bi-box-arrow-up-right"></i></a>
            <a class="icon-btn" href="{{ route('cars.edit', ['car' => $car->id]) }}" title="Edit listing"><i class="bi bi-pencil"></i></a>
            <a class="icon-btn" href="{{ route('cars.qr', ['car' => $car->id]) }}" title="Download QR sign"><i class="bi bi-qr-code"></i></a>
        </div>
    </div>

    {{-- Summary metrics --}}
    <div class="metrics-row">
        <div class="metric-card">
            <div class="k"><i class="bi bi-eye"></i> Total Views</div>
            <div class="v">{{ number_format($totalViews) }}</div>
            <div class="trend">Across the last {{ count($monthLabels) }} months</div>
        </div>
        <div class="metric-card">
            <div class="k"><i class="bi bi-envelope-paper"></i> Total Offers</div>
            <div class="v">{{ number_format($totalOffers) }}</div>
            <div class="trend">Inquiries submitted on this listing</div>
        </div>
        <div class="metric-card">
            <div class="k"><i class="bi bi-graph-up-arrow"></i> Conversion Rate</div>
            <div class="v">{{ $conversion }}%</div>
            <div class="trend">Views that turned into an offer</div>
        </div>
    </div>

    {{-- Performance chart --}}
    <div class="chart-card">
        <div class="chart-head">
            <div>
                <div class="section-title">Statistics</div>
                <h2>Listing Performance</h2>
                <p>Track how your car listing is performing over time, including total views and offers received.</p>
            </div>
            <div class="legend-row">
                <span class="legend-item"><span class="legend-dot offers"></span>Offers & Inquiries</span>
                <span class="legend-item"><span class="legend-dot views"></span>Page Views</span>
            </div>
        </div>
        <div id="performanceChart"></div>
    </div>

</main>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3"></script>
<script>
    // ---------- user dropdown ----------
    const menuBtn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => dropdown.classList.remove('show'));

    const csrfToken = "{{ csrf_token() }}";

    // ---------- copy public listing link ----------
    document.getElementById('copyLinkBtn').addEventListener('click', () => {
        const url = document.getElementById('publicUrlText').textContent.trim();
        navigator.clipboard.writeText(url)
            .then(() => Swal.fire({ icon: 'success', title: 'Copied', text: 'Listing link copied to clipboard.', timer: 1800, showConfirmButton: false }))
            .catch(() => Swal.fire({ icon: 'error', title: 'Error', text: 'Could not copy the link.' }));
    });

    // ---------- activate / deactivate / reactivate / setStatus (same pattern as cars/index) ----------
    function activate(carId, selectEl){
        $.ajax({
            url: `/cars/${carId}/pay`,
            type: 'POST',
            data: { _token: csrfToken },
            success: function(res){
                if (res.authorization_url) {
                    window.location.href = res.authorization_url;
                } else if (res.message) {
                    Swal.fire({ icon: 'success', title: 'Success', text: res.message, timer: 2000, showConfirmButton: false });
                    setTimeout(() => location.reload(), 2000);
                }
            },
            error: function (xhr){
                if (selectEl) selectEl.value = selectEl.dataset.current;
                Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'An error occurred' });
            }
        });
    }

    function deactivate(carId, selectEl){
        $.ajax({
            url: `/cars/${carId}/status`,
            type: 'POST',
            data: { _token: csrfToken, status: 'paused' },
            success: function(res){
                Swal.fire({ icon: 'success', title: 'Success', text: res.message || 'Car Page Status Updated' });
                location.reload();
            },
            error: function (xhr){
                if (selectEl) selectEl.value = selectEl.dataset.current;
                Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'An error occurred' });
            }
        });
    }

    function reactivate(carId, selectEl){
        $.ajax({
            url: `/cars/${carId}/status`,
            type: 'POST',
            data: { _token: csrfToken, status: 'active' },
            success: function(res){
                Swal.fire({ icon: 'success', title: 'Success', text: res.message || 'Car Page Status Updated' });
                location.reload();
            },
            error: function (xhr){
                if (selectEl) selectEl.value = selectEl.dataset.current;
                Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'An error occurred' });
            }
        });
    }

    // Fallback for any transition not covered above (e.g. -> Expired, -> Sold)
    function setStatus(carId, status, selectEl){
        $.ajax({
            url: `/cars/${carId}/status`,
            type: 'POST',
            data: { _token: csrfToken, status: status },
            success: function(res){
                Swal.fire({ icon: 'success', title: 'Success', text: res.message || 'Car Page Status Updated' });
                location.reload();
            },
            error: function (xhr){
                if (selectEl) selectEl.value = selectEl.dataset.current;
                Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'An error occurred' });
            }
        });
    }

    $(document).on('change', '#statusSelect', function () {
        const carId = $(this).data('car-id');
        const previous = $(this).data('current');
        const next = this.value;
        const selectEl = this;

        if (previous === 'draft' && next === 'active') {
            activate(carId, selectEl);
        } else if (next === 'paused') {
            deactivate(carId, selectEl);
        } else if (previous === 'paused' && next === 'active') {
            reactivate(carId, selectEl);
        } else {
            setStatus(carId, next, selectEl);
        }
    });

    // ---------- performance chart ----------
    const offersData = @json($offersData);
    const viewsData  = @json($viewsData);
    const monthLabels = @json($monthLabels);

    const chart = new ApexCharts(document.querySelector("#performanceChart"), {
        series: [
            { name: 'Offers & Inquiries', data: offersData },
            { name: 'Page Views', data: viewsData },
        ],
        chart: {
            height: 320,
            type: 'line',
            toolbar: { show: false },
            zoom: { enabled: false },
            fontFamily: 'Inter, system-ui, sans-serif',
        },
        colors: ['#ff5a1f', '#0d0d0d'],
        dataLabels: { enabled: false },
        stroke: { width: [3, 2], curve: 'smooth', dashArray: [0, 4] },
        markers: { size: 0, hover: { sizeOffset: 4 } },
        grid: { borderColor: '#e7e4dd', strokeDashArray: 3 },
        legend: { show: false },
        xaxis: {
            categories: monthLabels,
            labels: { style: { colors: '#6b6862', fontSize: '12px' } },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: {
            labels: { style: { colors: '#6b6862', fontSize: '12px' } },
        },
        tooltip: { theme: 'light' },
    });
    chart.render();
</script>

</body>
</html>