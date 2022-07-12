<?php
//phpinfo();

/*$fontfile= __DIR__.'/BeautyDemo.ttf';
echo $fontfile;
die;
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//echo $fdd;

// // Create the size of image or blank image
// $image = imagecreate(500, 300);
  
// // Set the background color of image
// $background_color = imagecolorallocate($image, 0, 153, 0);
  
// // Set the text color of image
// $text_color = imagecolorallocate($image, 255, 255, 255);
  
// // Function to create image which contains string.
// imagestring($image, 5, 180, 100,  "GeeksforGeeks", $text_color);
// imagestring($image, 3, 160, 120,  "A computer science portal", $text_color);
  
// header("Content-Type: image/png");
  
// imagepng($image);
// imagedestroy($image);
  





// // Create the size of image or blank image
// $image = imagecreate(500, 300);
  
// // Set the vertices of polygon
// $values = array(
//             50,  50,  // Point 1 (x, y)
//             50, 250,  // Point 2 (x, y)
//             250, 50,  // Point 3 (x, y)
//             250,  250 // Point 3 (x, y)
//         );
// // Set the background color of image
// $background_color = imagecolorallocate($image,  0, 153, 0);
     
// // Fill background with above selected color
// imagefill($image, 0, 0, $background_color);
   
// // Allocate a color for the polygon
// $image_color = imagecolorallocate($image, 255, 255, 255);
     
// // Draw the polygon
// imagepolygon($image, $values, 4, $image_color);
     
// // Output the picture to the browser
// header('Content-type: image/png');
     
// imagepng($image);

//$_POST['txt_input'] = 'testing text';
	
	$img = imagecreatefromjpeg('background7.jpeg');
	
	// THE IMAGE SIZE
	$width = imagesx($img);
	$height = imagesy($img);
	//echo 'w'.$width.'h'.$height;
	$target_width  = 400;
	$target_height = 300;
	$target_layer = imagecreatetruecolor($target_width,$target_height);
	imagecopyresampled($target_layer,$img,0,0,0,0,$target_width,$target_height, $width,$height);

	//  Set the text color of image
	$text_color = imagecolorallocate($target_layer, 0, 0, 0);
	
    $fontfile= __DIR__.'/BeautyDemo.ttf';

	// // Function to create image which contains string.
	//imagestring($target_layer, 5, 150, 150,  "Center Text", $text_color);
    
    imagettftext($target_layer, 3, 0, 150, 150, $text_color, $fontfile, "Center Text");

	header("Content-Type: image/png");
  
	imagepng($target_layer);
	imagedestroy($target_layer);
	
    print_r($target_layer);

?>
<?php 
die();
if (!empty($_POST['txt_input'])) {
  // FETCH IMAGE & WRITE TEXT
  $img = imagecreatefromjpeg('background7.jpeg');
  $white = imagecolorallocate($img, 255, 255, 255);
  $txt_input = $_POST['txt_input'];
  $txt = wordwrap($txt_input, 35, "\n", TRUE);
  $font = "/var/www/html/text-on-img-php/arial.ttf"; 
  $font_size = 38;
        $angle = 0;
        $text_color = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);

  // THE IMAGE SIZE
  $width = imagesx($img);
  $height = imagesy($img);


  $splittext = explode ( "\n" , $txt );
  $lines = count($splittext);
        $i = 0;
  foreach ($splittext as $text) {
      $text_box = imagettfbbox($font_size, $angle, $font, $txt);
      $text_width = abs(max($text_box[2], $text_box[4]));
      $text_height = abs(max($text_box[5], $text_box[7]));
      $x = (imagesx($img) - $text_width)/2;
      $y = ((imagesy($img) + $text_height)/2)-($lines-2)*$text_height-30;
      $lines=$lines-1;
      $y = $y+$i*30;
      $i++;
      imagettftext($img, $font_size, $angle, $x, $y, $text_color, $font, $text);
      // break;
  }



  // OUTPUT IMAGE
  header('Content-type: image/jpeg');
        header("Cache-Control: no-store, no-cache");  
        header('Content-Disposition: attachment; filename="'.str_replace(' ', '-', $txt_input).'.jpg"');
  imagejpeg($img);
  imagedestroy($jpg_image);
}
?>
<html>
<head>
<title>Php create image with some text and a background with example</title>
<style type="text/css">
body {
width: 550px;
font-family: Arial;
}
#submit {
padding: 10px 40px;
background: #586e75;
border: #485c61 1px solid;
color: #FFF;
border-radius: 2px;
cursor:pointer;
}
#form {
background-color: lightblue;
}
.form-row {
padding: 20px;
border-top: #8aacb7 1px solid;
}
.input-field {
background: #FFF;
padding: 10px;
margin-left: 15px;
width: 250px;
border-radius: 2px;
border: #8aacb7 1px solid;
}
.button-row {
padding: 10px 20px;
border-top: #8aacb7 1px solid;
}
</style>
</head>
<body>
    <h3>Php create image with some text and a background with example</h3>
    <form name="form" id="form" method="post" action="">
        <div class="form-row">
            <div>
                <label>Enter Text:</label> <input type="text"
                    class="input-field" name="txt_input" >
            </div>
        </div>
        <div class="button-row">
            <input type="submit" id="submit" name="submit"
                value="Create Image">
        </div>
    </form>
</body>
</html>
