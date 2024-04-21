<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;

use Illuminate\Support\Facades\Validator;



use Illuminate\Support\Facades\Gate;
use App\Policies\TransactionPolicy;
use App\Models\Transaction;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $httpRequest)
    {

        $validated = $httpRequest->validate([
            'request_id' => 'required|integer',
            'sitter_id' => 'required|integer',
        ]);
        // dd($validated);

        Transaction::create($validated);

        // $httpRequest->user()->request()->create

        return redirect(route('requests.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HttpRequest $httpRequest, Transaction $transaction) {

        $validated = $httpRequest->validate([
            'review_sitter' => 'nullable|string|max:255',
            'review_owner' => 'nullable|string|max:255',
        ]);

        $transaction->update($validated);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
