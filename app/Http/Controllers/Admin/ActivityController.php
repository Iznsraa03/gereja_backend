<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index() {
        $data = Activity::latest()->paginate(10);
        return view('admin.activities.index', compact('data'));
    }

    public function create() {
        return view('admin.activities.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'church_id' => 'nullable',
            'title' => 'nullable',
            'slug' => 'nullable',
            'location_name' => 'nullable',
            'start_at' => 'nullable',
            'end_at' => 'nullable'
        ]);
        
        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active');

        Activity::create($validated);
        return redirect('/admin/activities')->with('success', 'Activity created successfully.');
    }

    public function edit($id) {
        $item = Activity::findOrFail($id);
        return view('admin.activities.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'church_id' => 'nullable',
            'title' => 'nullable',
            'slug' => 'nullable',
            'location_name' => 'nullable',
            'start_at' => 'nullable',
            'end_at' => 'nullable'
        ]);

        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active');

        $item = Activity::findOrFail($id);
        $item->update($validated);
        return redirect('/admin/activities')->with('success', 'Activity updated successfully.');
    }

    public function destroy($id) {
        Activity::findOrFail($id)->delete();
        return redirect('/admin/activities')->with('success', 'Activity deleted successfully.');
    }
}
