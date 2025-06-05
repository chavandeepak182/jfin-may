<?php

namespace App\Http\Controllers;

use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = NotificationLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        // dd($notifications->toarray());
        if ($user->role_id == 4) {
            \Log::info('Admin user accessing notifications');
            return view('admin.notifications.index', compact('notifications'));
        };
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = NotificationLog::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['seen_by_user' => 1]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        NotificationLog::where('user_id', Auth::id())
            ->where('seen_by_user', 0)
            ->update(['seen_by_user' => 1]);

        return response()->json(['success' => true]);
    }

    public function unreadCount()
    {
        $count = NotificationLog::where('user_id', Auth::id())
            ->where('seen_by_user', 0)
            ->count();

        return response()->json(['count' => $count]);
    }
}
