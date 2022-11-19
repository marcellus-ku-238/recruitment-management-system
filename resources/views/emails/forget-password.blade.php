@component('mail::message')
@lang('email.hello', [ 'user' => $user->name ]),

@lang('email.forgetPassword.line1')
<div class="text-center otp">
    {{ $user->otp ?? '0000' }}
</div>

<br>
@lang('email.line2')
<br>

<br>
@lang('email.thanks'),<br>
{{ config('app.name') }}<br>
@endcomponent
