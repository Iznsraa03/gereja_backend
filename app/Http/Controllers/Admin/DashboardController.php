<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Church;
use App\Models\ChurchCategory;

class DashboardController extends Controller
{
    public function index() {
        $stats = [
            'churches' => Church::count(),
            'categories' => ChurchCategory::count(),
            'verified' => Church::where('verification_status', 'verified')->count()
        ];
        
        // Chart data
        $categoriesChart = ChurchCategory::withCount('churches')->get();
        $chartData = [
            'labels' => $categoriesChart->pluck('name')->toArray(),
            'data' => $categoriesChart->pluck('churches_count')->toArray(),
        ];

        return view('admin.dashboard', compact('stats', 'chartData'));
    }
}