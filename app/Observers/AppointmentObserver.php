<?php

/**
 * Observer class for handling Appointment model events.
 *
 * This observer listens to the created, updated, deleted, restored,
 * and force deleted events for the Appointment model and performs
 * specific actions accordingly.
 */

namespace App\Observers;

use /**
 * Class Appointment
 *
 * Represents the Appointment model in the application which interacts with the 'appointments' table
 * in the MySQL database. This model is used to handle appointment-related data and operations.
 *
 * This class is a part of a Laravel v10 application that employs a synchronous queue processing
 * strategy and uses MySQL as its database.
 *
 * Key responsibilities:
 * - Managing appointment records.
 * - Interacting with the database using Eloquent ORM.
 * - Defining relationships with other models, if applicable.
 * - Providing methods for appointment-specific business logic.
 *
 * Ensure that this model adheres to Laravel's conventions and utilizes features like mutators,
 * accessors, and scopes whenever appropriate to enhance functionality and maintain code clarity.
 */
    App\Models\Appointment;
use /**
 * Class User
 *
 * This class represents the User model in the Laravel application.
 * It interacts with the 'users' table in the MySQL database.
 *
 * The User model utilizes Laravel's built-in Eloquent ORM for database operations.
 * It provides functionality to interact with user records and manage authentication.
 *
 * @package App\Models
 */
    App\Models\User;
use /**
 * Notification class responsible for handling notifications when an
 * appointment is assigned within the application.
 *
 * This class is typically used to notify users about newly assigned
 * appointments by sending the appropriate message or data via the
 * specified notification channel.
 *
 * Laravel framework is utilized for this functionality with support
 * for MySQL database and sync-based queue connection.
 *
 * @package App\Notifications
 */
    App\Notifications\AppointmentAssignedNotification;
use /**
 * This class represents a notification that is sent when an appointment is created.
 *
 * This notification is responsible for handling the representation and delivery
 * logistics of notifying users about the creation of an appointment.
 *
 * Responsibilities include:
 * - Defining notification delivery channels (e.g., mail, database).
 * - Formatting and creating notification content.
 *
 * Usage typically involves invoking this notification upon appointment creation
 * to alert the intended recipients.
 *
 * Laravel Version: v10.48.26
 * Database: MySQL
 * Queue Connection: sync
 */
    App\Notifications\AppointmentCreatedNotification;
use /**
 * Notification class for handling updates related to appointments.
 *
 * This notification is responsible for notifying users when an
 * appointment has been updated. The notification utilizes Laravel's
 * notification features to send messages via specified channels.
 *
 * @package App\Notifications
 */
    App\Notifications\AppointmentUpdatedNotification;
use /**
 * The Auth facade provides an interface to the authentication services of the Laravel application.
 *
 * This class allows access to essential authentication features such as user login, logout, and
 * authentication checks, as well as providing mechanisms for retrieving and modifying the
 * currently authenticated user instance within the application.
 *
 * Usage of this facade supports various authentication guards and user providers.
 *
 * Functionality includes:
 * - Authenticating users and retrieving their details.
 * - Checking for user authentication status.
 * - Managing user sessions and supporting basic, session, and token-based authentication.
 *
 * Commonly used with various Laravel authentication components such as middleware, controllers,
 * and policies.
 *
 * Core authentication functionality is configurable in the authentication settings of the application
 * (`config/auth.php`).
 *
 * Facade for the `\Illuminate\Auth\AuthManager` class.
 */
    Illuminate\Support\Facades\Auth;
use /**
 * Class Action
 *
 * Represents an action for Filament notifications.
 *
 * Provides configurations for customizing the behavior and display of notification actions.
 * Typically used in combination with notifications to allow users to perform specific tasks directly from the notification.
 *
 * @package Filament\Notifications\Actions
 */
    Filament\Notifications\Actions\Action;
use /**
 * Class Notification
 *
 * This class is part of the Filament Notifications package. It facilitates
 * the creation and management of notifications in the Laravel application.
 * Notifications can be used to inform users of events, errors, or other
 * application-related updates.
 *
 * Features:
 * - Creation of custom notifications with attributes such as title and body.
 * - Management of notification actions, such as buttons or redirection.
 * - Configurable styling and behavior of notifications.
 *
 * Dependencies:
 * - This class relies on the Filament framework for integration with
 *   Laravel and UI functionality.
 *
 * Usage Context:
 * - Typically used for generating user-facing notifications in
 *   web applications built with Filament and Laravel frameworks.
 *
 * Supported Database:
 * - This package works with MySQL in the Laravel application.
 *
 * Queue Connection:
 * - Operates with the `sync` queue connection defined in the application.
 */
    Filament\Notifications\Notification;

/**
 * This observer handles the lifecycle events of the `Appointment` model, including notifying
 * users or administrators when an appointment is created, updated, deleted, restored, or force deleted.
 */
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
