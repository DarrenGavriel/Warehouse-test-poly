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
        Program::create(['nama_program' => 'Program 1']);
        Program::create(['nama_program' => 'Program 2']);
        Program::create(['nama_program' => 'Program 3']);
        Program::create(['nama_program' => 'Program 4']);
    }
}
