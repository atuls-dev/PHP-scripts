<?php
	$input_text = 'hello this is a test to see if the text fits';

    // converting mm to pt
    // $image_width = 120 * 3.77;
    // $image_height = 360 * 3.77;
    $image_height = 120 * 2.83;
    $image_width = 360 * 2.83;

	$txt = new Imagick();
	$pixel = new ImagickPixel( 'white' );
	$txt->newImage($image_width, $image_height, $pixel);
	$txt->setFont("HelveticaNeue-Bold.ttf");
	//$txt->setGravity(imagick::GRAVITY_CENTER);
	$txt->setGravity(imagick::GRAVITY_WEST);
	$txt->newPseudoImage( $image_width, $image_height, "caption:" . $input_text );

	$txt->setImageCompression(imagick::COMPRESSION_NO);
    $txt->setImageCompressionQuality(100);
    $txt->setImageFormat("jpg");

    //$pdf = new Imagick();
    //$pdf->newImage($image_width, $image_height, $pixel);

    //$txt->BorderImage(new ImagickPixel("white") , 10, 10);

    //output file in browser
    header("Content-Type: image/jpg");
    echo $txt;
    exit;
?>