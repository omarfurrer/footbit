<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(RefereesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(VenuesTableSeeder::class);
        $this->call(TournamentsTableSeeder::class);
    }

}
