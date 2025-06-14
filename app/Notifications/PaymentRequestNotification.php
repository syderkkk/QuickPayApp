<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRequestNotification extends Notification
{
    use Queueable;

    public $transaction;

    /**
     * Create a new notification instance.
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Nueva solicitud de pago',
            'message' => 'Has recibido una solicitud de S/' . number_format($this->transaction->amount, 2),
            'sender_id' => $this->transaction->sender_id,
            'sender_name' => optional($this->transaction->sender)->name,
            'amount' => $this->transaction->amount,
            'currency' => $this->transaction->currency,
            'transaction_id' => $this->transaction->id,
            'created_at' => now(),
        ];
    }



    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
