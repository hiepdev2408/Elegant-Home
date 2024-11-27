<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back();
    }
}
