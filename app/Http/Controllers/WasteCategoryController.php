<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\WasteCategoryCollection;
use App\Http\Resources\WasteCategoryResource;
use App\Repositories\WasteCategory\WasteCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class WasteCategoryController extends Controller
{
    private WasteCategoryRepository $wasteCategoryRepository;

    public function __construct(WasteCategoryRepository $wasteCategoryRepository)
    {
        $this->wasteCategoryRepository = $wasteCategoryRepository;
    }

    public function all(Request $request): JsonResponse {
        $wasteCategories = $this->wasteCategoryRepository->all();

        return response()->json([
            'success' => true,
            'categories' => new WasteCategoryCollection($wasteCategories, true)
        ]);
    }

    public function show(Request $request, int $id): JsonResponse {
        try {
            $wasteCategory = $this->wasteCategoryRepository->find($id);

            return response()->json([
                'success' => true,
                'category' => new WasteCategoryResource($wasteCategory)
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);
        }
    }
}
