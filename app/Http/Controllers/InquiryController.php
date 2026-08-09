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

        $phone_code = '+'.auth()->user()->country->phone_code; // eg; +233

        if (!preg_match('/^' . preg_quote($phone_code, '/') . '\d{9}$/', $request->phone)) {
            return back()->withErrors(['phone' => 'Wrong phone number format']);
        }

        // if (!preg_match('/^\+233\d{9}$/', $request->phone)) {
        //     return back()->withErrors(['phone' => 'Wrong phone number format']);
        // }

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

    /*
    |------------------------------------------
    | Offer Management
    |------------------------------------------
    */
    public function offers(Request $request)
    {
        
        $offers = Inquiry::whereNotNull('offer_price')
            ->whereHas('car', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->with('car')
            ->latest()
            ->get();

            if ($request->has('search')) {
                $offers = $offers->filter(function ($offer) use ($request) {
                return stripos($offer->car->title, $request->search) !== false;
                });
            }
    
        return view('modern.offers.index', compact('offers'));
    }
}
