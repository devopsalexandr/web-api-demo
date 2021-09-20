<?php


namespace App\Contracts;


interface IBookService
{
    public function deleteBookById(int $id): ?bool;
}
