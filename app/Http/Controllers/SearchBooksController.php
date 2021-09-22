<?php


namespace App\Http\Controllers;


use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchBooksController extends Controller
{
    public function index(Request $request, Book $book): JsonResource
    {
        $payload = [];

        foreach ($request->all() as $key => $value){

            if($key == 'page') continue;

            $payload[] = [$key, 'LIKE', "%{$value}%"];
        }

//        $books = (count($payload) === 0) ? $book->all() : $book->where($payload)->paginate(21);
        $books = $book->where($payload)->paginate(21);

        return BookResource::collection($books);
    }
}
