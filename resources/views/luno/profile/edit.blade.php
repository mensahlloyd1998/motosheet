@extends('layouts.luno_layout')

@section('page_title')
   User Profile Settings
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <x-page-details 
        title="user account settings" 
        description="Edit profile/account information."
    />
@endsection

@section('content')

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-xxl-3 col-lg-4 col-md-4">
                    <div class="list-group list-group-custom sticky-top me-xl-4" style="top: 100px;">
                        <a class="list-group-item list-group-item-action" href="#list-item-1">Profile Details</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-2">Change Password</a>
                        <!-- <a class="list-group-item list-group-item-action" href="#list-item-3">Notifications Settings</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-4">Social Profiles</a> -->
                    </div>
                </div>
                <div class="col-xxl-8 col-lg-8 col-md-8">
                    <div id="list-item-1" class="card fieldset border border-muted mt-0">
                        <!-- form: profile details -->
                        <span class="fieldset-tile text-muted bg-body">Profile Details:</span>
                        <div class="card">
                            <div class="card-body">
                                <form id="profile-update-form" method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')
                                    <!-- <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Avatar</label>
                                        <div class="col-md-9 col-sm-8">
                                            <div class="image-input avatar xxl rounded-4" style="background-image: url(./assets/img/avatar.png)">
                                            <div class="avatar-wrapper rounded-4" style="background-image: url(./assets/img/profile_av.png)"></div>
                                                <div class="file-input">
                                                    <input type="file" class="form-control" name="file-input" id="file-input">
                                                    <label for="file-input" class="fa fa-pencil shadow text-muted"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Name *</label>
                                        <div class="col-md-9 col-sm-4">
                                            <input type="text" class="form-control form-control-lg" name="name" value="{{ auth()->user()->name }}">
                                            @error('name') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Email *</label>
                                        <div class="col-md-9 col-sm-4">
                                            <input type="email" readonly class="form-control form-control-lg" name="email" value="{{auth()->user()->email}}">
                                            @error('email') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Company *</label>
                                        <div class="col-md-9 col-sm-8">
                                            <input type="text" class="form-control form-control-lg" value="thememakker">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Contact Phone *</label>
                                        <div class="col-md-9 col-sm-8">
                                            <input type="text" class="form-control form-control-lg" name="phone" placeholder="+233 26 331 9480" value="{{ auth()->user()->phone ?? '+'.auth()->user()->country->phone_code}}">
                                            @error('phone') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Country *</label>
                                        <div class="col-md-9 col-sm-8">
                                            <select name="country" id="" class="form-control form-control-lg">
                                                <option value=""></option>
                                            </select>
                                            @error('country') <p class="mb-0 text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Company Site</label>
                                        <div class="col-md-9 col-sm-8">
                                            <input type="url" class="form-control form-control-lg" value="thememakker.com">
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Country *</label>
                                        <div class="col-md-9 col-sm-8">
                                            <select class="form-control form-control-lg">
                                                <option value="">-- Select Country --</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">Åland Islands</option>
                                            </select>
                                        </div>
                                    </div>-->

                                    <!-- <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Communication *</label>
                                        <div class="col-md-9 col-sm-8">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="s_Phone" value="option1">
                                                <label class="form-check-label" for="s_Phone">Phone</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="s_Email" value="option2">
                                                <label class="form-check-label" for="s_Email">Email</label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-sm-4 col-form-label">Available for freelance?</label>
                                        <div class="col-md-9 col-sm-8">
                                            <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="freelance">
                                            <label class="form-check-label" for="freelance">Yes, advertise my availability on my profile page</label>
                                            </div>
                                        </div>
                                    </div>-->
                                </form>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-light me-2" type="reset">Discard</button>
                                <button class="btn btn-primary" onclick="document.getElementById('profile-update-form').submit();" type="submit"><i class="bi bi-floppy2-fill me-2"></i> Save Changes</button>
                            </div>
                        </div>
                    </div>
                    <div id="list-item-2" class="card fieldset border border-muted mt-5">
                            <!-- form: Change Password -->
                            <span class="fieldset-tile text-muted bg-body">Change Password</span>
                            <div class="card">
                                <div class="card-body border-0">
                                    <form method="post" id="password-update-form" action="{{ route('password.update') }}" autocomplete="off">
                                        @csrf
                                        @method('put')
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <h6 class="pt-2 mt-2 mb-2">Change Password</h6>
                                                <p class="mb text-dark">Update your account password.</p>
                                                <div class="mb-3">
                                                    <input id="update_password_current_password" name="current_password" type="password" class="form-control form-control-lg" placeholder="Current Password" autocomplete="new-password">
                                                </div>
                                                <div class="mb-1">
                                                    <input id="update_password_password" name="password" type="password" class="form-control form-control-lg" placeholder="New Password" autocomplete="new-password">
                                                </div>
                                            <div>
                                                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control form-control-lg" placeholder="Confirm New Password" autocomplete="new-password">
                                                <span class="text-muted small">Minimum 8 characters</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn  btn-light me-2" type="reset">Discard</button>
                                <button class="btn  btn-primary" type="submit" onclick="document.getElementById('password-update-form').submit();">Save Changes</button>
                            </div>
                        </div>
                    </div>
                    <!--<div id="list-item-3" class="card fieldset border border-muted mt-5">
                        <span class="fieldset-tile text-muted bg-body">Notifications Settings</span>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table card-table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">Email Notifications</td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_email1" checked>
                                                <label class="form-check-label" for="n_email1">Email</label>
                                            </div>
                                            </td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_phone1" checked>
                                                <label class="form-check-label" for="n_phone1">Phone</label>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Billing Updates</td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_email2">
                                                <label class="form-check-label" for="n_email2">Email</label>
                                            </div>
                                            </td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_phone2">
                                                <label class="form-check-label" for="n_phone2">Phone</label>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">New Team Members</td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_email3">
                                                <label class="form-check-label" for="n_email3">Email</label>
                                            </div>
                                            </td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_phone3">
                                                <label class="form-check-label" for="n_phone3">Phone</label>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Projects Complete</td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_email4">
                                                <label class="form-check-label" for="n_email4">Email</label>
                                            </div>
                                            </td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_phone4" checked>
                                                <label class="form-check-label" for="n_phone4">Phone</label>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Newsletters</td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_email5">
                                                <label class="form-check-label" for="n_email5">Email</label>
                                            </div>
                                            </td>
                                            <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="n_phone5" checked>
                                                <label class="form-check-label" for="n_phone5">Phone</label>
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                                <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </div> 
                    <div id="list-item-4" class="card fieldset border border-muted mt-5">
                        <span class="fieldset-tile text-muted bg-body">Social Profiles</span>
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control form-control-lg">
                                    <button class="btn btn-info my-1" type="submit"><i class="fa fa-twitter me-2"></i>Connect to Twitter</button>
                                    <div class="small text-muted">One-click sign in</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control form-control-lg">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Behance</label>
                                    <input type="text" class="form-control form-control-lg">
                                </div>
                                <div>
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                                <button class="btn btn-lg btn-primary" type="submit">Update Social Profiles</button>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>

@endsection