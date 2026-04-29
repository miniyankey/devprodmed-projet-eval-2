<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserAnswer;

class UserLikeController extends Controller
{
    /**
     * Add or remove a user liked
     */
    public function store(Request $request, string $username)
    {
        $userLiked = User::where('username', $username)->firstOrFail();
        $user = $request->user();

        // Empêche de se liker soi-même
        if ($user->id === $userLiked->id) {
            return redirect("/@$username")->with('error', 'Cannot like yourself');
        }

        // Vérifie la compatibilité des réponses
        $userAnswers = UserAnswer::where('user_id', $user->id)
            ->pluck('answer', 'question_id');

        $likedUserAnswers = UserAnswer::where('user_id', $userLiked->id)
            ->pluck('answer', 'question_id');

        // Questions en commun
        $commonQuestions = $userAnswers->intersectByKeys($likedUserAnswers);

        if ($commonQuestions->isEmpty()) {
            return redirect("/@$username")->with('error', 'No common questions answered');
        }

        // Vérifie que toutes les réponses communes sont identiques
        $isCompatible = $commonQuestions->every(function ($answer, $questionId) use ($likedUserAnswers) {
            return $likedUserAnswers[$questionId] === $answer;
        });

        if (! $isCompatible) {
            return redirect("/@$username")->with('error', 'Answers are not compatible');
        }

        // Like / Unlike
        $existingLike = $user->likedUsers()->where('liked_user_id', $userLiked->id)->exists();

        if ($existingLike) {
            $user->likedUsers()->detach($userLiked->id);
        } else {
            $user->likedUsers()->attach($userLiked->id);
        }

        return redirect("/@$username");
    }
}
