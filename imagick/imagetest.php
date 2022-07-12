<?php

    function file_newname($path, $filename){
        if ($pos = strrpos($filename, '.')) {
               $name = substr($filename, 0, $pos);
               $ext = substr($filename, $pos);
        } else {
               $name = $filename;
        }

        $newpath = $path.'/'.$filename;
        $newname = $filename;
        $counter = 1;
        while (file_exists($newpath)) {
               $newname = $name .'_'. $counter . $ext;
               $newpath = $path.'/'.$newname;
               $counter++;
         }

        return $newname;
    }


    $angle = 0;
    if( isset($_POST['orientation']) ) {
        $angle = ( $_POST['orientation'] == 'portrait' ) ? 90 : 0;
    }

    $input_text = 'texting';
    $width = 200;
    $height = 200;

    $base_url = __DIR__;


    $pdf = new Imagick();

    $yaxis = $height / 2;
    $xaxis = $width / 2;

    $draw = new ImagickDraw();

    $text_color = new ImagickPixel('#000000');
    $pixel = new ImagickPixel( 'white' );

    /* New image */
    //$pdf->setResolution($width, $height);
    $pdf->newImage($width, $height, $pixel);
    
    
    /* Black text */
    $draw->setFillColor($text_color);

    /* Font properties */
    $draw->setFont('HelveticaNeue-Bold.ttf');
    $draw->setFontSize( 25 );
    $draw->setStrokeAntialias(true);
    $draw->setTextAntialias(true);

    /* Get font metrics */
    $metrics = $pdf->queryFontMetrics($draw, $input_text);

    /* Create text */
    $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
    $draw->annotation($xaxis, $yaxis, $input_text);

    //$pdf->rotateimage("#000", 270); // rotate 90 degrees CW 

    //$pdf->resizeImage(300, 300, Imagick::FILTER_LANCZOS, 1 );

   
    $pdf->drawImage($draw);

    $pdf->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH); //Declare the units for resolution.
    $pdf->setImageFormat('pdf');
    $pdf->setImageCompression(imagick::COMPRESSION_JPEG);
    $pdf->setImageCompressionQuality(100);

  /*  header("Content-Type: image/jpg");
    echo  $pdf->getImageBlob(); */

    header("Content-Type: image/pdf");
    echo  $pdf->getImageBlob();
    
    //$pdf->writeImages( $base_url.'/'.file_newname( __DIR__, 'pdf-file-test.jpeg' ), true);


    die;
?>
