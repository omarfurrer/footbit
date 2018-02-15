<?php

use Illuminate\Database\Seeder;
use App\Repositories\Eloquent\UsersRepositoryEloquent;

class RefereesTableSeeder extends Seeder {

    /**
     * Users Repository.
     * 
     * @var UsersRepositoryEloquent 
     */
    public $usersRepository;

    public function __construct(UsersRepositoryEloquent $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = $this->usersRepository->getRandom();
        $users->each(function($u) {
            $u->referee()->save(factory(App\Models\Referee::class)->make());
        });
    }

}
