<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Support\Carbon;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<3; $i++) {
            DB::table('role_user')->insert([
              "user_id" => User::get()->random()->id,  
              "role_id" => Role::get()->random()->id,
              "created_at" => Carbon::now()->subHours(rand(0, 9999)),  
              "updated_at" =>  Carbon::now()->subHours(rand(0, 9999))  
            ]);
        }
    }
}
