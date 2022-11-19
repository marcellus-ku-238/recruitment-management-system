<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPassword;
use App\Http\Requests\Auth\Login;
use App\Services\AuthService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;
    protected $serivce;

    public function __construct(AuthService $serivce)
    {
        $this->serivce = $serivce;
    }

    public function login(Login $request)
    {
        $requestData = $request->validated();
        $data = $this->serivce->login($requestData);
        return $this->success($data);
    }

    public function forgetPassword(ForgetPassword $request)
    {
        $data = $this->serivce->forgetPassword($request->validated());
        return $this->success($data, 200);
    }
}
