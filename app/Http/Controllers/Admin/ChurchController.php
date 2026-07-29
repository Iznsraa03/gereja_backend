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
            'verification_status' => 'required|in:draft,verified,rejected'
        ]);
        if ($data['verification_status'] === 'verified') {
            $data['verified_at'] = now();
            $data['verified_by'] = $request->user()->id;
        }
        Church::create($data);
        return redirect('/admin/churches')->with('success', 'Church added successfully.');
    }
}