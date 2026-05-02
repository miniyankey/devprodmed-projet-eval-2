<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchController extends Controller
{
    /**
     * Index all matches
     */
    public function index(Request $request): View
    {
        $matches = $request->user()
            ->matches()
            ->select('users.id', 'users.first_name', 'users.username')
            ->get();

        return view('matches.index', compact('matches'));
    }
}
