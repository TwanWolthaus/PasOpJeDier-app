<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;

use App\Models\User;
use App\Models\Transaction;


class ReviewController extends Controller
{
    public function store(HttpRequest $httpRequest, Transaction $userTransaction): RedirectResponse {

    }


    public function edit(Request $userRequest) {

    }


    public function update(HttpRequest $httpRequest, Transaction $userTransaction, User $user) {

        Gate::authorize('update', $userTransaction);

        if ($user->id == $userTransaction->sitter_id) {

            $validated = $httpRequest->validate([
                'review_sitter' => 'required|string|max:255',
            ]);
            $userTransaction->update($validated);

        } else {

            $validated = $httpRequest->validate([
                'review_owner' => 'required|string|max:255',
            ]);
            $userTransaction->update($validated);
        }

        return redirect(route('userRequests.index'));
    }


    public function destroy(Request $userRequest) {

    }
}
