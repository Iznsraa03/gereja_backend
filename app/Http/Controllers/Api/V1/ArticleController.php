<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index() {
        return response()->json(['success' => true, 'data' => Article::where('status', 'published')->paginate(10)]);
    }
    public function show($slug) {
        return response()->json(['success' => true, 'data' => Article::where('slug', $slug)->where('status', 'published')->firstOrFail()]);
    }
}