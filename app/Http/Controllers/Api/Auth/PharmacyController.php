<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\PharmacyRequest;
use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\JsonResponse;

class PharmacyController extends Controller
{
    public function store(PharmacyRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pharmacies', 'public');
            $validatedData['image'] = $path;
        }
        $pharmacy = Pharmacy::create($validatedData);

        return response()->json([
            'message' => 'Pharmacy created successfully.',
            'data' => $pharmacy,
        ], 201);
    }

    public function update(PharmacyRequest $request, Pharmacy $pharmacy): JsonResponse
    {
        $pharmacy->update($request->validated());

        return response()->json([
            'message' => 'Pharmacy updated successfully.',
            'data' => $pharmacy,
        ]);
    }
}
