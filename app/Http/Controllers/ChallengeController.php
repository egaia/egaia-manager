<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\ChallengeCollection;
use App\Repositories\Challenge\ChallengeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ChallengeController extends Controller
{
    private ChallengeRepository $challengeRepository;

    public function __construct(ChallengeRepository $challengeRepository)
    {
        $this->challengeRepository = $challengeRepository;
    }

    public function getByUser(Request $request): JsonResponse {
        $user = auth('api')->user();

        try {
            $challenges = $this->challengeRepository->getFromUser($user);

            return response()->json([
                'success' => true,
                'challenges' => new ChallengeCollection($challenges, true)
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);
        }
    }
}
