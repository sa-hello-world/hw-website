<?php

namespace Database\Factories;

use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'available_places' => $this->faker->randomDigit(),
            'start' => $this->faker->dateTime(),
            'regular_price' => $this->faker->randomNumber(),
            'member_price' => $this->faker->randomNumber(),
            'type' => fake()->randomElement(EventType::cases())->value,
            'open_for' => 'everyone'
        ];
    }
}
