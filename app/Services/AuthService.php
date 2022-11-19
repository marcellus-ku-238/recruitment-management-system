<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\User;
use App\Notifications\ForgetPassword;
use Carbon\Carbon;
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
        if ($inputs['login_type'] === 'gmail') {
            return $this->gmailLogin($inputs);
        }

        if ($inputs['login_type'] === 'linked-in') {
            return $this->linkedInLogin($inputs);
        }

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

    public function resetPassword($inputs = [])
    {
        $user = $this->user->whereEmail($inputs['email'])->firstOrFail();

        if (empty($user->otp)) {
            throw new CustomException(__('messages.invalidCode'), 400);
        }

        if ($user->otp != $inputs['code']) {
            throw new CustomException(__('messages.invalidCode'), 400);
        }

        if (strtotime($user->otp_expired_at) < strtotime(Carbon::now())) {
            throw new CustomException(__('messages.expiredCode'), 400);
        }

        $user->update([
            'otp' => null,
            'otp_expired_at' => null,
            'password' => Hash::make($inputs['password'])
        ]);

        return [
            'message' => __('messages.passwordUpdated')
        ];
    }

    public function me()
    {
        $user = $this->user->findorFail(auth()->id());
        return $user;
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return [
            'message' => __('messages.logoutSucceed')
        ];
    }

    public function gmailLogin($inputs = [])
    {
        $user = $this->user
                ->whereEmail($inputs['email'])
                ->whereGmailId($inputs['gmailId'])
                ->first();

        if (!empty($user)) {
            return [
                'user' => $user,
                'token' => $user->createToken(config('app.name'))->plainTextToken
            ];
        }

        $user = $this->user
                ->whereEmail($inputs['email'])
                ->first();
        
        if (!empty($user) && empty($user->gmailId)) {
            $user->gmail_id = $inputs['gmailId'];
            $user->save();
        }

        return [
            'user' => $user,
            'token' => $user->createToken(config('app.name'))->plainTextToken
        ];
    }

    public function linkedInLogin($inputs = [])
    {
        $user = $this->user
                ->whereEmail($inputs['email'])
                ->wherelinkedInId($inputs['linkedInId'])
                ->first();

        if (!empty($user)) {
            return [
                'user' => $user,
                'token' => $user->createToken(config('app.name'))->plainTextToken
            ];
        }

        $user = $this->user
                ->whereEmail($inputs['email'])
                ->first();
        
        if (!empty($user) && empty($user->linkedInId)) {
            $user->linked_in_id = $inputs['linkedInId'];
            $user->save();
        }

        return [
            'user' => $user,
            'token' => $user->createToken(config('app.name'))->plainTextToken
        ];
    }
}