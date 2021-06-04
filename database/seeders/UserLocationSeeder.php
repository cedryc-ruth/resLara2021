<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Location;

class UserLocationSeeder extends Seeder
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
        DB::table('user_location')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $userLocations = [
            [
                'user_email'=>'ced@sull.com',
                'location_slug'=>'espace-delvaux-la-venerie',
                'note'=>3,
            ],
            [
                'user_email'=>'bob@sull.com',
                'location_slug'=>'espace-delvaux-la-venerie',
                'note'=>5,
            ],
            [
                'user_email'=>'ced@sull.com',
                'location_slug'=>'la-samaritaine',
                'note'=>1,
            ],
        ];
        
        //Prepare the data
        foreach ($userLocations as &$data) {
            //Search the artist for a given artist's firstname and lastname
            $user = User::where([
                ['email','=',$data['user_email'] ]
            ])->first();

            //Search the type for a given type
            $location = Location::firstWhere('slug',$data['location_slug']);
            
            unset($data['user_email']);
            unset($data['location_slug']);

            $data['user_id'] = $user->id;
            $data['location_id'] = $location->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('user_location')->insert($userLocations);
    }
}
