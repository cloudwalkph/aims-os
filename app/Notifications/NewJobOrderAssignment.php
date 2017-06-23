<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewJobOrderAssignment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $jo;
    protected $currentDateTime;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($jo)
    {
        $this->jo = $jo;
        $this->currentDateTime = Carbon::today('Asia/Manila')->toDateTimeString();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'job_order_id'  => $this->jo->id,
            'job_order_no'  => $this->jo->job_order_no,
            'project_name'  => $this->jo->project_name,
            'status'        => 'unread',
            'message'       => 'The Job Order '.$this->jo->job_order_no.' has been assigned to your department',
            'timestamp'     => $this->currentDateTime
        ];
    }
}
