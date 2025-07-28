<?php

namespace Database\Factories;

use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Factories\Factory;
use Money\Money;

/**
 * @extends Factory<SchoolYear>
 */
class SchoolYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_academic_year' => now()->subMonth(),
            'end_academic_year' => now()->addMonths(11),
            'name_of_chairman' => $this->faker->name(),
            'regular_membership_price' => Money::EUR(2000),
            'early_membership_price' => Money::EUR(1000),
            'semester_membership_price' => Money::EUR(1000),
        ];
    }
}
