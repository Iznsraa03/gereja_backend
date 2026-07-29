<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationPreference;

class ReminderController extends Controller
{
    public function index(Request $request) {
        $reminders = NotificationPreference::with('schedule.church')
            ->where('user_id', $request->user()->id)->get();
        return response()->json(['success' => true, 'data' => $reminders]);
    }
    public function toggle(Request $request, $scheduleId) {
        $user = $request->user();
        $pref = NotificationPreference::where('user_id', $user->id)->where('worship_schedule_id', $scheduleId)->first();
        if ($pref) {
            $pref->delete();
            return response()->json(['success' => true, 'message' => 'Pengingat dihapus']);
        }
        $minutes = $request->input('reminder_minutes', 30);
        NotificationPreference::create(['user_id' => $user->id, 'worship_schedule_id' => $scheduleId, 'reminder_minutes' => $minutes]);
        return response()->json(['success' => true, 'message' => 'Pengingat dibuat']);
    }
}