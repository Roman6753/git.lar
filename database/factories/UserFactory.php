<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phone = '+7(' . $this->faker->numberBetween(900, 999) . ')-' . 
                 $this->faker->numberBetween(100, 999) . '-' . 
                 $this->faker->numberBetween(10, 99) . '-' . 
                 $this->faker->numberBetween(10, 99);
                 
         return [
            'full_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'login' => $this->faker->unique()->userName(),
            'phone' => $phone,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
}
