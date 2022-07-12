<?php

  # Get api token by creating BOT in mobile app usign BOTFATHER channel
  
  $apiToken = "xxxxxxxxx:AAEsGasd6fWDdfAS0fcTlQh-rWaZE1VxdxYvkNcz";
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/getUpdates");
  
  echo "<pre>"; print_r(json_decode($response));
  # Response contains chat id's of groups in which your BOT is present

?>