<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Contracts\IBookService;
use App\Contracts\IUserService;
use App\Http\Requests\Admin\AdminAddBookRequest;
use App\Http\Requests\Admin\AdminCreateUserRequest;
use App\Http\Requests\Admin\AdminUpdateBookRequest;
use App\Http\Requests\Admin\AdminUpdateUserRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    private ?IUserService $userService;

    private ?IBookService $bookService;

    private ResponseFactory $responseFactory;

    public function __construct(IUserService $usr, IBookService $booksrv, ResponseFactory $factory)
    {
        $this->userService = $usr;
        $this->bookService = $booksrv;
        $this->responseFactory = $factory;
    }

    public function addUser(AdminCreateUserRequest $request): JsonResponse
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'slug' => mb_strtolower($request->first_name."-".$request->last_name)
        ]);

        return $this->responseFactory->json(new UserResource($user), 201);
    }

    public function updateUser(AdminUpdateUserRequest $request): JsonResponse
    {
        $this->userService->updateUserById((int) $request->user_id, $request->all());

        return $this->responseFactory->json(null, 201);
    }

    public function removeUser(Request $request): JsonResponse
    {
        $validated = $request->validate(['user_id' => ['required']]);

        $deleted = $this->userService->deleteUserById((int) $validated["user_id"]);

        if($deleted){
            // notify user by sms
            //$this->smsService->sendSms("phone number", $text)
            return $this->responseFactory->json(null, 200);
        }

        return $this->responseFactory->json("Sorry but we can't delete this item", 400);
    }

    public function addBook(AdminAddBookRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'shortDescription' => $request->shortDescription
        ]);

        return $this->responseFactory->json(new BookResource($book), 201);
    }

    public function updateBook(AdminUpdateBookRequest $request)
    {
        $this->bookService->updateBookById((int) $request->book_id, $request->all());

        return $this->responseFactory->json(null, 201);
    }

    public function deleteBook(Request $request): JsonResponse
    {
        $validated = $request->validate(['book_id' => ['required']]);

        $deleted = $this->bookService->deleteBookById((int) $validated["book_id"]);

        return ($deleted)
            ? $this->responseFactory->json(null, 200)
            : $this->responseFactory->json("Sorry but we can't delete this item", 400);
    }
}
