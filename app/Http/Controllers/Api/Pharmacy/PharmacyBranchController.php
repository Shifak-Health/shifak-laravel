<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PharmacyBranch;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BranchRequest;

class PharmacyBranchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // Check if the request contains the `is_accept_expired` filter
        if ($request->has('is_accept_expired')) {
            $isAcceptExpired = $request->input('is_accept_expired');
            // Retrieve pharmacy branches where the parent pharmacy's `is_accept_expired` matches the request
            $branches = PharmacyBranch::whereHas('pharmacy', function ($query) use ($isAcceptExpired) {
                $query->where('is_accept_expired', $isAcceptExpired);
            })->get();
        } else {
            // Retrieve all pharmacy branches if no filter is applied
            $branches = PharmacyBranch::all();
        }

        return response()->json([
            'data' => $branches,
        ]);
    }
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
