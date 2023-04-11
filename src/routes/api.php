<?php

/**
 * Date 10/04/2023
 * @author   Simon Siva <simonsiva13@gmail.com>
 */


use Ssiva\LaravelStripe\Controllers\StripeWebhookController;

Route::get('v1/stripe/success', [StripeWebhookController::class, 'handleSuccess'])->name('stripe-success');
Route::get('v1/stripe/fail', [StripeWebhookController::class, 'handleFail'])->name('stripe-fail');

