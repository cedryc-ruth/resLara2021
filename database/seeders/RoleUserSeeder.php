<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class RoleUserSeeder extends Seeder
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
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $roleUsers = [
            [
                'user_email'=>'bob@sull.com',
                'role'=>'admin',
            ],
            [
                'user_email'=>'octo@sull.com',
                'role'=>'member',
            ],
            [
                'user_email'=>'partner@sull.com',
                'role'=>'affiliate',
            ],
        ];
        
        //Prepare the data
        foreach ($roleUsers as &$data) {
            $user = User::firstWhere('email',$data['user_email']);
            $role = Role::firstWhere('role',$data['role']);
            
            unset($data['user_email']);
            unset($data['role']);

            $data['user_id'] = $user->id;
            $data['role_id'] = $role->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('role_user')->insert($roleUsers);
    }
}
