<?php

namespace Tests\Feature\Models;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Disable the GalleryObserver during testing
        Gallery::flushEventListeners();

        // Mock the Storage facade
        Storage::fake('gallery');
    }

    /** @test */
    public function it_can_create_a_gallery()
    {
        $service = Service::factory()->create();

        $galleryData = [
            'service_id' => $service->id,
            'description' => 'This is a test gallery',
            'image' => ['url' => 'test.jpg'],
        ];

        $gallery = Gallery::create($galleryData);

        $this->assertInstanceOf(Gallery::class, $gallery);
        $this->assertEquals($galleryData['service_id'], $gallery->service_id);
        $this->assertEquals($galleryData['description'], $gallery->description);
        $this->assertEquals($galleryData['image'], $gallery->image);
        $this->assertDatabaseHas('galleries', [
            'service_id' => $service->id,
            'description' => 'This is a test gallery',
        ]);
    }

    /** @test */
    public function it_can_update_a_gallery()
    {
        $gallery = Gallery::factory()->create();

        $newData = [
            'description' => 'Updated gallery description',
            'image' => ['url' => 'updated.jpg'],
        ];

        $gallery->update($newData);
        $gallery->refresh();

        $this->assertEquals($newData['description'], $gallery->description);
        $this->assertEquals($newData['image'], $gallery->image);
    }

    /** @test */
    public function it_can_delete_a_gallery()
    {
        $gallery = Gallery::factory()->create();
        $galleryId = $gallery->id;

        $gallery->delete();

        $this->assertDatabaseMissing('galleries', ['id' => $galleryId]);
    }

    /** @test */
    public function it_belongs_to_a_service()
    {
        $service = Service::factory()->create();
        $gallery = Gallery::factory()->create(['service_id' => $service->id]);

        $this->assertInstanceOf(Service::class, $gallery->service);
        $this->assertEquals($service->id, $gallery->service->id);
    }
}
