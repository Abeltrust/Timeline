<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        $query = Auth::user()->notifications()->with('fromUser')->latest();

        if ($filter !== 'all') {
            if ($filter === 'unread') {
                $query->unread();
            } else {
                $query->where('type', $filter);
            }
        }

        $notifications = $query->paginate(20);
        
        return view('notifications.index', compact('notifications', 'filter'));
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()->unread()->update(['read' => true]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true]);
    }
}