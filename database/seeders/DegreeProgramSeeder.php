<?php

namespace Database\Seeders;

use App\Models\DegreeProgram;
use Illuminate\Database\Seeder;

class DegreeProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            ['program_code' => 'BSIT', 'program_name' => 'Bachelor of Science in Information Technology'],
            ['program_code' => 'BSCS', 'program_name' => 'Bachelor of Science in Computer Science'],
            ['program_code' => 'BSIS', 'program_name' => 'Bachelor of Science in Information Systems'],
            ['program_code' => 'ACT', 'program_name' => 'Associate in Computer Technology'],
        ];

        foreach ($programs as $program) {
            DegreeProgram::create($program);
        }
    }
}