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

<title>Dashboard — Motosheet</title>

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

  /* alerts */
  .alert{border-radius:var(--radius);padding:14px 16px;font-size:13.5px;margin:24px 0 0;font-weight:500;}
  .alert-success{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}

  /* page head */
  .page-head{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;padding:40px 0 28px;flex-wrap:wrap;}
  .page-head .eyebrow{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:10px;}
  .page-head h1{font-size:clamp(26px,3.2vw,36px);font-weight:800;letter-spacing:-0.02em;}
  .page-head .sub{font-size:14.5px;color:var(--text-muted);margin-top:6px;}
  .cta-btn{display:inline-flex;align-items:center;gap:8px;background:var(--orange);color:#fff;font-weight:700;font-size:14px;padding:12px 20px;border-radius:var(--radius);border:none;white-space:nowrap;transition:background .2s ease;}
  .cta-btn:hover{background:var(--orange-deep);}

  /* metrics */
  .metrics-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
  @media(max-width:900px){ .metrics-row{grid-template-columns:repeat(2,1fr);} }
  @media(max-width:480px){ .metrics-row{grid-template-columns:1fr;} }
  .metric-card{border:1px solid var(--line);border-radius:6px;padding:22px;}
  .metric-card .k{font-size:11.5px;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px;}
  .metric-card .k i{color:var(--orange);}
  .metric-card .v{font-size:30px;font-weight:800;letter-spacing:-0.02em;}
  .metric-card .trend{font-size:12.5px;color:var(--text-muted);margin-top:6px;}

  /* chart */
  .chart-card{border:1px solid var(--line);border-radius:6px;padding:28px;margin-bottom:24px;}
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

  /* two-column: recent offers + top listings */
  .split-row{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:48px;align-items:start;}
  @media(max-width:900px){ .split-row{grid-template-columns:1fr;} }
  .panel-card{border:1px solid var(--line);border-radius:6px;overflow:hidden;}
  .panel-head{display:flex;justify-content:space-between;align-items:center;padding:20px 22px;border-bottom:1px solid var(--line);}
  .panel-head h2{font-size:15.5px;font-weight:800;}
  .panel-head a{font-size:12.5px;font-weight:700;color:var(--orange-deep);}
  .panel-head a:hover{color:var(--black);}

  .offer-row{display:flex;align-items:center;gap:14px;padding:16px 22px;border-bottom:1px solid var(--line);}
  .offer-row:last-child{border-bottom:none;}
  .offer-avatar{width:38px;height:38px;border-radius:50%;background:var(--paper);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12.5px;color:var(--orange-deep);flex:none;}
  .offer-body{flex:1;min-width:0;}
  .offer-body .name{font-size:13.5px;font-weight:700;}
  .offer-body .car-name{font-size:12.5px;color:var(--text-muted);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
  .offer-amount{text-align:right;flex:none;}
  .offer-amount .amt{font-size:13.5px;font-weight:800;}
  .offer-amount .time{font-size:11.5px;color:var(--text-muted);margin-top:2px;}

  .listing-row{display:flex;align-items:center;gap:14px;padding:14px 22px;border-bottom:1px solid var(--line);}
  .listing-row:last-child{border-bottom:none;}
  .listing-thumb{width:56px;height:42px;border-radius:4px;object-fit:cover;background:var(--paper);border:1px solid var(--line);flex:none;}
  .listing-body{flex:1;min-width:0;}
  .listing-body .name{font-size:13.5px;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
  .listing-body .meta{font-size:12px;color:var(--text-muted);margin-top:2px;}
  .listing-stats{display:flex;gap:14px;flex:none;}
  .listing-stat{text-align:center;}
  .listing-stat .v{font-size:13.5px;font-weight:800;}
  .listing-stat .k{font-size:10px;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);}

  .pill{display:inline-flex;align-items:center;gap:6px;font-size:11px;font-weight:700;padding:4px 10px;border-radius:100px;}
  .pill.status-draft{background:var(--paper);color:var(--text-muted);}
  .pill.status-active{background:#eef7ee;color:#2d6a30;}
  .pill.status-paused{background:#fff6e9;color:#96660f;}
  .pill.status-expired{background:#fdece7;color:#a3320f;}
  .pill.status-sold{background:var(--black);color:#fff;}

  .empty-panel{padding:40px 22px;text-align:center;}
  .empty-panel .icon{width:44px;height:44px;border-radius:50%;background:var(--paper);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--orange);font-size:18px;}
  .empty-panel p{font-size:13.5px;color:var(--text-muted);}

  /* first-time empty state */
  .empty-state{text-align:center;padding:80px 24px;border:1px dashed var(--line);border-radius:6px;margin-bottom:60px;}
  .empty-state .icon{width:56px;height:56px;border-radius:50%;background:var(--paper);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;color:var(--orange);font-size:22px;}
  .empty-state h3{font-size:19px;font-weight:800;margin-bottom:8px;}
  .empty-state p{font-size:14.5px;color:var(--text-muted);margin-bottom:22px;max-width:38ch;margin-left:auto;margin-right:auto;}

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
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('cars.index') }}">My Listings</a>
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

    {{--
        Assumed data contract from DashboardController@index — adjust the variable
        names below to match your controller if they differ:

        $totalListings, $activeListings, $totalViews, $totalOffers   (integers)
        $recentOffers   (latest Inquiry records, eager-loaded with `car`)
        $topListings    (Car records eager-loaded with `images`, ideally withCount views/offers)
        $months, $viewsData, $offersData, $monthLabels                (account-wide, same shape as cars.show)
    --}}

    <div class="page-head">
        <div>
            <div class="eyebrow">Overview</div>
            <h1>Welcome back, {{ explode(' ', auth()->user()->name ?? 'there')[0] }}</h1>
            <p class="sub">Here's how your listings are performing.</p>
        </div>
        <a href="{{ route('cars.create') }}" class="cta-btn">
            <i class="bi bi-plus-lg"></i> Add Vehicle
        </a>
    </div>

    @if(($totalListings ?? 0) === 0)

        <div class="empty-state">
            <div class="icon"><i class="bi bi-car-front"></i></div>
            <h3>Let's get your first listing live</h3>
            <p>Add a vehicle to generate a shareable listing page, start tracking views, and receive offers.</p>
            <a href="{{ route('cars.create') }}" class="cta-btn"><i class="bi bi-plus-lg"></i> Add Vehicle</a>
        </div>

    @else

        {{-- Summary metrics --}}
        <div class="metrics-row">
            <div class="metric-card">
                <div class="k"><i class="bi bi-car-front"></i> Total Listings</div>
                <div class="v">{{ $totalListings ?? 0 }}</div>
                <div class="trend">{{ $activeListings ?? 0 }} currently active</div>
            </div>
            <div class="metric-card">
                <div class="k"><i class="bi bi-broadcast"></i> Active Listings</div>
                <div class="v">{{ $activeListings ?? 0 }}</div>
                <div class="trend">Live and visible to buyers</div>
            </div>
            <div class="metric-card">
                <div class="k"><i class="bi bi-eye"></i> Total Views</div>
                <div class="v">{{ number_format($totalViews ?? 0) }}</div>
                <div class="trend">Across all your listings</div>
            </div>
            <div class="metric-card">
                <div class="k"><i class="bi bi-envelope-paper"></i> Total Offers</div>
                <div class="v">{{ number_format($totalOffers ?? 0) }}</div>
                <div class="trend">Inquiries received to date</div>
            </div>
        </div>

        {{-- Account performance chart --}}
        @if(isset($monthLabels))
            <div class="chart-card">
                <div class="chart-head">
                    <div>
                        <div class="section-title">Statistics</div>
                        <h2>Account Performance</h2>
                        <p>Views and offers across every listing you've published, over the last {{ count($monthLabels) }} months.</p>
                    </div>
                    <div class="legend-row">
                        <span class="legend-item"><span class="legend-dot offers"></span>Offers & Inquiries</span>
                        <span class="legend-item"><span class="legend-dot views"></span>Page Views</span>
                    </div>
                </div>
                <div id="performanceChart"></div>
            </div>
        @endif

        {{-- Recent offers + top listings --}}
        <div class="split-row">

            <div class="panel-card">
                <div class="panel-head">
                    <h2>Recent Offers</h2>
                    <a href="{{ route('offers.index') }}">View all</a>
                </div>

                @forelse(($recentOffers ?? []) as $offer)
                    @php $offerCurrency = optional(optional($offer->car)->user->country)->currency_code ?? ''; @endphp
                    <a href="{{ $offer->car ? route('cars.show', ['car' => $offer->car->id]) : '#' }}" style="display:contents;">
                        <div class="offer-row">
                            <div class="offer-avatar">{{ strtoupper(substr($offer->name ?? 'U', 0, 1)) }}</div>
                            <div class="offer-body">
                                <div class="name">{{ $offer->name ?? 'Unknown buyer' }}</div>
                                <div class="car-name">{{ optional($offer->car)->make }} {{ optional($offer->car)->model }} {{ optional($offer->car)->trim }}</div>
                            </div>
                            <div class="offer-amount">
                                <div class="amt">{{ $offerCurrency }} {{ number_format($offer->offer ?? 0) }}</div>
                                <div class="time">{{ $offer->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="empty-panel">
                        <div class="icon"><i class="bi bi-envelope-paper"></i></div>
                        <p>No offers yet — they'll show up here as buyers reach out.</p>
                    </div>
                @endforelse
            </div>

            <div class="panel-card">
                <div class="panel-head">
                    <h2>Top Listings</h2>
                    <a href="{{ route('cars.index') }}">View all</a>
                </div>

                @forelse(($topListings ?? []) as $listing)
                    @php $listingThumb = optional($listing->images->first())->image_path; @endphp
                    <a href="{{ route('cars.show', ['car' => $listing->id]) }}" style="display:contents;">
                        <div class="listing-row">
                            @if($listingThumb)
                                <img class="listing-thumb" src="{{ asset('storage/'.$listingThumb) }}" alt="">
                            @else
                                <div class="listing-thumb"></div>
                            @endif
                            <div class="listing-body">
                                <div class="name">{{ $listing->make }} {{ $listing->model }} {{ $listing->trim }}</div>
                                <div class="meta"><span class="pill status-{{ $listing->status }}">{{ ucfirst($listing->status) }}</span></div>
                            </div>
                            <div class="listing-stats">
                                <div class="listing-stat">
                                    <div class="v">{{ $listing->views_count ?? 0 }}</div>
                                    <div class="k">Views</div>
                                </div>
                                <div class="listing-stat">
                                    <div class="v">{{ $listing->inquiries_count ?? 0 }}</div>
                                    <div class="k">Offers</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="empty-panel">
                        <div class="icon"><i class="bi bi-car-front"></i></div>
                        <p>Your listings will be ranked here once they start getting views.</p>
                    </div>
                @endforelse
            </div>

        </div>

    @endif

</main>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

@if(($totalListings ?? 0) > 0 && isset($monthLabels))
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3"></script>
@endif
<script>
    // ---------- user dropdown ----------
    const menuBtn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => dropdown.classList.remove('show'));

    @if(($totalListings ?? 0) > 0 && isset($monthLabels))
    // ---------- account performance chart ----------
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
    @endif
</script>

</body>
</html>