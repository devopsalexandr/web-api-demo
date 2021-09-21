<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginFromRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterFormRequest $request): UserResource
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'slug' => mb_strtolower($request->first_name."-".$request->last_name)
        ]);

        $token = $user->createToken("application")->plainTextToken;

        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function login(LoginFromRequest $request, User $user): UserResource
    {
        $user = $user->where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken("application")->plainTextToken;

        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function logout(Request $request, ResponseFactory $factory)
    {
        $request->user()->tokens()->delete();
        return $factory->make("", 200);
    }
}
