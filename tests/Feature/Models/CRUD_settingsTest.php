<?php

namespace Tests\Feature\Models;

use App\Models\CRUD_settings;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CRUD_settingsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_crud_setting()
    {
        $user = User::factory()->create();

        $crudSettingData = [
            'user_id' => $user->id,
            'can_create_content' => true,
            'can_edit_content' => true,
            'can_delete_content' => true,
        ];

        $crudSetting = CRUD_settings::create($crudSettingData);

        $this->assertInstanceOf(CRUD_settings::class, $crudSetting);
        $this->assertEquals($crudSettingData['user_id'], $crudSetting->user_id);
        $this->assertEquals($crudSettingData['can_create_content'], $crudSetting->can_create_content);
        $this->assertEquals($crudSettingData['can_edit_content'], $crudSetting->can_edit_content);
        $this->assertEquals($crudSettingData['can_delete_content'], $crudSetting->can_delete_content);
        $this->assertDatabaseHas('c_r_u_d_settings', [
            'user_id' => $user->id,
            'can_create_content' => true,
            'can_edit_content' => true,
            'can_delete_content' => true,
        ]);
    }

    /** @test */
    public function it_can_update_a_crud_setting()
    {
        $crudSetting = CRUD_settings::factory()->create([
            'can_create_content' => true,
            'can_edit_content' => true,
            'can_delete_content' => true,
        ]);

        $newData = [
            'can_create_content' => false,
            'can_edit_content' => false,
            'can_delete_content' => false,
        ];

        $crudSetting->update($newData);
        $crudSetting->refresh();

        $this->assertEquals($newData['can_create_content'], $crudSetting->can_create_content);
        $this->assertEquals($newData['can_edit_content'], $crudSetting->can_edit_content);
        $this->assertEquals($newData['can_delete_content'], $crudSetting->can_delete_content);
    }

    /** @test */
    public function it_can_delete_a_crud_setting()
    {
        $crudSetting = CRUD_settings::factory()->create();
        $crudSettingId = $crudSetting->id;

        $crudSetting->delete();

        $this->assertDatabaseMissing('c_r_u_d_settings', ['id' => $crudSettingId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $crudSetting = CRUD_settings::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $crudSetting->user);
        $this->assertEquals($user->id, $crudSetting->user->id);
    }
}
