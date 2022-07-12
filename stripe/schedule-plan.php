<?php
require_once('vendor/autoload.php');

$stripe = new \Stripe\StripeClient([
        "api_key" => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXxx',
        "stripe_version" => "2020-08-27" //api version given if other than default
        ]);

// $subId {sunscription id}

//creating schedule
$subscriptionSchedule = $stripe->subscriptionSchedules->create([
    'from_subscription' => $subId,
]);



// retrieving schedule
$subscriptionSchedule = $stripe->subscriptionSchedules->retrieve($scheduleId);


// updating schedule
$params = array(
    'end_behavior' => 'release',
    'phases' => array(
        array(
            'start_date' => $subscriptionSchedule->current_phase->start_date,
            'end_date' => $subscriptionSchedule->current_phase->end_date,
            'items' => [
                [
                'price' => 'active_plan_id_xxxxxxxxxxxxxx'
                ],
            ],
        ),
        array(
            'start_date' => $subscriptionSchedule->current_phase->end_date,
            'items' => [
                [
                    'price' => 'new_plan_id_xxxxxxxxxxxxxxx',
                ],
            ],
            'metadata' => array(),
        )
    )
);
$scheduleUpdate = $stripe->subscriptionSchedules->update(
    $subscriptionSchedule->id,
    $params
);


//release schedule if updating plan while in a schedule
$stripe->subscriptionSchedules->retrieve($scheduleId);
if( $subscriptionSchedule['status'] == 'active' || $subscriptionSchedule['status'] == 'not_started' ) {
    $resp = $subscriptionSchedule->release();
}

