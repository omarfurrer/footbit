<?php

use Illuminate\Database\Seeder;
use App\Repositories\Eloquent\StatsRepositoryEloquent;

class StatsTableSeeder extends Seeder {

    /**
     * Stats Repository.
     * 
     * @var StatsRepositoryEloquent 
     */
    public $statsRepository;

    public function __construct(StatsRepositoryEloquent $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->statsRepository->create(['name' => 'shot on goal', 'type' => null]);
    }

}
