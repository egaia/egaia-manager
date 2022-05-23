<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipateToChallengeRequest;
use App\Http\Resources\ChallengeResource;
use App\Http\Resources\Collections\ChallengeCollection;
use App\Repositories\Challenge\ChallengeRepository;
use App\Repositories\ChallengeUser\ChallengeUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ChallengeController extends Controller
{
    private ChallengeRepository $challengeRepository;
    private ChallengeUserRepository $challengeUserRepository;

    public function __construct(ChallengeRepository $challengeRepository, ChallengeUserRepository $challengeUserRepository)
    {
        $this->challengeRepository = $challengeRepository;
        $this->challengeUserRepository = $challengeUserRepository;
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

    public function all(Request $request): JsonResponse {
        $currentChallenge = $this->challengeRepository->getCurrentChallenge();
        $challenges = $this->challengeRepository->allByMonthYear();

        return response()->json([
            'success' => true,
            'currentChallenge' => $currentChallenge ? new ChallengeResource($currentChallenge) : null,
            'challenges' => $challenges
        ]);
    }

    public function participate(ParticipateToChallengeRequest $request): JsonResponse {
        $path = \request()->file('picture')->store('public/challenges');
        try {
            $challengeUser = $this->challengeUserRepository->store((int) $request->get('challenge_id'),$path,  auth('api')->user());

            return response()->json([
                'success' => true,
                'challenge_user' => $challengeUser
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);
        }
    }
}
