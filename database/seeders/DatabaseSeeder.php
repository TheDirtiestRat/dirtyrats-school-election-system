<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\RegisteredVoter;
use App\Models\SystemConfig;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'type' => 'ADMIN',
            'password' => 'admin'
        ]);

        // create system config keys
        SystemConfig::factory()->create([
            'key' => 'can_register',
            'value' => '0',
        ]);
        SystemConfig::factory()->create([
            'key' => 'can_vote',
            'value' => '0',
        ]);

        // create the test voters
        // RegisteredVoter::factory(5)->create();

        // Candidate::factory()->create([
        //     'name' => 'DR. ALEJANDRO S. ALMENDRAS',
        //     'position' => 'Board Officer',
        //     'partylist' => 'CHIEF EDUCATION SUPERVISOR CURRICULUM IMPLEMENTATION DIVISION',
        //     'photo' => 'n11.png',
        // ]);

        $this->call([
            // LitmusSeeder::class,
            CandidateSeeder::class,
            PositionSeeder::class,
        ]);
        
        
    }
}
