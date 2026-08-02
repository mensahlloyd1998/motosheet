<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageView;
use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
     
        // Fetch the user's car IDs once and reuse — avoids repeating the same subquery
        $carIds = $user->cars()->pluck('id');
     
        $totalListings  = $carIds->count();
        $activeListings = $user->cars()->where('status', 'active')->count();
     
        $totalViews  = PageView::whereIn('car_id', $carIds)->count();
        $totalOffers = Inquiry::whereIn('car_id', $carIds)->count();
     
        // Latest 5 offers across every listing this user owns
        $recentOffers = Inquiry::with('car.user.country')
            ->whereIn('car_id', $carIds)
            ->latest()
            ->take(5)
            ->get();
     
        // Top 5 listings by views — swap the orderByDesc column for inquiries_count
        // if you'd rather rank by offers instead.
        //
        // NOTE: this assumes Car has `pageViews()` and `inquiries()` relations
        // (hasMany PageView / hasMany Inquiry). Rename below if your relation
        // methods are called something else.
        $topListings = $user->cars()
            ->with('images')
            ->withCount([
                'pageViews as views_count',
                'inquiries as inquiries_count',
            ])
            ->orderByDesc('views_count')
            ->take(5)
            ->get();
     
        // Account-wide performance chart — same month-bucketing approach as
        // CarController@show, just aggregated across all of the user's cars
        // instead of a single one.
        $months = collect(range(0, 11))
            ->map(fn ($i) => Carbon::now()->subMonths($i)->format('Y-m'))
            ->reverse()
            ->values();
     
        $offers = Inquiry::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('car_id', $carIds)
            ->groupBy('month')
            ->pluck('total', 'month');
     
        $views = PageView::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('car_id', $carIds)
            ->groupBy('month')
            ->pluck('total', 'month');
     
        $offersData  = $months->map(fn ($m) => $offers[$m] ?? 0);
        $viewsData   = $months->map(fn ($m) => $views[$m] ?? 0);
        $monthLabels = $months->map(fn ($m) => Carbon::createFromFormat('Y-m', $m)->format('M'));
     
        return view('modern.dashboard', compact(
            'totalListings',
            'activeListings',
            'totalViews',
            'totalOffers',
            'recentOffers',
            'topListings',
            'months',
            'offersData',
            'viewsData',
            'monthLabels'
        ));
    }
    
}
