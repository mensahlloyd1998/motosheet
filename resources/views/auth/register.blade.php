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

<title>Register — Motosheet</title>

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

  /* header */
  header{border-bottom:1px solid var(--line);}
  .nav{display:flex;align-items:center;justify-content:space-between;padding:18px 32px;max-width:1240px;margin:0 auto;}
  .made-with{font-size:12px;color:var(--text-muted);}
  .nav img.brand{height:26px;width:auto;}
  .nav-aside{font-size:13px;color:var(--text-muted);}
  .nav-aside a{color:var(--orange-deep);font-weight:700;}

  /* alerts */
  .alert{border-radius:var(--radius);padding:14px 16px;font-size:13.5px;margin-bottom:20px;font-weight:500;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  .alert-success{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}

  /* split layout */
  .split{flex:1;display:grid;grid-template-columns:1fr 1fr;}
  @media(max-width:900px){ .split{grid-template-columns:1fr;} .brand-panel{display:none;} }

  /* left brand panel (reuses spec-plate dark motif) */
  .brand-panel{
    background:var(--black);color:#fff;
    padding:64px 56px;display:flex;flex-direction:column;justify-content:space-between;
  }
  .brand-panel .eyebrow{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange);margin-bottom:20px;}
  .brand-panel h1{font-size:clamp(28px,2.6vw,38px);font-weight:800;letter-spacing:-0.02em;line-height:1.15;max-width:15ch;margin-bottom:20px;}
  .brand-panel p.lead{font-size:15.5px;color:#c7c5c0;max-width:38ch;line-height:1.7;}

  .brand-points{list-style:none;margin-top:40px;display:flex;flex-direction:column;gap:16px;}
  .brand-points li{display:flex;align-items:flex-start;gap:12px;font-size:14.5px;color:#e6e4e0;}
  .brand-points .check{flex:none;width:20px;height:20px;border-radius:50%;background:#1b1a18;border:1px solid var(--orange);display:flex;align-items:center;justify-content:center;margin-top:1px;}
  .brand-points .check svg{width:11px;height:11px;}

  .plate-grid{display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid #2a2a28;border-left:1px solid #2a2a28;margin-top:48px;}
  .plate-cell{border-right:1px solid #2a2a28;border-bottom:1px solid #2a2a28;padding:18px 16px;}
  .plate-cell .k{font-size:10.5px;text-transform:uppercase;letter-spacing:0.09em;color:#8c8a86;font-weight:600;margin-bottom:8px;}
  .plate-cell .v{font-size:19px;font-weight:800;letter-spacing:-0.01em;color:var(--orange);}

  /* right form panel */
  .form-panel{display:flex;align-items:center;justify-content:center;padding:56px 32px;}
  .form-card{width:100%;max-width:380px;}
  .form-card .section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:10px;}
  .form-card h2{font-size:28px;font-weight:800;letter-spacing:-0.02em;margin-bottom:8px;}
  .form-card .sub{font-size:14.5px;color:var(--text-muted);margin-bottom:32px;}

  .field{margin-bottom:18px;}
  .field label{display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);margin-bottom:7px;}
  .field input, .field select{width:100%;border:1px solid var(--line);border-radius:var(--radius);padding:13px 14px;font-size:15px;font-family:inherit;background:#fff;transition:border-color .2s ease;}
  .field input:focus, .field select:focus{border-color:var(--orange);outline:none;}
  .field small.text-danger{display:block;color:#c0391a;font-size:12px;margin-top:6px;}

  .field-row{display:flex;align-items:center;justify-content:space-between;margin:-4px 0 22px;}
  .remember{display:flex;align-items:center;gap:8px;font-size:13.5px;color:var(--text-muted);}
  .remember input{width:15px;height:15px;accent-color:var(--orange);}
  .forgot-link{font-size:13.5px;font-weight:600;color:var(--orange-deep);}
  .forgot-link:hover{color:var(--black);}

  .submit-btn{width:100%;background:var(--orange);color:#fff;font-weight:700;font-size:15px;padding:15px;border:none;border-radius:var(--radius);transition:background .2s ease, transform .15s ease;}
  .submit-btn:hover{background:var(--orange-deep);transform:translateY(-1px);}

  .divider{display:flex;align-items:center;gap:14px;margin:28px 0;color:var(--text-muted);font-size:12px;text-transform:uppercase;letter-spacing:0.08em;}
  .divider::before,.divider::after{content:"";flex:1;height:1px;background:var(--line);}

  .signup-note{text-align:center;font-size:14px;color:var(--text-muted);}
  .signup-note a{font-weight:700;color:var(--orange-deep);}
  .signup-note a:hover{color:var(--black);}

  footer{border-top:1px solid var(--line);padding:20px 32px;text-align:center;font-size:12.5px;color:var(--text-muted);}
</style>
</head>
<body>

<header>
    <div class="nav">
        <a href="/">
          <img src="{{ asset('system_img/motosheet-logo.png') }}" class="brand" alt="Motosheet logo">
        </a>
        <div class="nav-aside">
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</header>

<div class="split">

    {{-- Left: brand panel --}}
    <div class="brand-panel">
        <div>
            <div class="eyebrow">Motosheet Dashboard</div>
            <h1>List your car. Field real offers.</h1>
            <p class="lead">Manage your listings, upload photos, and respond to buyer offers — all from one dashboard.</p>

            <ul class="brand-points">
                <li>
                    <span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>
                    Publish a beautiful single-page listing in minutes
                </li>
                <li>
                    <span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>
                    Share a link or QR sign — no app required for buyers
                </li>
                <li>
                    <span class="check"><svg viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="3"><path d="M4 12l5 5L20 6"/></svg></span>
                    Track and respond to every offer in one place
                </li>
            </ul>
        </div>

        <div class="plate-grid">
            <div class="plate-cell"><div class="k">Listings live</div><div class="v">12,400+</div></div>
            <div class="plate-cell"><div class="k">Avg. time to offer</div><div class="v">36 hrs</div></div>
            <div class="plate-cell"><div class="k">Countries</div><div class="v">14</div></div>
        </div>
    </div>

    {{-- Right: login form --}}
    <div class="form-panel">
        <div class="form-card">

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- <div class="section-title">Dashboard Access</div> -->
            <h2>Register</h2>
            <p class="sub">Enter your details to create an account.</p>

            <form method="post" action="{{ route('register') }}">
                @csrf


                <div class="field">
                    <label for="name">Full Name</label>
                    <input
                        type="name"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder=""
                        autofocus
                        required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@email.com"
                        autofocus
                        required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                  <label for="country">Country</label>
                  <select name="country" id="">
                    @foreach($countries as $data)
                      <option value="{{ $data->id }}">{{ $data->country_name }}</option>
                    @endforeach
                  </select>
                  @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="submit-btn" type="submit">
                    <i class="bi bi-box-arrow-in-right"></i>&nbsp; Register
                </button>
            </form>

            <div class="divider">or</div>

            <p class="signup-note">
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </p>
        </div>
    </div>

</div>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

</body>
</html>