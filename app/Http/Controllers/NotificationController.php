<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class NotificationController extends Controller
{
    // public function index()
    // {
    //     $user = auth()->user();

    //     if (!$user) {
    //         return redirect()->route('login')->with('error', 'Anda harus masuk untuk melihat notifikasi.');
    //     }

    //     // Pastikan bahwa user memiliki relasi 'notifications'
    //     if (method_exists($user, 'notifications')) {
    //         $notifications = $user->notifications()->latest()->paginate(10);

    //         return view('notifications.index', compact('notifications'));
    //     } else {
    //         return redirect()->route('dashboard')->with('error', 'Tidak dapat mengakses notifikasi.');
    //     }
    // }

    public function index()
    {
        // Mendapatkan user yang sedang login
        $user = auth()->user(); 

        // Ambil semua notifikasi milik user tersebut dengan query builder
        $notifications = DB::table('notifications')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }




    public function markAsRead(Notification $notification)
    {
        // Pastikan pengguna hanya bisa menandai notifikasi miliknya sendiri
        if ($notification->user_id == auth()->id()) {
            $notification->is_read = true;
            $notification->save();
        }

        return redirect()->route('notifications.index')->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    public function destroy(Notification $notification)
    {
        // Pastikan pengguna hanya bisa menghapus notifikasi miliknya sendiri
        if ($notification->user_id == auth()->id()) {
            $notification->delete();
        }

        return redirect()->route('notifications.index')->with('success', 'Notifikasi telah dihapus.');
    }


}
