<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create the test positions and candidates
        Position::factory()->create([
            'name' => 'President',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Vice President',
            'description' => '',
        ]);
        // Position::factory()->create([
        //     'name' => 'Vice President Internal',
        //     'description' => '',
        // ]);
        Position::factory()->create([
            'name' => 'Secretary',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Treasurer',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Public Information Officer',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Auditor',
            'description' => '',
        ]);

        // Position::factory()->create([
        //     'name' => 'PRO',
        //     'description' => '',
        // ]);

        // board members
        Position::factory()->create([
            'name' => 'External Affairs',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Cultural Activities and Sports Development',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Student Organization',
            'description' => '',
        ]);
        Position::factory()->create([
            'name' => 'Multimedia and the Art',
            'description' => '',
        ]);
        // Position::factory()->create([
        //     'name' => 'CSS',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'PROGRAMING and ANIMATION',
        //     'description' => '',
        // ]);

        // representative
        // Position::factory()->create([
        //     'name' => 'HUMSS',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'STEM',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'ABM',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'HE',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'CSS',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'PROGRAMING and ANIMATION',
        //     'description' => '',
        // ]);

        // houses
        // Position::factory()->create([
        //     'name' => 'CAHEL',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'AZUL',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'ROXXO',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'GIALLIO',
        //     'description' => '',
        // ]);
        // Position::factory()->create([
        //     'name' => 'VIERRDY',
        //     'description' => '',
        // ]);
    }
}
