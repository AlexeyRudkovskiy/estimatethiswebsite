<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = $this->repository->findByEmail($email);

        // Check is password valid
        if (Hash::check($password, $user->password)) {
            $token = $user->createToken('app-token');
            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Unauthenticated.'
        ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    public function register(RegisterRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $payload = [
            'email' => $email,
            'password' => bcrypt($password),
            'name' => $name
        ];

        /** @var User $user */
        $user = $this->repository->create($payload);
        $token = $user->createToken('app-token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user
        ])->setStatusCode(Response::HTTP_CREATED);
    }

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

}
