<?php
/**
 * Date 11/04/2023
 *
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Ssiva\LaravelStripe\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Stripe\Stripe;

class StripeWebhookController extends Controller
{
    public function __construct()
    {
        $apiKey = config('services.stripe.secret');
        Stripe::setApiKey($apiKey);
    }
    
    public function handleFail(Request $request): RedirectResponse
    {
        $redirectUrl = config('services.stripe.redirect_url');
        return redirect()->route(
            $redirectUrl, ['order_uuid' => $request->get('order'), 'status' => 'fail', 'gtw' => 'stripe']
        );
    }
    
    public function handleSuccess(Request $request): RedirectResponse
    {
        $redirectName = config('services.stripe.redirect_url');
        return redirect()->route(
            route: $redirectName, parameters: [
                'order_uuid' => $request->get('order'),
                'status' => 'success',
                'gtw' => 'stripe',
            ], headers: ['_method' => 'PATCH']
        );
    }
}
