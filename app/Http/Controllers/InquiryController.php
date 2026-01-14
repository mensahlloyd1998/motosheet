<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    //

    public function store(Request $request, Car $car)
    {
        // Validation
        $request->validate([
            'name'=>'string|max:20',
            'phone'=> 'required',
            'email' => 'string|max:30',
            'offer' => 'numeric|required'
        ]);

        if (!preg_match('/^\+233\d{9}$/', $request->phone)) {
            return Redirect::back()->withErrors(['phone' => 'Wrong phone number format']);
        }

        // Store

        Inquiry::create([
            'car_id' => $car->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'offer_price' => $request->offer
        ]);

        //Redirect
        return redirect()->back()->with('success', "Your offer was submitted successfully");
    }
}
