<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($inputs = [])
    {
        
    }
}