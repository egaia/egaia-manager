<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\CollectPointCollection;
use App\Repositories\CollectPoint\CollectPointRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollectPointController extends Controller
{
    private CollectPointRepository $collectPointRepository;

    public function __construct(CollectPointRepository $collectPointRepository)
    {
        $this->collectPointRepository = $collectPointRepository;
    }

    public function getAll(Request $request): JsonResponse {
        $latitude = $request->get('latitude') ? (float) $request->get('latitude') : 45.764043;
        $longitude = $request->get('longitude') ? (float) $request->get('longitude') : 4.835659;

        $collectPoints = $this->collectPointRepository->all($latitude, $longitude);

        return response()->json([
            'success' => true,
            'collectPoints' => new CollectPointCollection($collectPoints)
        ]);
    }
}
