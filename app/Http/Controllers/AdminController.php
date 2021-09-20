<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Contracts\IUserService;

class AdminController extends Controller
{
    private ?IUserService $userService;

    public function __construct(IUserService $usr)
    {
        $this->userService = $usr;
    }

    public function addUser()
    {
        //
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
