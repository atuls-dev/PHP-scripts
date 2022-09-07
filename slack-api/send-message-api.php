<?php

/**
 * Send a Message to a Slack Channel.
 *
 * In order to get the API Token visit: 
 *
 * 1.) Create an Classic APP -> https://api.slack.com/apps?new_classic_app=1
 * 2.) See menu entry "Install App"
 * 3.) Use the "Bot User OAuth Token"
 * add needed permission for sending channel notifications
 *
 * The token will look something like this `xoxb-2100000415-0000000000-0000000000-ab1ab1`.
 * 
 * @param string $message The message to post into a channel.
 * @param string $channel The name of the channel prefixed with #, example #foobar
 * @return boolean
 */
function slack($message, $channel)
{
    $ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxbxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    	"channel" => $channel, //"#mychannel",
    	"text" => $message, //"Hello, Foo-Bar channel message.",
    	"username" => "MySlackBot2211",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    echo "<pre>"; print_r($result); echo "</pre>";
    return $result;
}

// Example message will post "Hello world" into the random channel
//slack('Hello world 444', {Channel});
//slack('Hello world 444', '#error-notification');
slack('Hello world 444', 'C03T8ACT7TM');