<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;
use App\Models\ChurchCategory;

class ChurchController extends Controller
{
    public function index(Request $request) {
        $query = Church::with('category');
        // ponytail: filter by status tab
        if ($request->status && $request->status !== 'all') {
            $query->where('verification_status', $request->status);
        }
        $churches = $query->latest()->paginate(15)->withQueryString();
        return view('admin.churches.index', compact('churches'));
    }
    public function create() {
        $categories = ChurchCategory::all();
        return view('admin.churches.form', compact('categories'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string', 'church_category_id' => 'required|exists:church_categories,id',
            'slug' => 'required|unique:churches', 'address' => 'required',
            'latitude' => 'required|numeric', 'longitude' => 'required|numeric',
            'verification_status' => 'required|in:draft,verified,rejected',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        
        if ($data['verification_status'] === 'verified') {
            $data['verified_at'] = now();
            $data['verified_by'] = $request->user()->id;
        }
        
        if ($request->hasFile('main_image')) {
            $data['main_image_path'] = $request->file('main_image')->store('churches', 'public');
        }
        unset($data['main_image']); // Don't try to save the uploaded file object to DB
        
        Church::create($data);
        return redirect('/admin/churches')->with('success', 'Church added successfully.');
    }
    
    public function edit(Church $church) {
        $categories = ChurchCategory::all();
        return view('admin.churches.edit', compact('church', 'categories'));
    }
    
    public function update(Request $request, Church $church) {
        $data = $request->validate([
            'name' => 'required|string', 'church_category_id' => 'required|exists:church_categories,id',
            'slug' => 'required|unique:churches,slug,'.$church->id, 'address' => 'required',
            'latitude' => 'required|numeric', 'longitude' => 'required|numeric',
            'verification_status' => 'required|in:draft,verified,rejected',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        
        if ($data['verification_status'] === 'verified' && $church->verification_status !== 'verified') {
            $data['verified_at'] = now();
            $data['verified_by'] = $request->user()->id;
        }
        
        if ($request->hasFile('main_image')) {
            $data['main_image_path'] = $request->file('main_image')->store('churches', 'public');
        }
        unset($data['main_image']);
        
        $church->update($data);
        return redirect('/admin/churches')->with('success', 'Church updated successfully.');
    }
    
    public function destroy(Church $church) {
        $church->delete();
        return redirect('/admin/churches')->with('success', 'Church deleted successfully.');
    }

    // ponytail: quick verify
    public function verify(Church $church) {
        $church->update(['verification_status' => 'verified', 'verified_at' => now(), 'verified_by' => auth()->id()]);
        return back()->with('success', "'{$church->name}' telah diverifikasi.");
    }

    // ponytail: quick reject
    public function reject(Church $church) {
        $church->update(['verification_status' => 'rejected']);
        return back()->with('error', "'{$church->name}' telah ditolak.");
    }
}