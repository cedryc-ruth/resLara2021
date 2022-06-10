<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Room;
use App\Models\Show;

class RepresentationSeeder extends Seeder
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
        Representation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $representations = [
            [
                'room_name'=>'Central Hall',
                'show_slug'=>'ayiti',
                'when'=>'2012-10-12 13:30',
            ],
            [
                'room_name'=>'Salle principale',
                'show_slug'=>'ayiti',
                'when'=>'2012-10-12 20:30',
            ],
            [
                'room_name'=>null,
                'show_slug'=>'cible-mouvante',
                'when'=>'2012-10-02 20:30',
            ],
            [
                'room_name'=>null,
                'show_slug'=>'ceci-nest-pas-un-chanteur-belge',
                'when'=>'2012-10-16 20:30',
            ],
        ];
        
        //Prepare the data
        foreach ($representations as &$data) {
            //Search the location for a given location's slug
            $room = Room::firstWhere('name',$data['room_name']);
            unset($data['room_name']);

            //Search the show for a given show's slug
            $show = Show::firstWhere('slug',$data['show_slug']);
            unset($data['show_slug']);
            
            $data['room_id'] = $room->id ?? null;
            $data['show_id'] = $show->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('representations')->insert($representations);
    }
}
