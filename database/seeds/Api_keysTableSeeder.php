<?php

use Illuminate\Database\Seeder;

class Api_keysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Api_key::class, 100)->create();
    }
}
