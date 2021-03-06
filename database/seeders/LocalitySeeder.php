<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Locality;

class LocalitySeeder extends Seeder
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
        Locality::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        //Define data
        $localities = [
            ['postal_code'=>'1000','locality'=>'Bruxelles'],
            ['postal_code'=>'1020','locality'=>'Laeken'],
            ['postal_code'=>'1210','locality'=>'St-Josse-Ten-Noode'],
            ['postal_code'=>'1030','locality'=>'Schaerbeek'],
            ['postal_code'=>'1040','locality'=>'Etterbeek'],
            ['postal_code'=>'1050','locality'=>'Ixelles'],
            ['postal_code'=>'1170','locality'=>'Watermael-Boistfort'],
        ];
        
        //Insert data in the table
        DB::table('localities')->insert($localities);
    }
}
