<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo "Current time - " . date('Y-m-d h:i:s') . '<br>';

    if( file_exists("cache") && filemtime("cache") < time()-60 ) {

        $str = "Time". date('Y-m-d h:i:s') ."-".rand();
        echo $str;
        file_put_contents("cache",$str);
    }else{
        echo file_get_contents("cache");
    }

?>
