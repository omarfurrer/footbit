<?php

use Illuminate\Database\Seeder;
use App\Repositories\Eloquent\UsersRepositoryEloquent;

class UsersTableAdminSeeder extends Seeder {

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
        $this->usersRepository->create([
            'name' => 'Omar Furrer',
            'username' => 'omar.furrer',
            'email' => 'omar.furrer@gmail.com',
            'password' => '123456',
            'phone_number' => '00201005214486',
            'date_of_birth' => '1992-09-15',
            'is_admin' => true
        ]);
    }

}
