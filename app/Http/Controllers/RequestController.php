<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Request;
use App\Models\Comment;
use App\Models\Pet;

use Illuminate\Support\Facades\DB;


class RequestController extends Controller {

    function buildOpenRequests()  {

        $openRequests = Request::leftJoin('transaction', 'request.id', '=', 'transaction.request_id')
                    ->whereNull('transaction.request_id')
                    ->select('request.*');
        return $openRequests;
    }

    function getComments()  {
        $comments = Comment::orderBy('comment.created_at', 'asc')->get();
        return $comments;
    }


    public function index() {
        $comments = $this->getComments();
        $authUser = Auth::user();
        $requests = $this->buildOpenRequests()->get();

        return view('requests.index', compact('requests', 'comments', 'authUser'));
    }

    public function sort($category) {
        $comments = $this->getComments();
        $authUser = Auth::user();
        $requests = $this->buildOpenRequests();

        if ($category === 'rate') {
            $requests = $requests->orderBy('daily_rate', 'desc')->paginate(50);
        }
        elseif ($category === 'durationAsc') {
            $requests = $requests->selectRaw('DATEDIFF(end_date, start_date) as duration')
                        ->orderBy('duration', 'asc')
                        ->get();
        }
        elseif ($category === 'durationDesc') {
            $requests = $requests->selectRaw('DATEDIFF(end_date, start_date) as duration')
                        ->orderBy('duration', 'desc')
                        ->get();
        }
        elseif ($category === 'species') {
            $requests = $requests->leftJoin('pet', 'request.pet_id', '=', 'pet.id')
                        ->orderBy('pet.species', 'asc')
                        ->paginate(50);
        }
        elseif ($category === 'fromUser') {
            $requests = $requests->where('request.owner_id', '=', $authUser['id'])
                        ->get();
        }

        return view('requests.index', compact('requests', 'comments', 'authUser'));
    }

    public function show($ID) {
        $request = Request::where('id', $ID)->first();
        abort_if(is_null($request), 404);

        $pet = $request->pet;
        $owner = $request->user;

        $startDate = \Carbon\Carbon::parse($request['start_date']);
        $endDate = \Carbon\Carbon::parse($request['end_date']);
        $duration = $startDate->diffInDays($endDate);

        return view('requests.show')->with('request', $request)->with('pet', $pet)->with('duration', $duration)->with('owner', $owner);
    }
}
