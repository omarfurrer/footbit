<?php

use Illuminate\Database\Seeder;

class TournamentsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tournament::class, 3)->create();
    }

}
