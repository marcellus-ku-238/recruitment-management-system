<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $subscriptions = $stripe->products->all();

        return $this->success($subscriptions);
    }

    public function store(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $user = User::find(auth()->id());
        
        if (empty($user)) {
            throw new CustomException('Entity not found.');
        }

        $user->createOrGetStripeCustomer();
        // dd($user->createSetup
        $user->newSubscription('default', $request->plan)->create($request->payment_method, [
            'email' => $user->email
        ]);


        return $this->success([
            'message' => 'Subscription created successfully.'
        ]);
    }
}
