<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisteredVoter>
 */
class RegisteredVoterFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $voter_id = fake()->numerify('V######');
        $usn_or_lrn = fake()->numerify('0############');
        $first_name = fake()->firstName();
        $mid_name = fake()->lastName();
        $last_name = fake()->lastName();

        $course_or_strand = [
            'BSIT',
            'BSHM',
            'BSCS',
            'BSBA',
        ];

        $school_level = [
            'College',
        ];

        $year = [
            '1st',
            '2nd',
            '3rd',
            '4th',
        ];

        $section = [
            'A',
            'B',
            'C',
            'D',
        ];

        // create a user account for the voter
        $voter_acc = User::query()->create([
            'name' => $voter_id . '_' . $first_name,
            'email' => fake()->email(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('voter'),
            'type' => 'VOTER',
            'remember_token' => Str::random(10),
        ]);

        return [
            'voter_id' => $voter_id,
            'usn_or_lrn' => $usn_or_lrn,
            'first_name' => $first_name,
            'mid_name' => $mid_name,
            'last_name' => $last_name,
            'strand_or_course' => fake()->randomElement($course_or_strand),
            'school_level' => fake()->randomElement($school_level),
            'year' => fake()->randomElement($year),
            'section' => fake()->randomElement($section),
            'user_id' => $voter_acc->id,
        ];
    }
}
