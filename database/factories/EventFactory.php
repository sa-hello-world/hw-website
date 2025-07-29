<?php

namespace Database\Factories;

use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Money\Money;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'location' => $this->faker->address(),
            'available_places' => $this->faker->randomDigit(),
            'start' => $this->faker->dateTime(),
            'regular_price' => Money::EUR($this->faker->randomDigit() * 100),
            'member_price' => Money::EUR($this->faker->randomDigit() * 100),
            'type' => fake()->randomElement(EventType::cases())->value,
            'open_for' => 'everyone'
        ];
    }
}
