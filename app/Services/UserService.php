<?php
declare(strict_types=1);

namespace App\Services;


use App\Contracts\IUserService;
use App\Http\Requests\Admin\AdminUpdateUserRequest;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class UserService implements IUserService
{
    private ?User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function addBooksToUser(int $user_id, array $books_id): void
    {
        $user = $this->findUserById($user_id);

        $books = Book::findMany($books_id);

        if($user)
            $user->books()->attach($books);
    }

    public function updateUserById(int $user_id, array $data): bool
    {
        $user = $this->findUserById($user_id);

        if(!$user)
            return false;

       return $user->update($data);
    }

    public function findUserById($id): ?User
    {
        return $this->user->where('id', $id)->first();
    }

    public function deleteUserById(int $id): ?bool
    {
        $user = $this->findUserById($id);

        return $user->delete();
    }

}
