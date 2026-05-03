<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiUserLikeController extends Controller
{
    // POST /api/likes/{username}
    public function store(Request $request, string $username): JsonResponse
    {
        $userLiked = User::where('username', $username)->firstOrFail();
        $user = $request->user();

        if ($user->id === $userLiked->id) {
            return response()->json(['message' => 'Cannot like yourself'], 422);
        }

        $existingLike = $user->likedUsers()->where('liked_user_id', $userLiked->id)->exists();

        if ($existingLike) {
            $user->likedUsers()->detach($userLiked->id);
            $liked = false;
        } else {
            $user->likedUsers()->attach($userLiked->id);
            $liked = true;
        }

        $isMatch = $liked && $user->matches()->where('users.id', $userLiked->id)->exists();

        return response()->json([
            'liked' => $liked,
            'match' => $isMatch,
        ]);
    }

    // GET /api/likes
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            $request->user()
                ->likedUsers()
                ->select('users.id', 'users.first_name', 'users.last_name', 'users.username')
                ->get()
        );
    }
}
