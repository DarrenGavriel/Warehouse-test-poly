P<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::create(['nama_program' => 'PROGRAM 1']);
        Program::create(['nama_program' => 'PROGRAM 2']);
        Program::create(['nama_program' => 'PROGRAM 3']);
        Program::create(['nama_program' => 'PROGRAM 4']);
    }
}
