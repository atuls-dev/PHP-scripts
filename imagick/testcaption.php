<?php
	$input_text = 'Hello this is a long text to fit in a angle with pixels';

    // converting mm to px
    $image_width = 600;
    $image_height = 450;

	$txt = new Imagick();
	$txt->setFont("HelveticaNeue-Bold.ttf");
	$txt->setGravity(imagick::GRAVITY_CENTER);
	$txt->newPseudoImage( $image_width, $image_height, "caption:" . $input_text );

	//$pdf->setImageCompression(Imagick::COMPRESSION_LZW);
    $txt->setImageCompressionQuality(100);
    $txt->setImageFormat("jpg");

    // output file in browser
    header("Content-Type: image/png");
    echo $txt;

?>