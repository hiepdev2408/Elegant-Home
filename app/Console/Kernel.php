<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $count = \App\Models\Variant::where('stock', '<', 5)->count();

            if ($count > 0) {
                // Tạo thông báo
                \App\Models\Notification::create([
                    'title' => 'Tồn kho vượt định mức',
                    'message' => "Có {$count} sản phẩm vượt định mức tồn kho tại Elegant",
                ]);

                // Thêm logic gửi email hoặc thông báo tại đây nếu cần.
            }
        })->dailyAt('07:00'); // Chạy lúc 7h sáng hàng ngày
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
