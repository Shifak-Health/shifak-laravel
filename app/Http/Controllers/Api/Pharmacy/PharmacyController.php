<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Models\Pharmacy;
use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Retrieve all pharmacies.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Retrieve all pharmacies and return them as a collection of PharmacyResource
        $pharmacies = Pharmacy::all();

        return response()->json([
            'data' => PharmacyResource::collection($pharmacies)
        ]);
    }
}
