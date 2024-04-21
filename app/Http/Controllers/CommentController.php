<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;

use App\Models\Comment;


class CommentController extends Controller
{
    public function store(HttpRequest $httpRequest) {

        $validated = $httpRequest->validate([
            'request_id' => 'required|integer',
            'user_id' => 'required|integer',
            'text' => 'required|string|max:255',
        ]);

        $httpRequest->user()->comment()->create($validated);

        return redirect()->back();
    }

    public function edit(Request $userRequest) {

        Gate::authorize('update', $userRequest);

        return view('userRequests.edit', ['userRequest' => $userRequest]);
    }

    public function update(HttpRequest $newRequest, Request $userRequest) {

        Gate::authorize('update', $userRequest);

        $validated = $newRequest->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'daily_rate' => 'required|numeric|between:0,99999.99',
            'description' => 'required|string|max:255',
        ]);

        $userRequest->update($validated);

        return redirect(route('userRequests.index'));
    }

    public function destroy(Comment $comment) {

        Gate::authorize('delete', $comment);

        $comment->delete();

        return redirect(route('requests.index'));
    }
}
