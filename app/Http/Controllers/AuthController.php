<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PasswordUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\DTO\RegisterUserDTO;
use App\Models\DTO\UpdateUserDTO;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request): JsonResponse {
        $registerUserDTO = RegisterUserDTO::fromRequest($request);

        try {

            $user = $this->userRepository->store($registerUserDTO);

            return response()->json([
                'success' => true,
                'user' => new UserResource($user)
            ]);

        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);
        }
    }

    public function login(LoginUserRequest $request): JsonResponse {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            try {

                $user = $this->userRepository->findOrFailByEmail($credentials['email']);

                $user->last_login_at = now();
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'user' => new UserResource($user)
                ]);

            } catch (Throwable $exception) {

                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);

            }
        } else {

            return response()->json([
                'success' => false,
                'message' => trans('auth.failed'),
            ], 401);

        }
    }

    public function getByApiToken(Request $request): JsonResponse {
        $user = \auth('api')->user();

        if($user) {
            $user->last_login_at = now();
            $user->save();

            return response()->json([
                'success' => true,
                'user' => new UserResource($user)
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas authentifié',
            ], 401);
        }
    }

    public function checkPasswordValid(PasswordUserRequest $request): JsonResponse {
        $user = \auth('api')->user();
        $hasher = app('hash');

        if($hasher->check($request->get('password'), $user->password)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mot de passe incorrect'
            ]);
        }
    }

    public function update(UpdateUserRequest $request): JsonResponse {
        $apiUser = \auth('api')->user();

        $updateUserDTO = UpdateUserDTO::fromRequest($request);

        try {

            $user = $this->userRepository->update($apiUser, $updateUserDTO);

            return response()->json([
                'success' => true,
                'user' => new UserResource($user)
            ]);

        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);
        }
    }
}
