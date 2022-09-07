<?php

/*
	Create incoming webhook in the Slack admin area, & copy the url
	https://my.slack.com/services/new/incoming-webhook
	
	Select the workspace and channel
	Webhook URL:-
	https://hooks.slack.com/services/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


	Some simple code for creating and sending massage:

    Create a client by passing the hook url (copied in 1 step)
    Send the message

*/



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');


$settings = [
	'username' => 'Bot',
	'channel' => '#error-notification', // channel name
	'link_names' => true
];

$client = new Maknz\Slack\Client('https://hooks.slack.com/services/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', $settings);
$client->send('Hello world 6666!');