<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email_address' => fake()->email,
            'name' => fake()->name,
            'state' => fake()->randomElement(['active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed']),
        ];
    }
}