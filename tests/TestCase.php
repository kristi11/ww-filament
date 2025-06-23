<?php

namespace Tests;

use Database\Seeders\ShieldSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create the roles needed for testing
        $this->seedRoles();
    }

    /**
     * Seed the roles needed for testing.
     *
     * @return void
     */
    protected function seedRoles(): void
    {
        // Create the roles directly using the Spatie Permission package
        $roleClass = config('permission.models.role');

        // Create the super_admin role if it doesn't exist
        $roleClass::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // Create the team_user role if it doesn't exist
        $roleClass::firstOrCreate(['name' => 'team_user', 'guard_name' => 'web']);

        // Create the panel_user role if it doesn't exist
        $roleClass::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);
    }
}
