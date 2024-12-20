<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    const PATH_VIEW = 'admin.';
    public function dashboard()
    {
        $homNay = Carbon::today();
        $homQua = Carbon::yesterday();

        $tongGiaoDichHomNay = $this->getOrderCountByDate($homNay);
        $tongGiaoDichHomQua = $this->getOrderCountByDate($homQua);
        $thayDoi = $this->calculatePercentageChange($tongGiaoDichHomNay, $tongGiaoDichHomQua);

        $user = User::query()->where('role_id', '!=', 1 & 2)->count();
        $users = $this->getTopUsers(10);

        $order = Order::with(['orderDetails']);

        $totalAmount = Order::with(['orderDetails'])
            ->get()
            ->flatMap(function ($order) {
                return $order->orderDetails;
            })
            ->sum('total_amount'); // Tính tổng total_amount

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'users',
            'user',
            'totalAmount',
            'tongGiaoDichHomNay',
        ));
    }


    // Hàm phụ trợ
    private function getOrderCountByDate($date)
    {
        return Order::whereDate('created_at', $date)->count();
    }

    private function calculatePercentageChange($current, $previous)
    {
        return $previous > 0 ? (($current - $previous) / $previous) * 100 : 0;
    }

    private function getSalesSum($startDate, $endDate)
    {
        return DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->sum('order_details.total_amount');
    }

    private function getTopUsers($limit)
    {
        return DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.user_id',
                'users.name',
                'users.email',
                DB::raw('SUM(order_details.total_amount) as gia_mua_hang'),
                DB::raw('COUNT(order_details.id) as tong_don_hang')
            )
            ->groupBy('orders.user_id', 'users.name', 'users.email')
            ->orderBy('gia_mua_hang', 'desc')
            ->take($limit)
            ->get();
    }

    public function markRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back();
    }

    public function compose(View $view)
    {
        $order = Order::query()->count();
        $countContact = Contract::count();
        $notifications = Notification::orderByDesc('created_at')->get();
        $unread = Notification::where('is_read', 0)->count();

        $view->with([
            'order' => $order,
            'countContact' => $countContact,
            'notifications' => $notifications,
            'unread' => $unread
        ]);
    }
}
