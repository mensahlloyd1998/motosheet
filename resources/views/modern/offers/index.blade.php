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

<title>Offers — Motosheet</title>

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
  .wrap{max-width:1280px; margin:0 auto;padding:0 32px;}
  @media(min-width:1280px){
    .wrap{min-width:1240px;}
  }

  /* header (shared) */
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
  .user-dropdown{position:absolute;top:calc(100% + 10px);right:0;background:#fff;border:1px solid var(--line);border-radius:6px;min-width:180px;box-shadow:0 8px 24px rgba(13,13,13,0.08);display:none;overflow:hidden;}
  .user-dropdown.show{display:block;}
  .user-dropdown a, .user-dropdown button{display:flex;align-items:center;gap:10px;width:100%;padding:12px 16px;font-size:13.5px;font-weight:500;text-align:left;background:none;border:none;color:var(--black);}
  .user-dropdown a:hover, .user-dropdown button:hover{background:var(--paper);}
  .user-dropdown form{margin:0;}
  .user-dropdown hr{border:none;border-top:1px solid var(--line);}

  /* alerts */
  .alert{border-radius:var(--radius);padding:14px 16px;font-size:13.5px;margin:24px 0 0;font-weight:500;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  .alert-success{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}

  /* page head */
  .page-head{padding:40px 0 28px;}
  .page-head .eyebrow{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:10px;}
  .page-head h1{font-size:clamp(26px,3.2vw,36px);font-weight:800;letter-spacing:-0.02em;}
  .page-head .sub{font-size:14.5px;color:var(--text-muted);margin-top:6px;}

  /* toolbar */
  .toolbar{display:flex;justify-content:space-between;align-items:center;gap:16px;padding-bottom:24px;flex-wrap:wrap;}
  .search-form{position:relative;flex:1;min-width:220px;max-width:360px;}
  .search-form input{width:100%;border:1px solid var(--line);border-radius:100px;padding:11px 16px 11px 40px;font-size:14px;font-family:inherit;background:var(--paper);transition:border-color .2s ease, background .2s ease;}
  .search-form input:focus{border-color:var(--orange);outline:none;background:#fff;}
  .search-form i{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:14px;}
  .search-form button{position:absolute;right:6px;top:50%;transform:translateY(-50%);background:var(--black);color:#fff;border:none;border-radius:100px;padding:6px 14px;font-size:12.5px;font-weight:600;}
  .search-form button:hover{background:var(--orange-deep);}
  .toolbar-count{font-size:13.5px;color:var(--text-muted);white-space:nowrap;}

  /* table */
  .table-wrap{border:1px solid var(--line);border-radius:6px;overflow:hidden;margin-bottom:40px;}
  table{width:100%;border-collapse:collapse;}
  thead th{text-align:left;font-size:11.5px;text-transform:uppercase;letter-spacing:0.08em;font-weight:700;color:var(--text-muted);background:var(--paper);padding:14px 20px;border-bottom:1px solid var(--line);}
  tbody td{padding:16px 20px;border-bottom:1px solid var(--line);font-size:14.5px;vertical-align:top;}
  tbody tr:last-child td{border-bottom:none;}
  tbody tr:hover{background:#fcfbf9;}

  .buyer-cell .name{font-weight:700;font-size:14.5px;}
  .buyer-cell .time{font-size:12.5px;color:var(--text-muted);margin-top:2px;}

  .contact-links{display:flex;flex-direction:column;gap:5px;}
  .contact-links a{display:inline-flex;align-items:center;gap:7px;font-size:13px;color:var(--text-muted);}
  .contact-links a:hover{color:var(--orange-deep);}
  .contact-links i{width:14px;text-align:center;color:var(--orange);}

  .vehicle-cell{display:flex;align-items:center;gap:12px;}
  .vehicle-thumb{width:56px;height:42px;border-radius:4px;object-fit:cover;background:var(--paper);border:1px solid var(--line);flex:none;}
  .vehicle-cell .name{font-weight:700;font-size:13.5px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
  .vehicle-cell .asking{font-size:12px;color:var(--text-muted);margin-top:2px;}

  .offer-cell .amount{font-weight:800;font-size:15px;}
  .offer-tag{display:inline-block;margin-top:5px;font-size:11px;font-weight:700;padding:3px 9px;border-radius:100px;}
  .offer-tag.high{background:#eef7ee;color:#2d6a30;}
  .offer-tag.mid{background:#fff6e9;color:#96660f;}
  .offer-tag.low{background:#fdece7;color:#a3320f;}

  .message-cell{max-width:260px;font-size:13.5px;color:#2c2a27;line-height:1.5;}
  .message-cell .empty{color:#b3afa6;font-style:italic;}

  .row-actions{display:flex;gap:6px;justify-content:flex-end;}
  .icon-btn{width:32px;height:32px;border-radius:4px;border:1px solid var(--line);background:#fff;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--text-muted);transition:all .15s ease;}
  .icon-btn:hover{border-color:var(--orange);color:var(--orange-deep);}

  /* mobile cards */
  .offer-cards{display:none;flex-direction:column;gap:14px;margin-bottom:40px;}
  .offer-card{border:1px solid var(--line);border-radius:6px;padding:16px;}
  .offer-card-top{display:flex;justify-content:space-between;align-items:flex-start;gap:10px;}
  .offer-card .buyer-name{font-weight:700;font-size:14.5px;}
  .offer-card .time{font-size:12px;color:var(--text-muted);margin-top:2px;}
  .offer-card .amount{font-weight:800;font-size:16px;text-align:right;}
  .offer-card-vehicle{display:flex;align-items:center;gap:10px;margin:12px 0;padding:10px;background:var(--paper);border-radius:4px;}
  .offer-card-vehicle img{width:48px;height:36px;border-radius:3px;object-fit:cover;flex:none;}
  .offer-card-vehicle .name{font-size:13px;font-weight:700;}
  .offer-card-message{font-size:13.5px;color:#2c2a27;line-height:1.5;margin-bottom:12px;}
  .offer-card-actions{display:flex;gap:8px;flex-wrap:wrap;}
  .offer-card-actions a{display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:600;border:1px solid var(--line);border-radius:100px;padding:7px 13px;color:var(--text-muted);}
  .offer-card-actions a:hover{border-color:var(--orange);color:var(--orange-deep);}

  @media(max-width:820px){
    .table-wrap{display:none;}
    .offer-cards{display:flex;}
  }

  /* empty state */
  .empty-state{text-align:center;padding:80px 24px;border:1px dashed var(--line);border-radius:6px;}
  .empty-state .icon{width:56px;height:56px;border-radius:50%;background:var(--paper);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;color:var(--orange);font-size:22px;}
  .empty-state h3{font-size:19px;font-weight:800;margin-bottom:8px;}
  .empty-state p{font-size:14.5px;color:var(--text-muted);margin-bottom:22px;max-width:38ch;margin-left:auto;margin-right:auto;}
  .cta-btn{display:inline-flex;align-items:center;gap:8px;background:var(--orange);color:#fff;font-weight:700;font-size:14px;padding:12px 20px;border-radius:var(--radius);border:none;white-space:nowrap;transition:background .2s ease;}
  .cta-btn:hover{background:var(--orange-deep);}

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
            <a href="{{ route('cars.index') }}">My Listings</a>
            <a href="{{ route('offers.index') }}" class="active">Offers</a>
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
        <div class="eyebrow">Offers</div>
        <h1>All Offers</h1>
        <p class="sub">Every offer submitted across your listings, most recent first.</p>
    </div>

    <div class="toolbar">
        {{-- Controller filters the fetched collection on the car's title --}}
        <form class="search-form" method="get" action="{{ route('offers.index') }}">
            <i class="bi bi-search"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by vehicle...">
            <button type="submit">Search</button>
        </form>
        <div class="toolbar-count">
            {{ $offers->count() }} {{ Str::plural('offer', $offers->count()) }}
        </div>
    </div>

    @if($offers->count())

        @php
            // All offers here belong to the authenticated user's own cars,
            // so currency is constant — resolve it once instead of per row
            // (the controller only eager-loads `car`, not `car.user.country`).
            $currency = optional(auth()->user()->country)->currency_code ?? '';

            $offerTagClass = function ($offer) {
                if (!$offer->car || !$offer->car->price || $offer->car->price == 0) return 'mid';
                $ratio = $offer->offer_price / $offer->car->price;
                if ($ratio >= 0.95) return 'high';
                if ($ratio >= 0.85) return 'mid';
                return 'low';
            };
            $offerTagText = function ($offer) {
                if (!$offer->car || !$offer->car->price || $offer->car->price == 0) return null;
                $diff = round((($offer->offer_price - $offer->car->price) / $offer->car->price) * 100);
                if ($diff >= 0) return 'At or above asking';
                return abs($diff).'% below asking';
            };
        @endphp

        {{-- Table (desktop) --}}
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Buyer</th>
                        <th>Contact</th>
                        <th>Vehicle</th>
                        <th>Offer</th>
                        <th>Message</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                        @php $thumb = optional(optional($offer->car)->images->first())->image_path ?? null; @endphp
                        <tr>
                            <td class="buyer-cell">
                                <div class="name">{{ $offer->name }}</div>
                                <div class="time">{{ $offer->created_at->diffForHumans() }}</div>
                            </td>
                            <td>
                                <div class="contact-links">
                                    <a href="tel:{{ $offer->phone }}"><i class="bi bi-telephone"></i> {{ $offer->phone }}</a>
                                    @if($offer->email)
                                        <a href="mailto:{{ $offer->email }}"><i class="bi bi-envelope"></i> {{ $offer->email }}</a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($offer->car)
                                    <a href="{{ route('cars.show', ['car' => $offer->car->id]) }}" class="vehicle-cell" style="text-decoration:none;color:inherit;">
                                        @if($thumb)
                                            <img class="vehicle-thumb" src="{{ asset('storage/'.$thumb) }}" alt="">
                                        @else
                                            <div class="vehicle-thumb"></div>
                                        @endif
                                        <div>
                                            <div class="name">{{ $offer->car->make }} {{ $offer->car->model }} {{ $offer->car->trim }}</div>
                                            <div class="asking">Asking {{ $currency }} {{ number_format($offer->car->price) }}</div>
                                        </div>
                                    </a>
                                @else
                                    <span class="text-muted" style="color:var(--text-muted);font-size:13px;">Listing removed</span>
                                @endif
                            </td>
                            <td class="offer-cell">
                                <div class="amount">{{ $currency }} {{ number_format($offer->offer_price) }}</div>
                                @if($offerTagText($offer))
                                    <span class="offer-tag {{ $offerTagClass($offer) }}">{{ $offerTagText($offer) }}</span>
                                @endif
                            </td>
                            <td class="message-cell">
                                @if($offer->message)
                                    {{ Str::limit($offer->message, 90) }}
                                @else
                                    <span class="empty">No message</span>
                                @endif
                            </td>
                            <td>
                                <div class="row-actions">
                                    @if($offer->car)
                                        <a class="icon-btn" href="{{ route('cars.public.show', ['car' => $offer->car->slug]) }}" target="_blank" title="View public listing">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </a>
                                        <a class="icon-btn" href="{{ route('cars.show', ['car' => $offer->car->id]) }}" title="View listing insights">
                                            <i class="bi bi-graph-up"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Cards (mobile) --}}
        <div class="offer-cards">
            @foreach($offers as $offer)
                @php $thumb = optional(optional($offer->car)->images->first())->image_path ?? null; @endphp
                <div class="offer-card">
                    <div class="offer-card-top">
                        <div>
                            <div class="buyer-name">{{ $offer->name }}</div>
                            <div class="time">{{ $offer->created_at->diffForHumans() }}</div>
                        </div>
                        <div>
                            <div class="amount">{{ $currency }} {{ number_format($offer->offer_price) }}</div>
                            @if($offerTagText($offer))
                                <span class="offer-tag {{ $offerTagClass($offer) }}">{{ $offerTagText($offer) }}</span>
                            @endif
                        </div>
                    </div>

                    @if($offer->car)
                        <a href="{{ route('cars.show', ['car' => $offer->car->id]) }}" style="text-decoration:none;color:inherit;">
                            <div class="offer-card-vehicle">
                                @if($thumb)
                                    <img src="{{ asset('storage/'.$thumb) }}" alt="">
                                @else
                                    <div style="width:48px;height:36px;border-radius:3px;background:var(--line);flex:none;"></div>
                                @endif
                                <div>
                                    <div class="name">{{ $offer->car->make }} {{ $offer->car->model }} {{ $offer->car->trim }}</div>
                                    <div class="time">Asking {{ $currency }} {{ number_format($offer->car->price) }}</div>
                                </div>
                            </div>
                        </a>
                    @endif

                    <div class="offer-card-message">
                        @if($offer->message)
                            {{ Str::limit($offer->message, 140) }}
                        @else
                            <span class="empty" style="color:#b3afa6;font-style:italic;">No message</span>
                        @endif
                    </div>

                    <div class="offer-card-actions">
                        <a href="tel:{{ $offer->phone }}"><i class="bi bi-telephone"></i> Call</a>
                        @if($offer->email)
                            <a href="mailto:{{ $offer->email }}"><i class="bi bi-envelope"></i> Email</a>
                        @endif
                        @if($offer->car)
                            <a href="{{ route('cars.public.show', ['car' => $offer->car->slug]) }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Listing</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="empty-state">
            <div class="icon"><i class="bi bi-envelope-paper"></i></div>
            @if(request('search'))
                <h3>No offers match "{{ request('search') }}"</h3>
                <p>Try a different search term, or clear the search to see all your offers.</p>
                <a href="{{ route('offers.index') }}" class="cta-btn" style="background:var(--black);">Clear search</a>
            @else
                <h3>No offers yet</h3>
                <p>Offers submitted on your listings will show up here as soon as buyers reach out.</p>
                <a href="{{ route('cars.index') }}" class="cta-btn"><i class="bi bi-car-front"></i> View My Listings</a>
            @endif
        </div>
    @endif

</main>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

<script>
    const menuBtn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => dropdown.classList.remove('show'));
</script>

</body>
</html>