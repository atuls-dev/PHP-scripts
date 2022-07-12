<?php

// $im = new Imagick();
// $im->setResolution( 300, 300 );
// $im->readimage( $_SERVER['DOCUMENT_ROOT'].'/imagemagic/WoocommerceOrderTile.pdf');
// $im->setImageResolution(300, 300);
// $im->setImageFormat( 'pdf' );
// $im->writeImages( $_SERVER['DOCUMENT_ROOT'].'/wc-order-image-%04d.pdf', true );
// $im->clear();
// $im->destroy();

if ( isset($_POST['Submit']) ) {

    if (!extension_loaded('imagick')){
        echo 'imagick not installed';
    }else{
        echo 'imagick installed';
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

    // $images = array(
    //     $base_url.'\background1.jpg',
    //     $base_url.'\background3.jpg'
    // );

    $pdf = new Imagick();

    // --------------------------
    // for adding images
    // foreach( $images as $img ) {
    //     $test = new Imagick($img);
    //     $pdf->addImage($test);
    //     $pdf->resizeImage(300, 300, Imagick::FILTER_LANCZOS, 1 );
    // }

    // --------------------------
    // for adding images
    // foreach( $images as $img ) {
    //     $pdf->readImage($img);
    //     $pdf->resizeImage($width, $height, Imagick::FILTER_UNDEFINED , 1 );
    // }

    $xaxis = $width / 2;
    $yaxis = $height / 2;

    $draw = new ImagickDraw();

    $text_color = new ImagickPixel('#000000');
    $pixel = new ImagickPixel( 'none' );

    /* New image */
    $pdf->newImage($width, $height, $pixel);

    /* Black text */
    $draw->setFillColor($text_color);

    /* Font properties */
    $draw->setFont('HelveticaNeue-Bold.ttf');
    $draw->setFontSize( 15 );
    $draw->setStrokeAntialias(true);
    $draw->setTextAntialias(true);
 
    /* Create text */
    $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
    $pdf->annotateImage($draw, $xaxis, $yaxis, $angle, $input_text);

    //$pdf->rotateimage("#000", 270); // rotate 90 degrees CW 

    //$pdf->resizeImage(300, 300, Imagick::FILTER_LANCZOS, 1 );

    $pdf->setImageFormat('pdf');

    
    if (!$pdf->writeImages( $base_url.'/'.file_newname( __DIR__, 'pdf-file.pdf' ), true)) {
        die('Could not write!');
    }

}

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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
       /* @font-face{
            font-family:"helveticaneue-bold";
            src:url("HelveticaNeue-Bold.ttf") format("woff"),
            url("HelveticaNeue-Bold.ttf") format("opentype"),
            url("HelveticaNeue-Bold.ttf") format("truetype");
        }*/
        /*span {
            font-family:"helveticaneue-bold";
        }*/
    </style>
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