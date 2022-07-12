<?php

if ( isset($_POST['Submit']) ) {

    if ( isset( $_POST['input_text'] ) ) {
        $input_text = $_POST['input_text'];
    }

    if( isset($_POST['orientation']) ) {
        if ( $_POST['orientation'] == 'portrait' ) {
            list( $height , $width ) = explode( 'x', $_POST['dimension'] );
        }else{
            list( $width, $height ) = explode( 'x', $_POST['dimension'] );
        }
    }else{
        list( $width, $height ) = explode( 'x', $_POST['dimension'] );
    }

    // converting mm to px
    $width = ( $width * 3.77 );
    $height = ( $height * 3.77 );
    // $angle = 0;
    // if( isset($_POST['orientation']) ) {
    //     $angle = ( $_POST['orientation'] == 'portrait' ) ? 90 : 0;
    // }

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
    

    //$size = 25;
    //$MAX_TEXT_WIDTH = $pdf->getImageWidth();

    //$bbox = imageftbbox($size, 0, 'HelveticaNeue-Bold.ttf', $input_text );
    //print_r($bbox);die('sdsd');
    // while (true){
    //     $bbox = imageftbbox($size, 0, 'HelveticaNeue-Bold.ttf', $input_text );
    //     $width_of_text = $bbox[2] - $bbox[0];
    //     if ($width_of_text > $MAX_TEXT_WIDTH) {
    //         $size -= 1;
    //     } else {
    //         break;
    //     }
    // }
   // $draw->setFontSize( $size );
    //$draw->setStrokeAntialias(true);
    //$draw->setTextAntialias(true);
    



    /* Create text */
    $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
    $pdf->annotateImage($draw, $xaxis, $yaxis, 0, $input_text);
    //$pdf->rotateimage("#000", $angle); // rotate 90 degrees CW 

    //$pdf->setImageResolution(300,300);
    $pdf->setImageCompression(Imagick::COMPRESSION_LZW);
    $pdf->setImageCompressionQuality(100);
    $pdf->setImageFormat('pdf');
    
    header('Content-Type: application/pdf');
    // It will be called downloaded.pdf
    header("Content-Disposition:attachment;filename=pdf-file.pdf");
    echo $pdf;
    exit;

}


if (!extension_loaded('imagick')){
    echo 'imagick not installed';
}else{
    echo 'imagick installed';
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
                    <select class="form-control" name="orientation" >
                        <option value=""></option>
                        <option value="portrait">Portrait</option>
                        <option value="landscape">Landscape</option>
                    </select>
                  </div>
                <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
            </form>
        </div>
    </div>
</div>
</body>
</html>