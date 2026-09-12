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

<title>Profile Settings — Motosheet</title>

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

  /* breadcrumb + page head */
  .eyebrow-row{padding:24px 0 0;display:flex;align-items:center;gap:10px;font-size:12px;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-muted);font-weight:600;}
  .eyebrow-row .sep{color:#d3cfc6;}
  .eyebrow-row .current{color:var(--black);}
  .page-head{padding:14px 0 32px;border-bottom:1px solid var(--line);margin-bottom:36px;}
  .page-head h1{font-size:clamp(26px,3.2vw,36px);font-weight:800;letter-spacing:-0.02em;}
  .page-head .sub{font-size:14.5px;color:var(--text-muted);margin-top:6px;}

  /* alerts */
  .alert{border-radius:var(--radius);padding:14px 16px;font-size:13.5px;margin-bottom:24px;font-weight:500;}
  .alert-success{background:#eef7ee;color:#2d6a30;border:1px solid #c9e4c9;}
  .alert-danger{background:#fdece7;color:#a3320f;border:1px solid #f3c7b8;}
  .alert-danger ul{margin:6px 0 0 18px;}

  /* layout */
  .settings-grid{display:grid;grid-template-columns:220px 1fr;gap:48px;align-items:start;padding-bottom:80px;}
  @media(max-width:860px){ .settings-grid{grid-template-columns:1fr;} }

  .settings-nav{position:sticky;top:96px;display:flex;flex-direction:column;gap:2px;}
  .settings-nav a{font-size:13.5px;font-weight:600;color:var(--text-muted);padding:10px 14px;border-radius:4px;}
  .settings-nav a:hover{color:var(--black);background:var(--paper);}
  .settings-nav a.danger-link{color:#a3320f;}
  .settings-nav a.danger-link:hover{background:#fdece7;}
  @media(max-width:860px){ .settings-nav{position:static;flex-direction:row;flex-wrap:wrap;} }

  /* section cards (reused pattern from cars/create) */
  .section-card{border:1px solid var(--line);border-radius:6px;padding:28px;margin-bottom:24px;scroll-margin-top:96px;}
  .section-card.danger-zone{border-color:#f3c7b8;background:#fffaf8;}
  .section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--orange-deep);margin-bottom:4px;}
  .section-card.danger-zone .section-title{color:#a3320f;}
  .section-desc{font-size:13.5px;color:var(--text-muted);margin-bottom:22px;}

  .field-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;}
  @media(max-width:640px){ .field-grid{grid-template-columns:1fr;} }

  .field{margin-bottom:18px;}
  .field:last-child{margin-bottom:0;}
  .field label{display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);margin-bottom:7px;}
  .field input[type="text"],
  .field input[type="email"],
  .field input[type="password"],
  .field select{
    width:100%;border:1px solid var(--line);border-radius:var(--radius);padding:12px 13px;
    font-size:14.5px;font-family:inherit;background:#fff;transition:border-color .2s ease;color:var(--black);
  }
  .field input:focus, .field select:focus{border-color:var(--orange);outline:none;}
  .field input:disabled{background:var(--paper);color:var(--text-muted);cursor:not-allowed;}
  .field select{appearance:none;-webkit-appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236b6862'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:34px;}
  .field small.text-danger{display:block;color:#c0391a;font-size:12px;margin-top:6px;}
  .field small.hint{display:block;color:var(--text-muted);font-size:12px;margin-top:6px;}

  .submit-row{display:flex;justify-content:flex-end;gap:12px;margin-top:8px;}
  .cta-btn{display:inline-flex;align-items:center;gap:8px;background:var(--orange);color:#fff;font-weight:700;font-size:14px;padding:13px 22px;border-radius:var(--radius);border:none;transition:background .2s ease, transform .15s ease;}
  .cta-btn:hover{background:var(--orange-deep);transform:translateY(-1px);}
  .cta-btn.danger{background:#c0391a;}
  .cta-btn.danger:hover{background:#a3320f;}
  .discard-link{font-size:13.5px;font-weight:600;color:var(--text-muted);padding:13px 8px;}
  .discard-link:hover{color:var(--black);}

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
            <a href="{{ route('offers.index') }}">Offers</a>
        </div>
        <div class="user-menu">
            <button class="user-btn" id="userMenuBtn">
                <span class="user-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</span>
                {{ $user->name ?? 'Account' }}
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
        <a href="{{ route('dashboard') }}">Home</a><span class="sep">/</span><span class="current">Profile Settings</span>
    </div>

    <div class="page-head">
        <h1>Profile Settings</h1>
        <p class="sub">Manage your personal information and account security.</p>
    </div>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success">Your profile has been updated.</div>
    @endif

    @if($errors->default->any())
        <div class="alert alert-danger">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach($errors->default->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="settings-grid">

        <nav class="settings-nav">
            <a href="#profile-details">Profile Details</a>
            <a href="#change-password">Change Password</a>
            <!-- <a href="{{ route('profile.poster') }}">My Poster</a> -->
            <a href="#danger-zone" class="danger-link">Delete Account</a>
        </nav>

        <div>

            {{-- Profile details --}}
            <div class="section-card" id="profile-details">
                <div class="section-title">Profile Details</div>
                <p class="section-desc">Your name, contact info, and country. Buyers may see your phone number on your listings.</p>

                <form method="post" action="{{ route('profile.update') }}" id="profile-update-form">
                    @csrf
                    @method('patch')

                    <div class="field-grid">
                        <div class="field">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" disabled>
                            <small class="hint">Contact support to change your email address.</small>
                        </div>
                    </div>

                    <div class="field-grid">
                        <div class="field">
                            <label for="phone">Contact Phone</label>
                            <input type="text" id="phone" name="phone"
                                   value="{{ old('phone', $user->phone ?? '+'.optional($user->country)->phone_code) }}"
                                   placeholder="+233 26 331 9480">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            <small class="hint">Must match your country's format, e.g. {{ '+'.optional($user->country)->phone_code }} followed by 9 digits.</small>
                        </div>
                        <div class="field">
                            <label for="country">Country</label>
                            {{--
                                ProfileController@edit doesn't currently pass a $countries list —
                                this assumes one will be added (compact('user', 'countries')).
                                Falls back to just the user's current country if it's missing
                                so the page doesn't break in the meantime.
                            --}}
                            <select id="country" name="country">
                                @if(isset($countries))
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country', optional($user->country)->id) == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                @elseif($user->country)
                                    <option value="{{ $user->country->id }}" selected>{{ $user->country->name }}</option>
                                @endif
                            </select>
                            @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="submit-row">
                        <button type="reset" class="discard-link">Discard</button>
                        <button type="submit" class="cta-btn"><i class="bi bi-check-lg"></i> Save Changes</button>
                    </div>
                </form>
            </div>

            {{-- Change password --}}
            <div class="section-card" id="change-password">
                <div class="section-title">Change Password</div>
                <p class="section-desc">Update your account password. Use at least 8 characters.</p>

                <form method="post" action="{{ route('password.update') }}" id="password-update-form" autocomplete="off">
                    @csrf
                    @method('put')

                    <div class="field">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" autocomplete="new-password">
                        @error('current_password', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="field-grid">
                        <div class="field">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" autocomplete="new-password">
                            @error('password', 'updatePassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                            <small class="hint">Minimum 8 characters.</small>
                        </div>
                    </div>

                    <div class="submit-row">
                        <button type="reset" class="discard-link">Discard</button>
                        <button type="submit" class="cta-btn"><i class="bi bi-shield-lock"></i> Update Password</button>
                    </div>
                </form>
            </div>

            {{-- Danger zone --}}
            <div class="section-card danger-zone" id="danger-zone">
                <div class="section-title">Danger Zone</div>
                <p class="section-desc">Deleting your account is permanent — your listings, images, and offer history will be removed and cannot be recovered.</p>

                <form method="post" action="{{ route('profile.destroy') }}" id="delete-account-form">
                    @csrf
                    @method('delete')

                    <div class="field" style="max-width:340px;">
                        <label for="delete_password">Confirm Your Password</label>
                        <input type="password" id="delete_password" name="password" placeholder="Enter your password to confirm">
                        @error('password', 'userDeletion') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="submit-row" style="justify-content:flex-start;">
                        <button type="submit" class="cta-btn danger"><i class="bi bi-trash"></i> Delete Account</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</main>

<footer>
    &copy; {{ date('Y') }} Motosheet. Beautiful single-page listings for cars.
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // ---------- user dropdown ----------
    const menuBtn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); dropdown.classList.toggle('show'); });
    document.addEventListener('click', () => dropdown.classList.remove('show'));

    // ---------- confirm before permanently deleting the account ----------
    document.getElementById('delete-account-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            icon: 'warning',
            title: 'Delete your account?',
            text: 'This is permanent. All your listings, images, and offer history will be removed.',
            showCancelButton: true,
            confirmButtonText: 'Delete my account',
            confirmButtonColor: '#c0391a',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // ---------- scroll to the relevant section if the page reloads with errors ----------
    @if($errors->has('phone') || $errors->has('name') || $errors->has('country'))
        document.getElementById('profile-details').scrollIntoView({ behavior: 'smooth', block: 'start' });
    @elseif($errors->hasBag('updatePassword') && $errors->getBag('updatePassword')->any())
        document.getElementById('change-password').scrollIntoView({ behavior: 'smooth', block: 'start' });
    @elseif($errors->hasBag('userDeletion') && $errors->getBag('userDeletion')->any())
        document.getElementById('danger-zone').scrollIntoView({ behavior: 'smooth', block: 'start' });
    @endif
</script>

</body>
</html>