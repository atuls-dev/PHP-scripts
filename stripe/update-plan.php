<?php 
// https://stripe.com/docs/billing/subscriptions/upgrade-downgrade
require_once('vendor/autoload.php')

$stripe = new \Stripe\StripeClient([
    "api_key" => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXxx',
    "stripe_version" => "2020-08-27" //api version given if other than default
    ]);

$params = array(
    'cancel_at_period_end' => false,
    'items' => [
        [
            'id' => $subscription->items->data[0]->id,
            'price' => 'plan_xxxxxxxxxxxx', //plan price api id
        ],
    ],
    'metadata' => array(),
    'coupon'   => '',
    'description' => '',
    'proration_behavior' => 'always_invoice' 
);
//proration_behavior = 'always_invoice' - if you want to invoice customer immediately for new plan
//proration_behavior = 'none' - if you want to invoice new updated plan at the end of next billing cycle


// $subId = subcription id
$subscriptionResponse = $stripe->subscriptions->update($subId,$params);