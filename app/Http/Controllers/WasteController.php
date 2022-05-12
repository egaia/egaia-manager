<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\WasteCollection;
use App\Http\Resources\WasteResource;
use App\Repositories\Waste\WasteRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class WasteController extends Controller
{
    private WasteRepository $wasteRepository;

    public function __construct(WasteRepository $wasteRepository)
    {
        $this->wasteRepository = $wasteRepository;
    }

    public function all(Request $request): JsonResponse {
        $wastes = $this->wasteRepository->all();

        return response()->json([
            'success' => true,
            'wastes' => new WasteCollection($wastes, true)
        ]);
    }

    public function show(Request $request, int $id): JsonResponse {
        try {
            $waste = $this->wasteRepository->find($id);

            return response()->json([
                'success' => true,
                'waste' => new WasteResource($waste)
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], intval($exception->getCode()) !== 0 ? intval($exception->getCode()) : 500);
        }
    }
}
