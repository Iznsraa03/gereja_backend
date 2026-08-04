<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;
use App\Models\ChurchCategory;

class ChurchController extends Controller
{
    public function index() {
        $churches = Church::with('category')->paginate(15);
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
}