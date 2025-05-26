<?php

namespace Tests\Feature\Models;

use App\Models\SectionColors;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionColorsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_section_colors()
    {
        $user = User::factory()->create();

        $sectionColorsData = [
            'user_id' => $user->id,
            'loginBackgroundColor' => 'bg-blue-500',
            'servicesBackgroundColor' => 'bg-green-500',
            'hoursBackgroundColor' => 'bg-yellow-500',
            'galleryBackgroundColor' => 'bg-red-500',
            'ctaBackgroundColor' => 'bg-purple-500',
            'footerBackgroundColor' => 'bg-gray-500',
        ];

        $sectionColors = SectionColors::create($sectionColorsData);

        $this->assertInstanceOf(SectionColors::class, $sectionColors);
        $this->assertEquals($sectionColorsData['user_id'], $sectionColors->user_id);
        $this->assertEquals($sectionColorsData['loginBackgroundColor'], $sectionColors->loginBackgroundColor);
        $this->assertEquals($sectionColorsData['servicesBackgroundColor'], $sectionColors->servicesBackgroundColor);
        $this->assertEquals($sectionColorsData['hoursBackgroundColor'], $sectionColors->hoursBackgroundColor);
        $this->assertEquals($sectionColorsData['galleryBackgroundColor'], $sectionColors->galleryBackgroundColor);
        $this->assertEquals($sectionColorsData['ctaBackgroundColor'], $sectionColors->ctaBackgroundColor);
        $this->assertEquals($sectionColorsData['footerBackgroundColor'], $sectionColors->footerBackgroundColor);
        $this->assertDatabaseHas('section_colors', [
            'user_id' => $user->id,
            'loginBackgroundColor' => 'bg-blue-500',
            'servicesBackgroundColor' => 'bg-green-500',
        ]);
    }

    /** @test */
    public function it_can_update_a_section_colors()
    {
        $sectionColors = SectionColors::factory()->create([
            'loginBackgroundColor' => 'bg-slate-50',
            'servicesBackgroundColor' => 'bg-slate-50',
        ]);

        $newData = [
            'loginBackgroundColor' => 'bg-blue-500',
            'servicesBackgroundColor' => 'bg-green-500',
        ];

        $sectionColors->update($newData);
        $sectionColors->refresh();

        $this->assertEquals($newData['loginBackgroundColor'], $sectionColors->loginBackgroundColor);
        $this->assertEquals($newData['servicesBackgroundColor'], $sectionColors->servicesBackgroundColor);
    }

    /** @test */
    public function it_can_delete_a_section_colors()
    {
        $sectionColors = SectionColors::factory()->create();
        $sectionColorsId = $sectionColors->id;

        $sectionColors->delete();

        $this->assertDatabaseMissing('section_colors', ['id' => $sectionColorsId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $sectionColors = SectionColors::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $sectionColors->user);
        $this->assertEquals($user->id, $sectionColors->user->id);
    }
}
