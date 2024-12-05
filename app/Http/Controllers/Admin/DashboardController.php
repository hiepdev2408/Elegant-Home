<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    const PATH_VIEW = 'admin.';
    public function dashboard()
    {
        // Giao dich hằng ngày
        $homNay = Carbon::today();

        $tongGiaoDichHomNay = Order::whereDate('created_at', $homNay)->count();

        $homQua = Carbon::yesterday();

        $tongGiaoDichHomQua = Order::whereDate('created_at', $homQua)->count();

        $thayDoi = 0;

        if ($tongGiaoDichHomQua > 0) {
            $thayDoi = (($tongGiaoDichHomNay - $tongGiaoDichHomQua) / $tongGiaoDichHomQua) * 100;
        }
        $mau = 'text-success';

        if ($thayDoi > 0) {
            $dau = '+' . $thayDoi;
        }elseif($thayDoi < 0){
            $mau = 'text-danger';
            $dau = '-' . $thayDoi;
        }else{
            $dau = '0%';
        }

        $tongDoanhSo = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->sum('order_details.total_amount');

        // doanh số trước đó
        $doanhSoCu = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.created_at', '<', now()->subDays(7))
            ->where('orders.created_at', '>=', now()->subDays(14))
            ->sum('order_details.total_amount');

        // Tăng trưởng theo phần trăm
        $phamTrams = ($doanhSoCu > 0) ? (($tongDoanhSo - $doanhSoCu) / $doanhSoCu) * 100 : 0;




        // Hiển tị người dùng mua hàng với số tiền cao nhất
        $users = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.user_id',
                'users.name',
                'users.email',
                DB::raw('SUM(order_details.total_amount) as gia_mua_hang'),
                DB::raw('COUNT(order_details.id) as tong_don_hang')
            )
            ->groupby('orders.user_id', 'users.name', 'users.email')
            ->orderBy('gia_mua_hang', 'desc')
            ->take(10)
            ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('users', 'tongDoanhSo', 'phamTrams' , 'tongGiaoDichHomNay', 'dau','thayDoi', 'mau'));
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
