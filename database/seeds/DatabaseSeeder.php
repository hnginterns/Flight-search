<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        // Disable foreign key checking because truncate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        App\User::truncate();
        
        factory(App\User::class, 10)->create();
         
        // Enable it back
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        // // $this->call(UsersTableSeeder::class);
        // $this->call(Api_keysTableSeeder::class);
    }
}
