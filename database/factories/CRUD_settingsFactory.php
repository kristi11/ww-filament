<?php

namespace Database\Factories;

use App\Models\CRUD_settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @method bool(true $true)
 */
class CRUD_settingsFactory extends Factory
{
    protected $model = CRUD_settings::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'can_create_content' => false,
            'can_edit_content' => true,
            'can_delete_content' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
