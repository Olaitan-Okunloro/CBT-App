<?php
// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $notifications = Notification::where(function($q) use ($user) {
            // Show if recipient type matches user role
            if ($user->role == 'student') {
                $q->where('recipient_type', 'students')
                  ->orWhere('recipient_type', 'all');
            } elseif ($user->role == 'teacher') {
                $q->where('recipient_type', 'teachers')
                  ->orWhere('recipient_type', 'all');
            } elseif ($user->role == 'school') {
                $q->where('recipient_type', 'schools')
                  ->orWhere('recipient_type', 'all');
            } else {
                $q->where('recipient_type', 'all');
            }
            
            // Also show notifications specifically for this user
            $q->orWhere(function($sub) use ($user) {
                $sub->where('recipient_type', 'specific')
                    ->where('recipient_id', $user->id);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        
        // Mark unread as read when viewed
        $unreadCount = $this->getUnreadCount();
        
        return view('notifications.index', compact('notifications', 'unreadCount'));
    }
    
    public function getUnreadCount()
    {
        $user = auth()->user();
        
        return Notification::where(function($q) use ($user) {
            if ($user->role == 'student') {
                $q->where('recipient_type', 'students')
                  ->orWhere('recipient_type', 'all');
            } elseif ($user->role == 'teacher') {
                $q->where('recipient_type', 'teachers')
                  ->orWhere('recipient_type', 'all');
            } elseif ($user->role == 'school') {
                $q->where('recipient_type', 'schools')
                  ->orWhere('recipient_type', 'all');
            } else {
                $q->where('recipient_type', 'all');
            }
            $q->orWhere('recipient_id', $user->id);
        })
        ->where('is_read', false)
        ->count();
    }
    
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();
        
        return response()->json(['success' => true]);
    }
    
    public function markAllAsRead()
    {
        $user = auth()->user();
        
        Notification::where(function($q) use ($user) {
            if ($user->role == 'student') {
                $q->where('recipient_type', 'students')
                  ->orWhere('recipient_type', 'all');
            } elseif ($user->role == 'teacher') {
                $q->where('recipient_type', 'teachers')
                  ->orWhere('recipient_type', 'all');
            } elseif ($user->role == 'school') {
                $q->where('recipient_type', 'schools')
                  ->orWhere('recipient_type', 'all');
            } else {
                $q->where('recipient_type', 'all');
            }
            $q->orWhere('recipient_id', $user->id);
        })
        ->where('is_read', false)
        ->update(['is_read' => true, 'read_at' => now()]);
        
        return redirect()->back()->with('success', 'All notifications marked as read');
    }
}