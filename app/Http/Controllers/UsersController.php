<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UsersRepositoryEloquent;
use App\Http\Requests\User\UpdateUserPhotoRequest;

class UsersController extends Controller {

    /**
     * Users Repository.
     * 
     * @var UsersRepositoryEloquent 
     */
    public $usersRepository;

    /**
     * 
     * @param UsersRepositoryEloquent $usersRepository
     */
    public function __construct(UsersRepositoryEloquent $usersRepository)
    {
        parent::__construct();
        $this->usersRepository = $usersRepository;
    }

    /**
     * Update the user's profile photo.
     *
     * @param  UpdateUserPhotoRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(UpdateUserPhotoRequest $request, User $user)
    {
        $this->usersRepository->update($request->all(), $user->id);
        return redirect()->back();
    }

}
