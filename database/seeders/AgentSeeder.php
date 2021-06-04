<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Agent;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Agent::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $agents = [
            ['name'=>'Agent 1'],
            ['name'=>'Agent 2'],
            ['name'=>'Agent 3'],
            ['name'=>'Agent 4'],
        ];
        
        //Insert data in the table
        DB::table('agents')->insert($agents);
    }
}
