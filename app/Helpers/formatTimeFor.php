<?php
use Carbon\Carbon;

function formatTimeForZalo($time)
{
    $now = Carbon::now();
    $diffInSeconds = $now->diffInSeconds($time);

    if ($diffInSeconds < 60) {
        return $diffInSeconds . ' giây';
    }

    $diffInMinutes = $now->diffInMinutes($time);
    if ($diffInMinutes < 60) {
        return $diffInMinutes . ' phút';
    }

    $diffInHours = $now->diffInHours($time);
    if ($diffInHours < 24) {
        return $diffInHours . ' giờ';
    }

    $diffInDays = $now->diffInDays($time);
    if ($diffInDays < 7) {
        return $diffInDays . ' ngày';
    }

    return $time->format('d/m'); // Hiển thị ngày cụ thể nếu quá lâu
}
