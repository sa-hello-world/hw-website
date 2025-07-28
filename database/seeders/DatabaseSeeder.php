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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Money\Money;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('app:sync-permissions');

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'chair@hz.nl',
            'password' => Hash::make('123'),
        ]);

        $user->assignRole('chairman');

        $schoolYear = SchoolYear::create([
            'start_academic_year' => Carbon::parse('2025-07-23'),
            'end_academic_year' => Carbon::parse('2026-08-01'),
            'name_of_chairman' => 'Silvia Popova',
            'regular_membership_price' => Money::EUR(2000),
            'early_membership_price' => Money::EUR(1000),
            'semester_membership_price' => Money::EUR(1000),
        ]);

        $events = Event::factory(6)->create(['school_year_id' => $schoolYear->id]);
        // @phpstan-ignore-next-line Of course there would be an event, above we generate 6
        $events[0]->update(['start' => now()->addDays(7)]);

        $prevYear = SchoolYear::create([
            'start_academic_year' => Carbon::parse('2024-07-23'),
            'end_academic_year' => Carbon::parse('2025-07-01'),
            'name_of_chairman' => 'Silvia Popova',
            'regular_membership_price' => Money::EUR(2000),
            'early_membership_price' => Money::EUR(1000),
            'semester_membership_price' => Money::EUR(1000),
        ]);

        $events = Event::factory(6)->create(['school_year_id' => $prevYear->id]);

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
