<?php

// https://stripe.com/docs/billing/subscription-resource?ui=API
require_once('vendor/autoload.php');

#Basic plan  - Plan Api ID: price_1L7chNSB2OlEnbVR5XkARUKp
#Pro Plan - Plain APi id: price_1L7dw4SB2OlEnbVR4IyYR4pK


\Stripe\Stripe::setApiKey('sk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

\Stripe\Stripe::setVerifySslCerts(false);


/*for retrieving subsciption id*/
$subscription = \Stripe\Subscription::retrieve([
    'id' => 'sub_1L8KPkSB2OlEnbVRYNPBZwby' //subscription ID
]);


echo "<pre>";
echo "<a href='/upgrade-plan.php?sub={$subscription->id}'>Upgrade Plan</a><br><br>";
echo "<a href='/degrade-plan.php?sub={$subscription->id}'>Degrade Plan</a><br><br>";
print_r($subscription);



# -d "trial_end"=1611008505 \
# -d "proration_behavior" = values { default: 'create_prorations' | "none" | 'always_invoice'  }


echo date('Y-m-d', '1658082600');
