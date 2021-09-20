<?php


namespace App\Contracts;


use App\Http\Requests\Admin\AdminUpdateUserRequest;

interface IUserService
{
    public function updateUserById(int $user_id, array $data): bool;

    public function deleteUserById(int $id): ?bool;

}
