<?php

use Illuminate\Database\Seeder;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            'name' => 'OwnerEntety',
            'licence' => 'SINGLE',
            'expires' => '2055-01-01',
        ]);
    }
}
