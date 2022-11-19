<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        
    }

    public function login(Login $request)
    {
        $requestData = $request->validated();

    }
}
