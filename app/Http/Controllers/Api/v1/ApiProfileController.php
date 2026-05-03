<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiProfileController extends Controller
{
    // GET /api/profiles
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $alreadyLikedIds = $user->likedUsers()->pluck('users.id');

        $allAnswers = UserAnswer::whereIn('user_id',
            User::where('id', '!=', $user->id)
                ->whereNotIn('id', $alreadyLikedIds)
                ->pluck('id')
        )->get()->groupBy('user_id');

        $userAnswers = UserAnswer::where('user_id', $user->id)
            ->pluck('answer', 'question_id');

        $compatibleIds = $allAnswers->filter(function ($answers) use ($userAnswers) {
            $candidateAnswers = $answers->pluck('answer', 'question_id');
            $commonQuestions = $userAnswers->intersectByKeys($candidateAnswers);

            if ($commonQuestions->isEmpty()) {
                return false;
            }

            return $commonQuestions->every(fn ($answer, $questionId) => $candidateAnswers[$questionId] === $answer
            );
        })->keys();

        return response()->json(
            User::whereIn('id', $compatibleIds)
                ->select('id', 'first_name', 'last_name', 'username')
                ->get()
        );
    }

    // GET /api/profiles/{username}
    public function show(string $username): JsonResponse
    {
        return response()->json(
            User::where('username', $username)
                ->select('id', 'first_name', 'last_name', 'username')
                ->firstOrFail()
        );
    }
}
