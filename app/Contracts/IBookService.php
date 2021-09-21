<?php


namespace App\Contracts;


interface IBookService
{
    public function deleteBookById(int $id): ?bool;

    public function updateBookById(int $book_id, array $data): bool;
}
