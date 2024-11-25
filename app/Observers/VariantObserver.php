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
        if ($variant->stock < 5) {
            $notification = Notification::create([
                'title' => 'Tồn kho vượt định mức',
                'message' => "Có {$count} sản phẩm vượt định mức tồn kho tại Elegant",
            ]);
        }
    }

}
