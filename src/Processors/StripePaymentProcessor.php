<?php
/**
 * Date 11/04/2023
 *
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Ssiva\LaravelStripe\Processors;


use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripePaymentProcessor
{
    /**
     * @var StripeClient
     */
    protected StripeClient $stripe;
    private string $successUrl;
    private string $cancelUrl;

    public function __construct()
    {
        $this->setStripeClient();
    }

    private function setStripeClient(): void
    {
        $apiKey = config('services.stripe.secret');
        Stripe::setApiKey($apiKey);
        $this->successUrl = config('services.stripe.success_url');
        $this->cancelUrl = config('services.stripe.cancel_url');
        $this->stripe = new StripeClient(
            $apiKey
        );
    }

    /**
     * @throws ApiErrorException
     */
    public function createStripeCheckout($products, $order_uuid): array
    {
        $lineItems = $this->getLineItems($products);

        $checkoutSession = $this->stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $this->successUrl."/?order=$order_uuid",
            'cancel_url' => $this->cancelUrl."/?order=$order_uuid",
        ]);

        $checkoutSessionData = $this->stripe->checkout->sessions->retrieve($checkoutSession->id, []);

        return [
            'url' => $checkoutSessionData->url,
            'amount_total' => $checkoutSessionData->amount_total,
            'amount_subtotal' => $checkoutSessionData->amount_subtotal,
            'payment_status' => $checkoutSessionData->payment_status,
        ];
    }

    /**
     * @param $products
     * @return array
     */
    public function getLineItems($products): array
    {
        $lineItems = [];
        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => $product['product'],
                    ],
                    'unit_amount' => $product['price'],
                ],
                'quantity' => $product['quantity'],
            ];
        }
        return $lineItems;
    }
}
