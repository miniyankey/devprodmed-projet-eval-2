<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\UserAnswer;
use App\Models\Question;

class UserAnswerController extends Controller
{
    // GET /questions
    public function index(Request $request): View
    {
        $user = $request->user();

        // Récupère toutes les questions avec la réponse de l'utilisateur si elle existe
        $questions = Question::with(['answers' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();

        return view('questions.index', compact('questions'));
    }

    // POST /questions
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Valide que chaque question a une réponse
        $validated = $request->validate([
            'answers'   => ['required', 'array', 'size:' . Question::count()],
            'answers.*' => ['required', 'in:a,b'],
        ], [
            'answers.size'     => 'Vous devez répondre à toutes les questions.',
            'answers.*.required' => 'Veuillez sélectionner une option pour chaque question.',
            'answers.*.in'     => 'La réponse doit être a ou b.',
        ]);

        // Upsert — insère ou met à jour si déjà répondu
        foreach ($validated['answers'] as $questionId => $answer) {
            UserAnswer::updateOrCreate(
                ['user_id' => $user->id, 'question_id' => $questionId],
                ['answer' => $answer]
            );
        }

        return redirect('/profiles')->with('success', 'Réponses enregistrées !');
    }
}
