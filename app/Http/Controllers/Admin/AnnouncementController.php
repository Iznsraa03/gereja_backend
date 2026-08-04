<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index() {
        $data = Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('data'));
    }

    public function create() {
        return view('admin.announcements.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'church_id' => 'nullable',
            'title' => 'nullable',
            'content' => 'nullable',
            'priority' => 'nullable',
            'starts_at' => 'nullable',
            'ends_at' => 'nullable'
        ]);
        
        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active');

        Announcement::create($validated);
        return redirect('/admin/announcements')->with('success', 'Announcement created successfully.');
    }

    public function edit($id) {
        $item = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'church_id' => 'nullable',
            'title' => 'nullable',
            'content' => 'nullable',
            'priority' => 'nullable',
            'starts_at' => 'nullable',
            'ends_at' => 'nullable'
        ]);

        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active');

        $item = Announcement::findOrFail($id);
        $item->update($validated);
        return redirect('/admin/announcements')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id) {
        Announcement::findOrFail($id)->delete();
        return redirect('/admin/announcements')->with('success', 'Announcement deleted successfully.');
    }
}
