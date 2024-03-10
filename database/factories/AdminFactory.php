<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Admin;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => 'admin@my.cat',
            'email_verified_at' => now(),
            'password' => Hash::make('Password1ForMe!'), // Password1ForMe!
            // 'two_factor_secret' => null,
            // 'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];
    }
}
