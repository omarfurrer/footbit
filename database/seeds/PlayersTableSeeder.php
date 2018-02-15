<?php

use Illuminate\Database\Seeder;
use App\Repositories\Eloquent\UsersRepositoryEloquent;

class PlayersTableSeeder extends Seeder {

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
        $users = $this->usersRepository->all();
        $users->each(function($u) {
            $u->player()->save(factory(App\Models\Player::class)->make());
        });
    }

}
