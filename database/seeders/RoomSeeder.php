<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Location;

class RoomSeeder extends Seeder
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
        Room::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $rooms = [
            [
                'name'=>'Central Hall',
                'seats'=>500,
                'location_slug'=>'espace-delvaux-la-venerie',
            ],
            [
                'name'=>'Salle intimiste',
                'seats'=>50,
                'location_slug'=>'espace-delvaux-la-venerie',
            ],
            [
                'name'=>'Salle principale',
                'seats'=>400,
                'location_slug'=>'dexia-art-center',
            ],
            [
                'name'=>'Samaritaine Grande',
                'seats'=>350,
                'location_slug'=>'la-samaritaine',
            ],
            [
                'name'=>'Samaritaine Petite',
                'seats'=>50,
                'location_slug'=>'la-samaritaine',
            ],
        ];
        
        //Prepare the data
        foreach ($rooms as &$data) {
            //Search the location for a given location's slug
            $location = Location::firstWhere('slug',$data['location_slug']);
            unset($data['location_slug']);

            $data['location_id'] = $location->id ?? null;
        }
        unset($data);

        //Insert data in the table
        DB::table('rooms')->insert($rooms);
    }
}
