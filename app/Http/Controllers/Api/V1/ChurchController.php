<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;
use App\Http\Resources\ChurchResource;
use Illuminate\Support\Str;

class ChurchController extends Controller
{
    public function index(Request $request) {
        $query = Church::with(['category', 'images', 'facilities', 'schedules', 'activities'])
            ->where('is_active', true)
            ->where('verification_status', 'verified');
            
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->category_id) {
            $query->where('church_category_id', $request->category_id);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => ChurchResource::collection($query->paginate(15))->response()->getData(true)
        ]);
    }

    public function nearby(Request $request) {
        $request->validate(['latitude' => 'required|numeric', 'longitude' => 'required|numeric']);
        $query = Church::with(['category', 'images', 'facilities', 'schedules', 'activities'])
            ->where('is_active', true)
            ->where('verification_status', 'verified')
            ->closeTo($request->latitude, $request->longitude);
            
        if ($request->search) $query->where('name', 'like', "%{$request->search}%");
        if ($request->category_id) $query->where('church_category_id', $request->category_id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => ChurchResource::collection($query->paginate(15))->response()->getData(true)
        ]);
    }

    public function show($slug) {
        $church = Church::with(['category', 'schedules', 'facilities', 'activities', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('verification_status', 'verified')
            ->firstOrFail();
            
        return response()->json([
            'success' => true,
            'message' => 'Detail gereja berhasil diambil',
            'data' => new ChurchResource($church)
        ]);
    }

    // ponytail: User submits a new church for admin verification
    public function store(Request $request) {
        // Handle capacity conversion if passed as string like "-" or empty
        if ($request->has('capacity') && (!is_numeric($request->capacity) || (int)$request->capacity <= 0)) {
            $request->merge(['capacity' => null]);
        }

        $data = $request->validate([
            'name'               => 'required|string|max:150',
            'church_category_id' => 'required|exists:church_categories,id',
            'address'            => 'required|string',
            'district'           => 'nullable|string|max:100',
            'latitude'           => 'required|numeric',
            'longitude'          => 'required|numeric',
            'description'        => 'nullable|string',
            'phone'              => 'nullable|string|max:20',
            'capacity'           => 'nullable|integer',
            'main_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data['slug']                = Str::slug($data['name']) . '-' . uniqid();
        $data['verification_status'] = 'draft';
        $data['submitted_by']        = $request->user()->id; // ponytail: stored for traceability
        $data['city']                = 'Makassar';
        $data['province']            = 'Sulawesi Selatan';

        if ($request->hasFile('main_image')) {
            $data['main_image_path'] = $request->file('main_image')->store('churches', 'public');
        }
        unset($data['main_image']);

        $church = Church::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Gereja berhasil dikirim dan menunggu verifikasi admin.',
            'data'    => new ChurchResource($church->load(['category', 'facilities', 'schedules', 'activities', 'images']))
        ], 201);
    }

    // ponytail: Let user check their own submissions
    public function mySubmissions(Request $request) {
        $churches = Church::with(['category', 'images'])
            ->where('submitted_by', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => ChurchResource::collection($churches)
        ]);
    }
}