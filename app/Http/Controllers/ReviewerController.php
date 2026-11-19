<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReviewerController extends Controller
{
    public function show(User $user)
    {
        $user->load([
            'reviews' => fn ($query) => $query->latest()->with('eatery'),
        ]);

        return view('reviewers.show', compact('user'));
    }
}