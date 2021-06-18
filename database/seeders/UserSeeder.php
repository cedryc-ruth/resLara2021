<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
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
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $users = [
            ['name'=>'bobette','email'=>'bob@sull.com','password'=>'epfcepfc'],
            ['name'=>'octavius','email'=>'octo@sull.com','password'=>'epfcepfc'],
            ['name'=>'red-partner','email'=>'partner@sull.com','password'=>'epfcepfc'],
        ];
        
        foreach($users as &$data) {
            $data['password'] = Hash::make($data['password']);
        }
        unset($data);

        //Insert data in the table
        DB::table('users')->insert($users);
    }
}
