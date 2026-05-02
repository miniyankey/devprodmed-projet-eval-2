<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAnswers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si les préférences ne sont pas définies...
        if (!$user->hasAnswers()) {
            // On sauvegarde l'URL voulue en session
            session()->put('url.intended', $request->fullUrl());

            return redirect('/questions');
        }

        return $next($request);
    }
}
