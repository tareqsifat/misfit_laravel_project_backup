<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {   
        $notification = Notification::where('notification', 0)->update([
            'notification' => 1,
        ]);
        
        $collection = Notification::latest()->get();
        
        return view('admin.notification.index',compact('collection'));
    }


    // public function store()
    // {
    //     $notification = Notification::where('notification', 0)->update([
    //         'notification' => 1,
    //     ]);

    // }
}
