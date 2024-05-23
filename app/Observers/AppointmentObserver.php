<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AppointmentAssignedNotification;
use App\Notifications\AppointmentCreatedNotification;
use App\Notifications\AppointmentUpdatedNotification;
use Auth;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment): void
    {
        // Load the service associated with the appointment
        $appointment->load('service');

        // Let's use the name of the first service, you might want to adjust this based on your use-case
        $serviceName = ($appointment->service)
            ? $appointment->service->name
            : 'Unknown';
        $superAdmin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();

        Notification::make()
            ->title('New Appointment')
            ->body('You have a new appointment')
            ->actions([
                Action::make('Your appointments')
                    ->button()
                    ->url($appointment->teamUser
                        ? '/team/team-appointments/'
                        : '/admin/appointments/'),
            ])
            ->sendToDatabase(($appointment->teamUser ? $appointment->teamUser : $superAdmin));

        // If there is a team user attached to the appointment, notify them
        if ($appointment->teamUser) {
            $appointment->teamUser->notify(new AppointmentCreatedNotification($appointment));
        } else {
            // Otherwise, notify all super admins
            foreach ($superAdmin as $admin) {
                $admin->notify(new AppointmentCreatedNotification($appointment));
            }
        }
    }

    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        // Check if teamUser_id has been changed and is not null
        if ($appointment->isDirty('teamUser_id') && $appointment->teamUser_id != null) {
            $teamUser = User::find($appointment->teamUser_id);  // Get the team user

            // You might want to check if $teamUser actually exists before sending the notification.
            if ($teamUser !== null) {
                Notification::make()
                    ->title('Appointment Assigned')
                    ->body('You have been assigned an appointment.')
                    ->actions([
                        Action::make('Your appointments')->button()->url('/team/team-appointments/'),
                    ])
                    ->sendToDatabase($teamUser);
                $teamUser->notify(new AppointmentAssignedNotification($appointment));
            }
        }
        // Load the service associated with the appointment
        $appointment->load('service');

        // Let's use the name of the first service
        $serviceName = $appointment->service ? $appointment->service->name : 'Unknown';

        // User who is performing the update
        $currentUser = Auth::user();

        // Check if current user fits either a team user or super admin role
        $updatedByTeamUser = User::whereHas('roles', function ($query) use ($currentUser) {
            $query->where('name', 'team_user')->where('id', $currentUser->id);
        })->exists();

        $updatedBySuperAdmin = User::whereHas('roles', function ($query) use ($currentUser) {
            $query->where('name', 'super_admin')->where('id', $currentUser->id);
        })->exists();

        $superAdmin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->get();

        if ($updatedByTeamUser) {
            Notification::make()
                ->title('Appointment Updated')
                ->body("The appointment for service $serviceName has been updated.")
                ->actions([
                    Action::make('Your appointments')->button()->url('/dashboard/customer-appointments/'),
                ])
                ->sendToDatabase($appointment->user); // Assuming the customer is referenced as 'user' in the Appointment model
            $appointment->user->notify(new AppointmentUpdatedNotification());
        } elseif ($updatedBySuperAdmin) {
            Notification::make()
                ->title('Appointment Updated')
                ->body("The appointment for service $serviceName has been updated.")
                ->actions([
                    Action::make('Your appointments')->button()->url('/dashboard/customer-appointments/'),
                ])
                ->sendToDatabase($appointment->user); // Assuming the customer is referenced as 'user' in the Appointment model
            $appointment->user->notify(new AppointmentUpdatedNotification());
        } elseif ($currentUser->id == $appointment->user_id) {
            $actionURL = $appointment->teamUser
                ? '/team/team-appointments/'
                : '/admin/appointments/';

            Notification::make()
                ->title('Appointment Updated')
                ->body("The appointment for service $serviceName has been updated.")
                ->actions([
                    Action::make('Your appointments')->button()->url($actionURL),
                ])
                ->sendToDatabase($appointment->teamUser ? $appointment->teamUser : $superAdmin);
            if ($appointment->teamUser) {
                $appointment->teamUser->notify(new AppointmentUpdatedNotification());
            } else {
                foreach ($superAdmin as $admin) {
                    $admin->notify(new AppointmentUpdatedNotification());
                }
            }
        }
    }

    /**
     * Handle the Appointment "deleted" event.
     */
    public function deleted(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "restored" event.
     */
    public function restored(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     */
    public function forceDeleted(Appointment $appointment): void
    {
        //
    }
}
