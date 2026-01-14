<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageView;
use App\Models\Inquiry;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
    
        $totalViews = PageView::whereIn(
            'car_id',
            $user->cars()->pluck('id')
        )->count();
    
        // Car records with status == 'active'
        $activePages = $user->cars()
            ->where('status', 'active')
            ->count();

        $totalOffers = Inquiry::whereIn(
            'car_id',
            $user->cars()->pluck('id')
        )->count();
    
        return view('luno.dashboard', compact('totalViews', 'activePages', 'totalOffers'));
    }
    
}
