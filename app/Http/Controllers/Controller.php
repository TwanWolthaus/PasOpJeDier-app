<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    protected function goBack(): RedirectResponse {
        return history.back();
    }
}

