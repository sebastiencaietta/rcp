<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function fetchAll(): JsonResponse
    {
        return response()->json(Tag::all());
    }
}
