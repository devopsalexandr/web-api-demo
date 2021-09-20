<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Contracts\IUserService;
use App\Http\Requests\AdminCreateUserRequest;
use App\Models\User;

class AdminController extends Controller
{
    private ?IUserService $userService;

    public function __construct(IUserService $usr)
    {
        $this->userService = $usr;
    }

    public function addUser(AdminCreateUserRequest $request): User
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'slug' => mb_strtolower($request->first_name."-".$request->last_name)
        ]);
    }

    public function updateUser()
    {
        //
    }
    public function removeUser()
    {
        // notify user by sms
    }

    public function addBook()
    {
        //
    }

    public function updateBook()
    {
        //
    }
    public function deleteBook()
    {
        //
    }


}
