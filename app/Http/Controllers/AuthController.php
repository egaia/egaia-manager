<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\DTO\RegisterUserDTO;
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

            //dd($exception);
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
}
