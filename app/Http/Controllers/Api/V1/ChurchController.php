<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;

class ChurchController extends Controller
{
    public function index(Request $request) {
        $query = Church::with(['category', 'images'])->where('is_active', true)->where('verification_status', 'verified');
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->category_id) {
            $query->where('church_category_id', $request->category_id);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $query->paginate(15)
        ]);
    }

    public function nearby(Request $request) {
        $request->validate(['latitude' => 'required|numeric', 'longitude' => 'required|numeric']);
        $query = Church::with(['category', 'images'])
            ->where('is_active', true)
            ->where('verification_status', 'verified')
            ->closeTo($request->latitude, $request->longitude);
            
        if ($request->search) $query->where('name', 'like', "%{$request->search}%");
        if ($request->category_id) $query->where('church_category_id', $request->category_id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $query->paginate(15)
        ]);
    }

    public function show($slug) {
        $church = Church::with(['category', 'schedules', 'facilities', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('verification_status', 'verified')
            ->firstOrFail();
            
        return response()->json([
            'success' => true,
            'message' => 'Detail gereja berhasil diambil',
            'data' => $church
        ]);
    }
}