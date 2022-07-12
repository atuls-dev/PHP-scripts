<?php

function autofit_text_to_image( $canvas_image_filename = false, $dest_filename = 'output.jpg', $text = '', $starting_font_size = 60, $max_width = 500, $max_height = 500, $x_pos = 0, $y_pos = 0, $font_file = false, $font_color = 'black', $line_height_ratio = 1, $dest_format = 'jpg' ) {
	// Bail if any essential parameters are missing
	if ( ! $canvas_image_filename || ! $dest_filename || empty($text) || ! $font_file || empty($font_color) || empty($max_width) || empty($max_height) ) return false;
	
	// Do we have a valid canvas image?
	if ( ! file_exists($canvas_image_filename) ) return;
	
	$canvas_handle = fopen( $canvas_image_filename, 'rb' );
	
	// Load image into Imagick
	$NewImage = new Imagick();
	$NewImage->readImageFile($canvas_handle);
	
	// Instantiate Imagick utility objects
	$draw = new ImagickDraw();
	$pixel = new ImagickPixel( $font_color );
	
	// Load Font 
	$font_size = $starting_font_size;
	$draw->setFont($font_file);
	$draw->setFontSize($font_size);
	
	// Holds calculated height of lines with given font, font size
	$total_height = 0;

	// Run until we find a font size that doesn't exceed $max_height in pixels
	while ( 0 == $total_height || $total_height > $max_height ) {
		if ( $total_height > 0 ) $font_size--; // we're still over height, decrement font size and try again
		
		$draw->setFontSize($font_size);
		
		// Calculate number of lines / line height
		// Props users Sarke / BMiner: http://stackoverflow.com/questions/5746537/how-can-i-wrap-text-using-imagick-in-php-so-that-it-is-drawn-as-multiline-text
		$words = preg_split('%\s%', $text, -1, PREG_SPLIT_NO_EMPTY);
		$lines = array();
		$i = 0;
		$line_height = 0;
	
		while ( count($words) > 0 ) { 
			$metrics = $NewImage->queryFontMetrics( $draw, implode(' ', array_slice($words, 0, ++$i) ) );
			$line_height = max( $metrics['textHeight'], $line_height );
	
			if ( $metrics['textWidth'] > $max_width || count($words) < $i ) {
				$lines[] = implode( ' ', array_slice($words, 0, --$i) );
				$words = array_slice( $words, $i );
				$i = 0;
			}
		}
		
		$total_height = count($lines) * $line_height * $line_height_ratio;
		
		if ( $total_height === 0 ) return false; // don't run endlessly if something goes wrong
	}
	
	// Writes text to image
	for( $i = 0; $i < count($lines); $i++ ) {
		$NewImage->annotateImage( $draw, $x_pos, $y_pos + ($i * $line_height * $line_height_ratio), 0, $lines[$i] );	
	}
	
	$NewImage->setImageFormat($dest_format);
	$result = $NewImage->writeImage($dest_filename);
	//die('dddffdd');
	
	return $result;
}

 $tets = autofit_text_to_image( 'background1.jpg', 'output.jpg', 'hello this is a text to fit', 100, 500, 500, 100,0,'HelveticaNeue-Bold.ttf','black', 1, 'jpg' );
print_r($tets);
//$font_file = false, $font_color = 'black', $line_height_ratio = 1, $dest_format = 'jpg' 

?>