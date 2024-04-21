<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Transaction;


class UserTransactionController extends Controller
{

    public function index() {
        return view('userTransactions.index');
    }


    public function mySitters() {
        $authUser = Auth::user();
        $transactions = $authUser->request->map(function ($request) {
            return $request->transaction;
        })->filter();

        return view('userTransactions.mySitters', compact('authUser', 'transactions'));
    }

    public function inMyCare() {
        $authUser = Auth::user();
        $transactions = Transaction::where('sitter_id', $authUser['id'])->get();

        return view('userTransactions.inMyCare', compact('authUser', 'transactions'));
    }
}
