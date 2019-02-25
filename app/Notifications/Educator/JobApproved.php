<?php

namespace App\Notifications\Educator;

use App\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobApproved extends Notification
{
    use Queueable;

    public $job;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ["database"];

        $notifications = is_array($notifiable->details->notifications) ? $notifiable->details->notifications : [] ;
        if(array_key_exists('jobapproved', $notifications) && $notifications['jobapproved']) {
            $via[] = "mail";
        }
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Congratulations! The Employer Approved Your Request")
                    ->markdown('mail.educator.job_approved', ['job' => $this->job]);
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
            'job' => $this->job
        ];
    }
}
