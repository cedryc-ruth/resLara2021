<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Show;
use App\Models\Tag;

class ShowTagSeeder extends Seeder
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
        DB::table('show_tag')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $showTags = [
            [
                'show_slug'=>'Ayiti',
                'tag'=>'soleil',
            ],
            [
                'show_slug'=>'Ayiti',
                'tag'=>'mer',
            ],
            [
                'show_slug'=>'cible-mouvante',
                'tag'=>'soleil',
            ],
        ];
        
        //Prepare the data
        foreach ($showTags as &$data) {
            //Search the artist for a given artist's firstname and lastname
            $show = Show::where([
                ['slug','=',$data['show_slug'] ],
            ])->first();

            //Search the type for a given type
            $tag = Tag::firstWhere('tag',$data['tag']);
            
            unset($data['show_slug']);
            unset($data['tag']);

            $data['show_id'] = $show->id;
            $data['tag_id'] = $tag->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('show_tag')->insert($showTags);
    }
}
