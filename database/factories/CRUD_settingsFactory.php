<?php

namespace Database\Factories;

use App\Models\CRUD_settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @method boolean(true $true)
 */
class CRUD_settingsFactory extends Factory
{
    protected $model = CRUD_settings::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'can_create_content' => true,
            'can_edit_content' => true,
            'can_delete_content' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
