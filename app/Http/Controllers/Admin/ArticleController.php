<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $data = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('data'));
    }

    public function create() {
        return view('admin.articles.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'nullable',
            'slug' => 'nullable',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'status' => 'nullable',
            'published_at' => 'nullable'
        ]);
        
        // Handle checkboxes
        $validated['author_id'] = auth()->id();

        Article::create($validated);
        return redirect('/admin/articles')->with('success', 'Article created successfully.');
    }

    public function edit($id) {
        $item = Article::findOrFail($id);
        return view('admin.articles.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'nullable',
            'slug' => 'nullable',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'status' => 'nullable',
            'published_at' => 'nullable'
        ]);

        // Handle checkboxes

        $item = Article::findOrFail($id);
        $item->update($validated);
        return redirect('/admin/articles')->with('success', 'Article updated successfully.');
    }

    public function destroy($id) {
        Article::findOrFail($id)->delete();
        return redirect('/admin/articles')->with('success', 'Article deleted successfully.');
    }
}
