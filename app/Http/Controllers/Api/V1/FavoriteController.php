<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index(Request $request) {
        $favorites = $request->user()->favorites()->with(['church.category', 'church.images'])->paginate(15);
        return response()->json(['success' => true, 'data' => $favorites]);
    }
    public function toggle(Request $request, $churchId) {
        $user = $request->user();
        $fav = Favorite::where('user_id', $user->id)->where('church_id', $churchId)->first();
        if ($fav) {
            $fav->delete();
            return response()->json(['success' => true, 'message' => 'Dihapus dari favorit']);
        }
        Favorite::create(['user_id' => $user->id, 'church_id' => $churchId]);
        return response()->json(['success' => true, 'message' => 'Ditambahkan ke favorit']);
    }
}