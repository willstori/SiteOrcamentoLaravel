<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SobreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sobre')->insert([
            'texto'=> "Texto",
            'missao'=> "Missão",
            'visao'=> "Visão",
            'valores'=> "Valores",
            'foto'=> "",
        ]);
    }
}
