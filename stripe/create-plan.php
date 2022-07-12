<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function get_billing_cycle_date($unix_time = null) {
    if ( is_null($unix_time) ) $unix_time = time();

    $current_day = date('d', $unix_time);
    $current_month = date('m',$unix_time);
    $current_year = date('Y',$unix_time);

    if ( $current_day <= 18 ) {
        $billing_date = $current_year.'-'.$current_month.'-'.'18';
    } else {
        if ( $current_month < 12 ) 
            $billing_date  = $current_year.'-'.( $current_month + 1 ).'-'.'18';
        else 
            $billing_date = ( $current_year + 1 ).'-01-'.'18';
    }
    return strtotime($billing_date);
}

$static_date = strtotime('2022-06-08');
$billing_cycle_date = get_billing_cycle_date($static_date);
$trial_date = get_billing_cycle_date($static_date);

echo $billing_cycle_date.' Billing <> ' . date('Y-m-d',$billing_cycle_date);
echo "<br>";
echo $trial_date.' Trial <> ' . date('Y-m-d',$trial_date);
echo "<br>";
//die;

// https://stripe.com/docs/billing/subscription-resource?ui=API
require_once('vendor/autoload.php');

#Basic plan  - Plan Api ID: price_1L7chNSB2OlEnbVR5XkARUKp
#Pro Plan - Plain APi id: price_1L7dw4SB2OlEnbVR4IyYR4pK

  //$stripeObj =  new Stripe;

$stripe = new \Stripe\StripeClient([
    "api_key" => 'XXXXXXXXXXXXXXXXXXXXXxxxxx',
    "stripe_version" => "2020-08-27"
  ]);

 // \Stripe\Stripe::setVerifySslCerts(false);


/*for Creating new subsciption*/
$subscription = $stripe->subscriptions->create([
    'customer' => 'cus_Lq0P1BnM6kLN6N',
    'billing_cycle_anchor' => $billing_cycle_date, //
    'trial_end' => $billing_cycle_date, //
    'items' => [[
        'price' => 'price_1L7chNSB2OlEnbVR5XkARUKp',
    ]],
    //'metadata'    => array(),
    //'coupon'      => '',
    //'description' => ''
]);


echo "<pre>";
print_r($subscription);


# -d "trial_end"=1611008505 \
# -d "proration_behavior"="none" | 'always_invoice' |  default:'create_prorations'

