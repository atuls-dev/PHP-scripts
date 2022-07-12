<?php 

    
    $input_text = 'hello this is a long text to fit in a angle with pixels';

    // converting mm to px
    $width = 120;
    $height = 360;

    $base_url = __DIR__;

    $pdf = new Imagick();

    $xaxis = $width / 2;
    $yaxis = $height / 2;

    $draw = new ImagickDraw();

    $text_color = new ImagickPixel('#000000');
    $pixel = new ImagickPixel( 'white' );

    /* New image */
    $pdf->newImage($width, $height, $pixel);

    /* Black text */
    $draw->setFillColor($text_color);

    /* Font properties */
    $draw->setFont('HelveticaNeue-Bold.ttf');
    

    $size = 40;
    // $draw->setFontSize( $size );
    // $MAX_TEXT_WIDTH = $width;
    // //$bbox = imageftbbox($size, 0, 'HelveticaNeue-Bold.ttf', $input_text );
    // //print_r($bbox);die('sdsd');
    // while (true){
    //     $draw->setFontSize( $size );
    //     list($lines, $lineHeight) = wordWrapAnnotation($pdf, $draw, $input_text, $width-20);
    //     $bbox = imageftbbox($size, 0, 'HelveticaNeue-Bold.ttf', $lines );
    //     $width_of_text = $bbox[2] - $bbox[0];
    //     if ($width_of_text > $MAX_TEXT_WIDTH) {
    //         $size -= 1;
    //     } else {
    //         break;
    //     }
    // } 
    
    // echo $size;die('size');

    $draw->setFontSize( $size );


    //$draw->setFontSize(15);
    //$metrics = $pdf->queryFontMetrics($draw, $input_text, false);

    $pdf->annotateImage($draw, 5, 50, null, $input_text);
    //$draw->setStrokeAntialias(true);
    //$draw->setTextAntialias(true);
    
    /* Create text */
    //list($lines, $lineHeight)= wordWrapAnnotation($pdf, $draw, $input_text, $width-20);

    // echo "<pre>";
    // print_r($lines);
    // echo "</pre>";
    // exit;
    // $draw->setFontSize( $size );

    /* Create text */
    // $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
    // $draw->setGravity(imagick::GRAVITY_CENTER);
    // $pdf->annotateImage($draw, $xaxis, $yaxis, 0, $input_text);

    // $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
    // $draw->annotation($xaxis, $lineHeight, $lines);
    // $pdf->drawImage($draw);

    //$pdf->rotateimage("#000", $angle); // rotate 90 degrees CW 
    
    //$pdf->setImageResolution(300,300);


    $pdf->setImageCompression(13);
    $pdf->setImageCompressionQuality(100);
    $pdf->setImageFormat("jpg");

    // output file in browser
    header("Content-Type: image/png");
    echo $pdf;


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


if (!extension_loaded('imagick')){
    echo 'imagick not installed';
}else{
    echo 'imagick installed';
}

?>
