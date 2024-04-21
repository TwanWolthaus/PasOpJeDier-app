<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;

use App\Models\User;
use App\Models\Request;



class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index() {
        return view('dashboard.index');
    }

    public function userOverview() {
        $users = User::orderBy('name', 'asc')->get();

        return view('dashboard.userOverview', compact('users'));
    }

    public function requestOverview() {
        $requests = Request::leftJoin('transaction', 'request.id', '=', 'transaction.request_id')
                        ->whereNull('transaction.request_id')
                        ->select('request.*')
                        ->get();

        return view('dashboard.requestOverview', compact('requests'));
    }

    public function alterUserStatus(HttpRequest $httpRequest) {

        $user = User::where('id', $httpRequest->userID)->first();

        $status = ($user->status += 1) % 2;

        $user->status = $status;
        $user->save();

        return redirect(route('dashboard.userOverview'));
    }
}
