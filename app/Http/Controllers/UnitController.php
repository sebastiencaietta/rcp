<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\JsonResponse;

class UnitController extends Controller
{
    public function fetchAll(): JsonResponse
    {
        return response()->json(Unit::all());
    }
}
