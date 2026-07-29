<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\ChurchCategory;

class CategoryController extends Controller
{
    public function index() {
        return response()->json(['success' => true, 'data' => ChurchCategory::where('is_active', true)->orderBy('sort_order')->get()]);
    }
}