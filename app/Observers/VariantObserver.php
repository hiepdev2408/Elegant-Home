<?php

namespace App\Observers;

use App\Events\NotificationEvent;
use App\Models\Notification;
use App\Models\Variant;

class VariantObserver
{
    public function updated(Variant $variant)
    {
        $count = Variant::where('stock', '<', 5)->count();
        // Chỉ thực hiện nếu cột stock bị thay đổi và stock hiện tại nhỏ hơn 5
        if ($variant->isDirty('stock') && $variant->stock < 5) {
            // Chỉ tạo thông báo nếu có ít nhất một sản phẩm dưới 5
            if (Variant::where('stock', '<', 5)->exists()) {
                Notification::create([
                    'title' => 'Tồn kho vượt định mức',
                    'message' => "Có {$count} sản phẩm vượt định mức tồn kho tại Elegant",
                ]);
            }
        }
    }
}
