<?php

namespace Tests\Feature\Models;

use App\Models\FAQdata;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FAQdataTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_faq_data()
    {
        $user = User::factory()->create();

        $faqData = [
            'user_id' => $user->id,
            'content' => 'This is FAQ content',
            'visibility' => true,
        ];

        $faq = FAQdata::create($faqData);

        $this->assertInstanceOf(FAQdata::class, $faq);
        $this->assertEquals($faqData['user_id'], $faq->user_id);
        $this->assertEquals($faqData['content'], $faq->content);
        $this->assertEquals($faqData['visibility'], $faq->visibility);
        $this->assertDatabaseHas('f_a_qdatas', [
            'user_id' => $user->id,
            'content' => 'This is FAQ content',
        ]);
    }

    /** @test */
    public function it_can_update_a_faq_data()
    {
        $faq = FAQdata::factory()->create();

        $newData = [
            'content' => 'Updated FAQ content',
            'visibility' => false,
        ];

        $faq->update($newData);
        $faq->refresh();

        $this->assertEquals($newData['content'], $faq->content);
        $this->assertEquals($newData['visibility'], $faq->visibility);
    }

    /** @test */
    public function it_can_delete_a_faq_data()
    {
        $faq = FAQdata::factory()->create();
        $faqId = $faq->id;

        $faq->delete();

        $this->assertDatabaseMissing('f_a_qdatas', ['id' => $faqId]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $faq = FAQdata::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $faq->user);
        $this->assertEquals($user->id, $faq->user->id);
    }
}
