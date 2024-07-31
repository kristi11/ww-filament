<?php

namespace App\Policies;

use App\Models\PublicPage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublicPagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, PublicPage $publicPage): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PublicPage $publicPage): bool
    {
    }

    public function delete(User $user, PublicPage $publicPage): bool
    {
    }

    public function restore(User $user, PublicPage $publicPage): bool
    {
    }

    public function forceDelete(User $user, PublicPage $publicPage): bool
    {
    }
}
