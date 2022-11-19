<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\User;
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
}