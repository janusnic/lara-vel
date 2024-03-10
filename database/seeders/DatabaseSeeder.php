<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\Admin::factory()->create();
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Adam Smith',
            'email' => 'adam@my.cat',
            'email_verified_at' => now(),
            'password' => Hash::make('Adam1Password!'), 
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        
        $profile = new \App\Models\Profile([
            'first_name' => 'Adam',
            'last_name' => 'Smith',
            'birthday' => '01-01-1999'
        ]);

        $profile->user()->associate($user);
        $profile->save();

    }
}
