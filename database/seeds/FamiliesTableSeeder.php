<?php

use Illuminate\Database\Seeder;
use App\Family;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        Family::truncate();
        factory(Family::class, 10)->create();
        DB::statement('SET foreign_key_checks=1');
    }
}
