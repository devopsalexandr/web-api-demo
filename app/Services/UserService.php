<?php
declare(strict_types=1);

namespace App\Services;


use App\Contracts\IUserService;
use App\Models\User;

class UserService implements IUserService
{
    private ?User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function addBooksToUser(User $user, $books)
    {
        $user->books()->attach($books);
    }
}
