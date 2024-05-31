<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = [
            'President',
            'Vice President',
            'Secretary',
            'Treasurer',
            'Auditor',
            'Public Information Officer',
            'Representative',
        ];

        $course_or_strand = [
            'BSIT',
            'BSHM',
            'BSCS',
            'BSBA',
        ];

        $school_level = [
            '1ST',
            '2ND',
            '3RD',
            '4TH',
        ];

        $partylist = [
            'Party A',
            'Party B',
        ];

        return [
            'name' => fake()->name(),
            'course_Or_strand' => fake()->randomElement($course_or_strand),
            'school_level' => fake()->randomElement($school_level),
            'position' => fake()->randomElement($positions),
            'partylist' => fake()->randomElement($partylist),
            'photo' => 'profile-img.jpg',
        ];
    }
}
