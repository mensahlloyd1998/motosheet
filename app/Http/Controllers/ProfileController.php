<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('luno.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $phone_code = '+'.auth()->user()->country->phone_code; 

        $phoneRegex = '/^' . preg_quote($phone_code, '/') . '\d{9}$/';

        if (!preg_match($phoneRegex, $request->phone)) {
            return Redirect::back()->withErrors(['phone' => 'Wrong phone number format']);
        }

        // $request->phone = preg_replace('/^\+233/', '0', $request->phone);
        $request->user()->phone = $request->phone;

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function poster(Request $request)
    {
        return view('luno.profile.poster');
    }

    public function updatePoster(Request $request)
    {


        $phone_code = '+'.auth()->user()->country->phone_code; 

        $phoneRegex = '/^' . preg_quote($phone_code, '/') . '\d{9}$/';

        // validate
        $request->validate([
            'poster_design'     => 'required|string|max:255',
            'phone'             => ['required', 'regex:'.$phoneRegex],
            'alternative_phone' => ['nullable', 'regex:'.$phoneRegex],
        ]);        





        // if (!preg_match('/^\+233\d{9}$/', $request->phone)) {
        //     return Redirect::back()->withErrors(['phone' => 'Wrong phone number format']);
        // }

        // if (!preg_match('/^\+233\d{9}$/', $request->alternative_telephone)) {
        //     return Redirect::back()->withErrors(['alternative_phone' => 'Wrong phone number format']);
        // }

        // dd($request);

        // fetch user record
        $user = User::findOrFail(auth()->user()->id);

        // update user record
        $user->poster_design = $request->poster_design;
        $user->poster_contact_1 = $request->phone;
        $user->poster_contact_2 = $request->alternative_phone;
        $user->save();

        //redirect
        return redirect()->back()->with('success', 'Design Updated Successfully');
    }
}
