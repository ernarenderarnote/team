<?php

namespace App\Notifications\Employer;

use App\Job;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppliedForJob extends Notification
{
    use Queueable;

    public $applicant;
    public $job;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $applicant, Job $job)
    {
        $this->applicant = $applicant;
        $this->job       = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //  rejectedforjob
        $via = ["database"];

        $notifications = is_array($notifiable->details->notifications) ? $notifiable->details->notifications : [] ;
        if(array_key_exists('applyforjob', $notifications) && $notifications['applyforjob']) {
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
                    ->subject("Applicant Applied for Job")
                    ->markdown('mail.employer.appliedForJob', ['applicant' => $this->applicant, 'job' => $this->job]);
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
            "applicant" => $this->applicant,
            "job"       => $this->job
        ];
    }
}
