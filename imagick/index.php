<?php 

if ( isset($_POST['Submit']) ) {

    if ( isset( $_POST['input_text'] ) ) {
        $input_text = $_POST['input_text'];
    }

    if ( $_POST['orientation'] == 'portrait' ) {
        //list( $height, $width ) = explode( 'x', $_POST['dimension'] );
        list( $x , $y ) = explode( 'x', $_POST['dimension'] );
        $width = ( $x > $y ) ? $y : $x;
        $height = ( $x > $y ) ? $x : $y;
    }else if ( $_POST['orientation'] == 'landscape' ) {
        list( $x , $y ) = explode( 'x', $_POST['dimension'] );
        $width = ( $x > $y ) ? $x : $y;
        $height = ( $x > $y ) ? $y : $x;
    }else{
        list( $width, $height ) = explode( 'x', $_POST['dimension'] );
    }
    
    // converting mm to pt
    //$width = ( $width * 2.83 );
    //$height = ( $height * 2.83 );

    // calculated image resolution mm / inch * 300 dpi
    $width =  ( $width /25.4 ) * 300;
    $height = ( $height /25.4 ) * 300;

    $pdf = new Imagick();

    $pdf->setOption('density','300x300');

    /* Font properties */
    $pdf->setFont('HelveticaNeue-Bold.ttf');
    //$pdf->setGravity(imagick::GRAVITY_CENTER);
    $pdf->setGravity(imagick::GRAVITY_WEST);
    $pdf->newPseudoImage( $width, $height, "caption:" . $input_text );

    $pdf->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
    
    //$pdf->setImageCompression(Imagick::COMPRESSION_LZW);
    //$pdf->setImageCompressionQuality(100);
    
    //output file in browser
    $pdf->setImageFormat('pdf');
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="imagick.pdf"');
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