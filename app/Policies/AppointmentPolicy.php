<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_appointment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointment $appointment): bool
    {
        // User must have permission AND be the owner of the appointment
        return $user->can('view_appointment') && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_appointment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Appointment $appointment): bool
    {
        // User must have permission AND be the owner of the appointment
        return $user->can('update_appointment') && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Appointment $appointment): bool
    {
        // User must have permission AND be the owner of the appointment
        return $user->can('delete_appointment') && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        // Keep this permission-based, but the query scope will handle filtering
        return $user->can('delete_any_appointment');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Appointment $appointment): bool
    {
        // User must have permission AND be the owner of the appointment
        return $user->can('force_delete_appointment') && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        // Keep this permission-based, but the query scope will handle filtering
        return $user->can('force_delete_any_appointment');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Appointment $appointment): bool
    {
        // User must have permission AND be the owner of the appointment
        return $user->can('restore_appointment') && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        // Keep this permission-based, but the query scope will handle filtering
        return $user->can('restore_any_appointment');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Appointment $appointment): bool
    {
        // User must have permission AND be the owner of the appointment
        return $user->can('replicate_appointment') && $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_appointment');
    }
}
