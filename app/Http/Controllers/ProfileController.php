<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;



class ProfileController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(string $username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with(['user', 'likes'])
            ->get();

        return view('profiles.profile', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * Index all sibling profils
     */
    public function index(): View
    {
        $user = Auth::user();

        $userAnswers = UserAnswer::where('user_id', $user->id)
            ->pluck('answer', 'question_id');

        if ($userAnswers->isEmpty()) {
            return redirect("/questions");
        }

        $alreadyLikedIds = $user->likedUsers()->pluck('users.id');

        // Charge toutes les réponses des candidats en une seule requête
        $allAnswers = UserAnswer::whereIn('user_id',
            User::where('id', '!=', $user->id)
                ->whereNotIn('id', $alreadyLikedIds)
                ->pluck('id')
        )->get()->groupBy('user_id');

        // Filtre par compatibilité
        $compatibleIds = $allAnswers->filter(function ($answers) use ($userAnswers) {
            $candidateAnswers = $answers->pluck('answer', 'question_id');
            $commonQuestions = $userAnswers->intersectByKeys($candidateAnswers);

            if ($commonQuestions->isEmpty()) {
                return false;
            }

            return $commonQuestions->every(function ($answer, $questionId) use ($candidateAnswers) {
                return $candidateAnswers[$questionId] === $answer;
            });
        })->keys();

        $profiles = User::whereIn('id', $compatibleIds)->get();

        return view('profiles.index', compact('profiles'));
    }
}
