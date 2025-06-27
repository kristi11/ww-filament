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
use App\Models\PublicPage;
use App\Models\SectionColors;
use App\Models\Social;
use App\Models\Support;
use App\Models\Terms;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EssentialDataSeeder extends Seeder
{
    /**
     * Seed only the essential data required for the application to function properly.
     */
    public function run(): void
    {
        $admin = $this->createUser('Admin', 'admin@example.com');
        $this->createAdminAssociatedData($admin);

        $this->createUser('Team', 'team@example.com');
        $this->call(ShieldSeeder::class);
        $this->call(SectionPositionSeeder::class);
    }

    /**
     * Create a user with standard attributes
     */
    private function createUser(string $name, string $email): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }

    /**
     * Create all essential associated data for admin user
     */
    private function createAdminAssociatedData(User $admin): void
    {
        // Create essential business hours (weekdays only)
        BusinessHour::factory(5)->create(['user_id' => $admin->id]);

        // Create single instances with factory
        $this->createSingleInstanceModels($admin, [
            Address::class,
            Hero::class,
            Social::class,
            PublicPage::class,
            SectionColors::class,
            About::class,
            Contact::class,
            Terms::class,
            Privacy::class,
            FAQdata::class,
            Help::class,
            CRUD_settings::class,
            Support::class,
        ]);

        // Create without factory
        Flexibility::create(['user_id' => $admin->id]);
    }

    /**
     * Create a single instance for each model with factory
     */
    private function createSingleInstanceModels(User $user, array $modelClasses): void
    {
        foreach ($modelClasses as $modelClass) {
            $modelClass::factory()->create(['user_id' => $user->id]);
        }
    }
}
