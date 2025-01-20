<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Address;
use App\Models\BusinessHour;
use App\Models\Contact;
use App\Models\CRUD_settings;
use App\Models\FAQdata;
use App\Models\Flexibility;
use App\Models\Help;
use App\Models\Hero;
use App\Models\Privacy;
use App\Models\Product;
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Service;
use App\Models\Social;
use App\Models\Support;
use App\Models\Terms;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ShieldSeeder::class);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $team = User::create([
            'name' => 'Team',
            'email' => 'team@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user = User::factory(125)->create();
        Address::factory()->create(['user_id' => $admin->id]);
        Service::factory(12)->create(['user_id' => $admin->id]);
        BusinessHour::factory(7)->create(['user_id' => $admin->id]);
        Hero::factory()->create(['user_id' => $admin->id]);
        Social::factory()->create(['user_id' => $admin->id]);
        Flexibility::create(['user_id' => $admin->id]);
        PublicPage::factory()->create(['user_id' => $admin->id]);
        SectionColors::factory()->create(['user_id' => $admin->id]);
        About::factory()->create(['user_id' => $admin->id]);
        Contact::factory()->create(['user_id' => $admin->id]);
        Terms::factory()->create(['user_id' => $admin->id]);
        Privacy::factory()->create(['user_id' => $admin->id]);
        FAQdata::factory()->create(['user_id' => $admin->id]);
        Help::factory()->create(['user_id' => $admin->id]);
        CRUD_settings::factory()->create(['user_id' => $admin->id]);
        Support::factory()->create(['user_id' => $admin->id]);
        Product::factory(6)->hasVariants(3)->create();
    }

}
