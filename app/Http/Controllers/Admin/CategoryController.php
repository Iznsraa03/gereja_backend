<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChurchCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $data = ChurchCategory::latest()->paginate(10);
        return view('admin.categories.index', compact('data'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'nullable',
            'slug' => 'nullable',
            'description' => 'nullable',
            'sort_order' => 'nullable'
        ]);
        
        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active');

        ChurchCategory::create($validated);
        return redirect('/admin/categories')->with('success', 'Category created successfully.');
    }

    public function edit($id) {
        $item = ChurchCategory::findOrFail($id);
        return view('admin.categories.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'nullable',
            'slug' => 'nullable',
            'description' => 'nullable',
            'sort_order' => 'nullable'
        ]);

        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active');

        $item = ChurchCategory::findOrFail($id);
        $item->update($validated);
        return redirect('/admin/categories')->with('success', 'Category updated successfully.');
    }

    public function destroy($id) {
        ChurchCategory::findOrFail($id)->delete();
        return redirect('/admin/categories')->with('success', 'Category deleted successfully.');
    }
}
