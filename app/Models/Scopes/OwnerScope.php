<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OwnerScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // If the user is not authenticated, we will not alter the query, which means the
        // query will fail with an `unauthenticated` error.
        if (Auth::check()) {
            // If the user has the 'super_admin' role, we will not alter the query.
            if (!Auth::user()->isSuperAdmin) {
                $builder->where('id', Auth::id());
            }
        }
    }
}
