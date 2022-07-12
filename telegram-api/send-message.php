<?php
   # Get api token by creating BOT in mobile app usign BOTFATHER channel

  $apiToken = "xxxxxxxxx:AAEsGasd6fWDdfAS0fcTlQh-rWaZE1VxdxYvkNcz";
  $data = [
      'chat_id' => '-123456789', // chat id of group where you want your bot is post a message
      'text' => 'Hello from PHP 123456!'
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
                                 http_build_query($data) );

  echo "<pre>"; print_r(json_decode($response));

?>
