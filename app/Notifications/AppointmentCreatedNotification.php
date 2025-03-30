<?php

namespace App\Notifications;

use AllowDynamicProperties;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

#[AllowDynamicProperties] class AppointmentCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
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
    public function toMail($notifiable): MailMessage
    {
        $serviceName = $this->appointment->service->name;
        $date = Carbon::parse($this->appointment->date);
        $time = Carbon::parse($this->appointment->time);

        return (new MailMessage)
            ->subject('New Appointment')
            ->line('You have a new appointment. Please check the details below:')
            ->line("Customer: {$this->appointment->client_name}")
            ->line('Date: '.$date->format('F j, Y'))
            ->line('Time: '.$time->format('g:i A'))
            ->line("Service: $serviceName")
            ->line('Log in to your dashboard to view more details or make any changes to the appointment.')
            ->action('Your appointments', url('/team/team-appointments/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
        ];
    }
}
