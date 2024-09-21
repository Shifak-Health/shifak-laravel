<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDrugTypeRequest;
use App\Http\Requests\UpdateDrugTypeRequest;
use App\Models\DrugType;

class DrugTypeController extends Controller
{
    public function index()
    {
        return DrugType::query()->get(['id', 'name', 'unit']);
    }
}
