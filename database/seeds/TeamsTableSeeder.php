<?php

use Illuminate\Database\Seeder;
use App\Repositories\Eloquent\PlayersRepositoryEloquent;

class TeamsTableSeeder extends Seeder {

    /**
     * Players Repository.
     * 
     * @var PlayersRepositoryEloquent 
     */
    public $playersRepository;

    public function __construct(PlayersRepositoryEloquent $playersRepository)
    {
        $this->playersRepository = $playersRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Team::class, 16)->create()->each(function($team) {
            $team->players()->sync(
                    $this->playersRepository->getRandom(rand(6, 10))
            );
            $team->coach()->associate($this->playersRepository->getRandom(1)->first());
            $team->save();
        });
    }

}
