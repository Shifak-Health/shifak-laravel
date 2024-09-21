<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;

use App\Models\DrugType;

class DrugTypeController extends Controller
{
    public function index()
    {
        return DrugType::query()->get(['id', 'name', 'unit']);
    }
}
