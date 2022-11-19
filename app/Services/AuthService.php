<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\User;
use App\Notifications\ForgetPassword;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($inputs = [])
    {
        $user = $this->user
                    ->whereEmail($inputs['email'])->first();

        if (empty($user) && Hash::check($user->password, $inputs['password'])) {
            throw new CustomException(__('auth.failed'), 401);
        }

        return [
            'user' => $user,
            'token' => $user->createToken(config('app.name'))->plainTextToken
        ];
    }

    public function forgetPassword($inputs = [])
    {
        $user = $this->user->whereEmail($inputs['email'])->firstOrFail();

        $user->createOtp();

        $user->notify(new ForgetPassword($user));

        return [
            'message' => __('messages.forgotPassword') 
        ];
    }
}