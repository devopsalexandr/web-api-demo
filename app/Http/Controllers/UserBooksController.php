<?php


namespace App\Http\Controllers;


use App\Http\Resources\BookResource;
use Illuminate\Contracts\Auth\Authenticatable;

class UserBooksController extends Controller
{
    public function index(Authenticatable $user)
    {
        $userBooks = $user->books()->paginate(5);

        return BookResource::collection($userBooks);
    }
}
