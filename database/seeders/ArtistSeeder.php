<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;

class ArtistSeeder extends Seeder
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
        Artist::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $artists = [
            ['firstname'=>'Daniel','lastname'=>'Marcelin','agent'=>'Agent 1'],
            ['firstname'=>'Philippe','lastname'=>'Laurent','agent'=>'Agent 1'],
            ['firstname'=>'Marius','lastname'=>'Von Mayenburg','agent'=>'Agent 1'],
            ['firstname'=>'Olivier','lastname'=>'Boudon','agent'=>'Agent 2'],
            ['firstname'=>'Anne Marie','lastname'=>'Loop'],
            ['firstname'=>'Pietro','lastname'=>'Varasso'],
            ['firstname'=>'Laurent','lastname'=>'Caron','agent'=>'Agent 3'],
            ['firstname'=>'Élena','lastname'=>'Perez'],
            ['firstname'=>'Guillaume','lastname'=>'Alexandre'],
            ['firstname'=>'Claude','lastname'=>'Semal'],
            ['firstname'=>'Laurence','lastname'=>'Warin'],
            ['firstname'=>'Pierre','lastname'=>'Wayburn'],
            ['firstname'=>'Gwendoline','lastname'=>'Gauthier'],
        ];
        
        for($i=0;$i<sizeof($artists);$i++) {
            if(isset($artists[$i]['agent'])) {
                $agent = DB::table('agents')->where('name',$artists[$i]['agent'])->first();

                if($agent) {
                    $artists[$i]['agent_id'] = $agent->id;
                    unset($artists[$i]['agent']);
                }
            } else {
                $artists[$i]['agent_id'] = null;
            }
        }

        //Insert data in the table
        DB::table('artists')->insert($artists);
    }
}
