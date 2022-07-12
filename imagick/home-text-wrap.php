<?php

if ( isset($_POST['Submit']) ) {

    if (!extension_loaded('imagick')){
        echo 'imagick not installed';
    }else{
        echo 'imagick loaded';
    }

    if ( isset( $_POST['input_text'] ) ) {
        $input_text = $_POST['input_text'];
    }

    list( $width, $height ) = explode( 'x', $_POST['dimension'] );

    $angle = 0;
    if( isset($_POST['orientation']) ) {
        $angle = ( $_POST['orientation'] == 'portrait' ) ? 90 : 0;
    }

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
    $draw->setFontSize( 20 );
    $draw->setStrokeAntialias(true);
    $draw->setTextAntialias(true);
 



    /* Get font metrics */
    $metrics = $pdf->queryFontMetrics($draw, $input_text);

    /* Create text */
    list($lines, $lineHeight)= wordWrapAnnotation($pdf, $draw, $input_text, $width-20);

    //print_r($lineHeight);die;
    $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
    $draw->annotation($xaxis, $lineHeight, $lines);

    //$pdf->rotateimage("#000", 270); // rotate 90 degrees CW 

    //$pdf->resizeImage(300, 300, Imagick::FILTER_LANCZOS, 1 );

   
    $pdf->drawImage($draw);

    $pdf->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH); //Declare the units for resolution.
    $pdf->setImageFormat('jpeg');
    $pdf->setImageCompression(imagick::COMPRESSION_JPEG);
    $pdf->setImageCompressionQuality(100);

    //print_r($pdf->identifyImage());die;
    
     if (!$pdf->writeImages( $base_url.'/'.file_newname( __DIR__, 'pdf-file.pdf' ), true)) {
         die('Could not write!');
     }

}

//check if file name already exists and return it with new name
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


//this is unicode split method for out of english latin characters
function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

//this is my function detects long words and split them 
function check_long_words($image,$draw,$text,$maxWidth) {
    $metrics = $image->queryFontMetrics($draw, $text);
    if($metrics['textWidth'] <= $maxWidth)
    return array($text);

    $words = str_split_unicode($text);

    $i = 0;

    while($i < count($words) )
    {
        $currentLine = $words[$i];
        if($i+1 >= count($words))
        {

             $lines[] = $currentLine;
            //$lines = $lines + $checked;
            break;
        }
        //Check to see if we can add another word to this line
        $metrics = $image->queryFontMetrics($draw, $currentLine . $words[$i+1]);

        while($metrics['textWidth'] <= $maxWidth)
        {
            //If so, do it and keep doing it!
            $currentLine .= $words[++$i];
            if($i+1 >= count($words))
                break;
            $metrics = $image->queryFontMetrics($draw, $currentLine . ' ' . $words[$i+1]);
            $t++;
        }
        //We can't add the next word to this line, so loop to the next line


            $lines[] = $currentLine;

        $i++;

    }


    return $lines;

}   

function wordWrapAnnotation(&$image, &$draw, $text, $maxWidth)
{
    $brler = explode("<br>", $text);
    $lines = array();


    foreach($brler as $br)
    {
        $i = 0;


$words = explode(" ", $br);


 while($i < count($words) )
    {

        $currentLine = $words[$i];


 $metrics = $image->queryFontMetrics($draw, $currentLine . ' ' . $words[$i+1]);        

        if($i+1 >= count($words))
        {
            $checked=check_long_words($image,$draw,$currentLine,$maxWidth);
            $lines = array_merge($lines, $checked);

            if($metrics['textHeight'] > $lineHeight)
            $lineHeight = $metrics['textHeight'];
            //$lines = $lines + $checked;
            break;
        }
        //Check to see if we can add another word to this line


        while($metrics['textWidth'] <= $maxWidth)
        {
            //If so, do it and keep doing it!
            $currentLine .= ' ' . $words[++$i];
            if($i+1 >= count($words))
                break;
            $metrics = $image->queryFontMetrics($draw, $currentLine . ' ' . $words[$i+1]);
            $t++;
        }
        //We can't add the next word to this line, so loop to the next line

        $checked=check_long_words($image,$draw,$currentLine,$maxWidth);
            $lines = array_merge($lines, $checked);

        $i++;
        //Finally, update line height
        if($metrics['textHeight'] > $lineHeight)
            $lineHeight = $metrics['textHeight'];
    }




    }
    return array(join("\n",$lines), $lineHeight);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
  
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method="post">
                  <div class="form-group">
                    <label for="input-text">Text</label>
                    <input type="text" class="form-control" id="input-text" name='input_text' placeholder="Enter text">
                  </div>
                  
                  <div class="form-group">
                    <label for="dimension">Dimensions</label>
                    <select class="form-control" name="dimension" required>
                        <option value="120x360">120mm x 360mm</option>
                        <option value="240x360">240mm x 360mm</option>
                        <option value="480x360">480mm  x 360mm</option>
                        <option value="205x50">205mm x 50mm</option>
                        <option value="600x450">600mm x 450mm</option>
                        <option value="450x150">450mm x 150mm</option>
                        <option value="600x200">600mm x 200mm</option>
                        <option value="297x210">297mm x 210mm</option>
                        <option value="210x148">210mm x 148mm</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="orientation">Orientation Layout</label>
                    <select class="form-control" name="orientation" required>
                        <option value="landscape">Landscape</option>
                        <option value="portrait">Portrait</option>
                    </select>
                  </div>
                <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
            </form>
        </div>
    </div>
</div>
</body>
</html>