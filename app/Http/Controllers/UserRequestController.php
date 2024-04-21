<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Gate;


use App\Models\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models;

// use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index() {
        $authUser = Auth::user();
        $requests = Request::where('owner_id', $authUser['id'])
                    ->leftJoin('transaction', 'request.id', '=', 'transaction.request_id')
                    ->whereNull('transaction.request_id')
                    ->select('request.*')
                    ->get();

        return view('userRequests.index', compact('authUser', 'requests'));
    }

    public function store(HttpRequest $newRequest): RedirectResponse {

        $validated = $newRequest->validate([
            'pet_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'daily_rate' => 'required|numeric|between:0,99999.99',
            'description' => 'required|string|max:255',
        ]);

        $newRequest->user()->request()->create($validated);

        return redirect(route('userRequests.index'));
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

    public function destroy(Request $userRequest) {

        Gate::authorize('delete', $userRequest);

        $userRequest->delete();

        return redirect()->back();
    }
}
