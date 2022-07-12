<?php
if ( isset($_POST['submit']) ) {
    
    $loc_top = $_POST['loc_top'];
    $loc_left = $_POST['loc_left'];
    $input_text = $_POST['txt_input'];

    // // Create the size of image or blank image
    //$image = imagecreatetruecolor(300, 300);
    $image = imagecreate(300, 300);

    // Set the background color of image
    $background_color = imagecolorallocate($image, 255, 0, 0);
      
    // Set the text color of image
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $fontfile= __DIR__.'/BeautyDemo.ttf';


    //print_r(imageresolution($image));exit;

    //imagestring($image, 5, $loc_left, $loc_top,  $input_text, $text_color);
    imagettftext($image, 25, 0, $loc_left, $loc_top, $text_color, $fontfile, $input_text);

    imageresolution($image, 600);
    //print_r(imageresolution($image)); exit;
    header("Content-Type: image/png");
  	//header('Content-Disposition: attachment; filename="test.png"');
    imagepng($image);
    imagedestroy($image);
    die;
}

?>
