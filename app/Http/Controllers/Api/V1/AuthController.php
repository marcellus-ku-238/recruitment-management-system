<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPassword;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Requests\Auth\SignIn;
use App\Services\AuthService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function signIn(SignIn $request)
    {
        $data = $this->service->signIn($request->validated());
        return $this->success($data);
    }

    public function login(Login $request)
    {
        $requestData = $request->validated();
        $data = $this->service->login($requestData);
        return $this->success($data);
    }

    public function forgetPassword(ForgetPassword $request)
    {
        $data = $this->service->forgetPassword($request->validated());
        return $this->success($data, 200);
    }

    public function resetPassword(ResetPassword $request)
    {
        $data = $this->service->resetPassword($request->validated());
        return $this->success($data, 200);
    }

    public function me()
    {
        $data = $this->service->me();
        return $this->success($data, 200);
    }

    public function logout()
    {
        $data = $this->service->logout();
        return $this->success($data, 200);
    }
}
