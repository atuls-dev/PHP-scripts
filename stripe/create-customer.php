<?php

require_once('vendor/autoload.php');


$stripe = new \Stripe\StripeClient([
        "api_key" => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXxx',
        "stripe_version" => "2020-08-27" //api version given if other than default
        ]);

$customer = $stripe->customers->create( array( "email" => 'customer@test.com') );


// Creating test clock & customer within it
$clock_obj = $stripe->testHelpers->testClocks->create([
	'frozen_time' => time(),
	'name' => uniqid('clock')
  ]);
$customer = $stripe->customers->create( array( "email" => 'test@customer.com', 'test_clock' => $clock_obj->id ) );



//customer update added default source cards

$customer = $stripe->customers->update(
    $stripe_customer_id,
    ['default_source' => $this->input->post('cards')]
  );

// retrieving cards
$card = $stripe->customers->retrieveSource(
    $stripe_customer_id,
    $this->input->post('cards'),
    []
  );