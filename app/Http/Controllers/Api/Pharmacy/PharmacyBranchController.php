<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Models\User;
use App\Models\PharmacyBranch;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BranchRequest;

class PharmacyBranchController extends Controller
{
    public function index() {}

    public function show() {}

    public function store(BranchRequest $request): JsonResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validated();

        // Create the pharmacy branch
        $branch = PharmacyBranch::create($validatedData);

        // Return the response
        return response()->json([
            'message' => 'Pharmacy branch created successfully.',
            'data' => $branch,
        ], 201);
    }
}
