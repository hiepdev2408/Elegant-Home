<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStock extends Notification
{
    use Queueable;

    protected $variant;

    public function __construct($variant)
    {
        $this->variant->$variant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Cảnh báo: Số lượng sản phẩm thấp')
            // ->line("Sản phẩm {$this->product->name}, biến thể {$this->variant->color} / {$this->variant->size} sắp hết hàng.")
            ->line('Số lượng hiện tại: ' . $this->variant->stock)
            ->action('Kiểm tra ngay', url('/products'))
            ->line('Hãy bổ sung hàng hóa sớm nhất!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
