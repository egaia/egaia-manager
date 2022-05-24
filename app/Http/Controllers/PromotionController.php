<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsePromotionRequest;
use App\Http\Resources\Collections\PromotionCollection;
use App\Http\Resources\PromotionResource;
use App\Models\Pivots\PromotionUser;
use App\Models\Promotion;
use App\Repositories\Promotion\PromotionRepository;
use App\Repositories\PromotionUser\PromotionUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private PromotionUserRepository $promotionUserRepository;
    private PromotionRepository $promotionRepository;

    public function __construct(PromotionUserRepository $promotionUserRepository, PromotionRepository $promotionRepository)
    {
        $this->promotionUserRepository = $promotionUserRepository;
        $this->promotionRepository = $promotionRepository;
    }

    public function store(UsePromotionRequest $request): JsonResponse {
        $user = auth('api')->user();
        $promotion = Promotion::find((int) $request->get('promotion_id'));

        if($promotion && $user) {
            $promotionUserExists = PromotionUser::query()
                ->where('promotion_id', $promotion->id)
                ->where('user_id', $user->id)
                ->first();

            if(!$promotionUserExists) {
                if($user->points >= $promotion->cost) {
                    try {
                        $promotionUser = $this->promotionUserRepository->store($promotion, $user);

                        $user->points = $user->points - $promotion->cost;
                        $user->save();

                        return response()->json([
                            'success' => true,
                            'promotionUser' => $promotionUser
                        ]);
                    } catch (\Throwable $exception) {
                        return response()->json([
                            'success' => false,
                            'message' => $exception->getMessage()
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vous n\'avez pas assez de points pour bénéficier de cette promotion'
                    ], 403);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous avez déjà bénéficié de cette promotion'
                ], 403);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Promotion introuvable'
            ], 404);
        }
    }

    public function all(Request $request): JsonResponse {
        $promotions = $this->promotionRepository->all();

        return response()->json([
            'success' => true,
            'promotions' => new PromotionCollection($promotions)
        ]);
    }

    public function find(Request $request, int $id): JsonResponse {
        $promotion = $this->promotionRepository->find($id);

        if($promotion) {
            return response()->json([
                'success' => true,
                'promotion' => new PromotionResource($promotion)
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Promotion introuvable'
            ], 404);
        }
    }
}
