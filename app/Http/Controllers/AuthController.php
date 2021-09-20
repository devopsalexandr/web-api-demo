<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{

    public function register(RegisterFormRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'slug' => mb_strtolower($request->first_name."-".$request->last_name)
        ]);

        $token = $user->createToken("application")->plainTextToken;

        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }
}
