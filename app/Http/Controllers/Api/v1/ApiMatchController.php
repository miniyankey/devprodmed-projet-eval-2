<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiMatchController extends Controller
{
    // GET /api/matches
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            $request->user()
                ->matches()
                ->select('users.id', 'users.first_name', 'users.last_name', 'users.username')
                ->get()
        );
    }
}
