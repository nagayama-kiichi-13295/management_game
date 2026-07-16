<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['key' => 'cooking',   'name' => '料理'],
            ['key' => 'service',   'name' => '接客'],
            ['key' => 'management', 'name' => '経営'],
            ['key' => 'marketing', 'name' => '広報'],
            ['key' => 'hygiene',   'name' => '衛生'],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(
                ['key' => $skill['key']],
                ['name' => $skill['name']]
            );
        }
    }
}
