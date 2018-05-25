<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role([
            'name' => 'admin'
        ]);
        $role->save();

        $role = new Role([
            'name' => 'editor'
        ]);
        $role->save();

        $role = new Role([
            'name' => 'writer'
        ]);
        $role->save();
    }
}
