<?php

namespace Database\Seeders;

use App\Enums\SponsorshipTier;
use App\Models\Event;
use App\Models\Membership;
use App\Models\SchoolYear;
use App\Models\Sponsor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        SchoolYear::create([
            'start_academic_year' => Carbon::parse('2025-08-24'),
            'end_academic_year' => Carbon::parse('2026-08-01'),
            'name_of_chairman' => 'Silvia Popova',
            'regular_membership_price' => 20,
            'early_membership_price' => 10,
            'semester_membership_price' => 10,
        ]);

        $events = Event::factory(5)->create();

        foreach ($events as $event) {
            User::factory(random_int(1, 20))
                ->create()
                ->each(fn($user) => $user->registerForEvent($event));
        }

        User::take(5)->each(function ($user) {
            Membership::create([
                'user_id' => $user->id,
                'school_year_id' => SchoolYear::firstOrFail()->id,
            ]);
        });

        Sponsor::factory()->create(['tier' => SponsorshipTier::GOLD->value]);
        Sponsor::factory()->create(['tier' => SponsorshipTier::SILVER->value]);
        Sponsor::factory()->create(['tier' => SponsorshipTier::BRONZE->value]);
    }
}
