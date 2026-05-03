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

        if (! $user->hasAnswers()) {
            // API → JSON, pas de redirect
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'You must answer all questions first.',
                ], 403);
            }

            // Web → redirect
            session()->put('url.intended', $request->fullUrl());

            return redirect('/questions');
        }

        return $next($request);
    }
}
