<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    const PATH_VIEW = 'admin.';
    public function dashboard()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function markRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back();
    }

    public function compose(View $view)
    {
        $countContact = Contract::count();
        $notifications = Notification::orderByDesc('created_at')->get();
        $unread = Notification::where('is_read', 0)->count();

        $view->with([
            'countContact' => $countContact,
            'notifications' => $notifications,
            'unread' => $unread
        ]);
    }
}
