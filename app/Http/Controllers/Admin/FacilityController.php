<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index() {
        $data = Facility::latest()->paginate(10);
        return view('admin.facilities.index', compact('data'));
    }

    public function create() {
        return view('admin.facilities.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'nullable',
            'slug' => 'nullable',
            'icon_name' => 'nullable'
        ]);
        
        // Handle checkboxes

        Facility::create($validated);
        return redirect('/admin/facilities')->with('success', 'Facility created successfully.');
    }

    public function edit($id) {
        $item = Facility::findOrFail($id);
        return view('admin.facilities.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'nullable',
            'slug' => 'nullable',
            'icon_name' => 'nullable'
        ]);

        // Handle checkboxes

        $item = Facility::findOrFail($id);
        $item->update($validated);
        return redirect('/admin/facilities')->with('success', 'Facility updated successfully.');
    }

    public function destroy($id) {
        Facility::findOrFail($id)->delete();
        return redirect('/admin/facilities')->with('success', 'Facility deleted successfully.');
    }
}
