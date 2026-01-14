<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageView;

class PublicCarController extends Controller
{
    //

    public function show(Request $request, $slug)
    {
        $car = \App\Models\Car::where([['slug', $slug], ['status', 'active']])->firstOrFail();

        PageView::create([
            'car_id'=>$car->id,
            'ip_address'=> $request->ip(),
            'user_agent'=> $request->userAgent(),
        ]);

        return view('car_show', ['car' => $car]);
    }
}
