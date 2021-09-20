<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\IBookService;
use App\Models\Book;
use App\Models\User;

class BookService implements IBookService
{
    private ?Book $user;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function findBookById($id): ?Book
    {
        return $this->book->where('id', $id)->first();
    }

    public function deleteBookById(int $id): ?bool
    {
        $user = $this->findBookById($id);

        return $user->delete();
    }
}
