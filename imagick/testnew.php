<?php

function fitImageAnnotation( Imagick $image, ImagickDraw $draw, $text, $maxHeight, $leading = 1, $strokeWidth = 0.04, $margins = array( 10, 10, 10, 10 ) )
{
    if( strlen( $text ) < 1 )
    {
        return;
    }

    $imageWidth = $image->getImageWidth();
    $imageHeight = $image->getImageHeight();

    // margins are css-type margins: T, R, B, L
    $boundingBoxWidth = $imageWidth - $margins[ 1 ] - $margins[ 3 ];
    $boundingBoxHeight = $imageHeight - $margins[ 0 ] - $margins[ 2 ];

    // We begin by setting the initial font size
    // to the maximum allowed height, and work our way down
    $fontSize = $maxHeight;

    $textLength = strlen( $text );

    // Start the main routine where the culprits are
    do
    {
        $probeText = $text;
        $probeTextLength = $textLength;
        $lines = explode( "\n", $probeText );
        $lineCount = count( $lines );

        $draw->setFontSize( $fontSize );
        $draw->setStrokeWidth( $fontSize * $strokeWidth );
        $fontMetrics = $image->queryFontMetrics( $draw, $probeText, true );

        // This routine will try to wordwrap() text until it
        // finds the ideal distibution of words over lines,
        // given the current font size, to fit the bounding box width
        // If it can't, it will fall through and the parent 
        // enclosing routine will try a smaller font size
        while( $fontMetrics[ 'textWidth' ] >= $boundingBoxWidth )
        {

            // While there's no change in line lengths
            // decrease wordwrap length (no point in
            // querying font metrics if the dimensions
            // haven't changed)
            $lineLengths = array_map( 'strlen', $lines );
            do
            {
                $probeText = wordwrap( $text, $probeTextLength );
                $lines = explode( "\n", $probeText );

                // This is one of the performance culprits
                // I was hoping to find some kind of binary
                // search type algorithm that eliminates
                // the need to decrease the length only
                // one character at a time
                $probeTextLength--;
            }
            while( $lineLengths === array_map( 'strlen', $lines ) && $probeTextLength > 0 );

            // Get the font metrics for the current line distribution
            $fontMetrics = $image->queryFontMetrics( $draw, $probeText, true );

            if( $probeTextLength <= 0 )
            {
                break;
            }
        }

        // Ignore font metrics textHeight, we'll calculate our own
        // based on our $leading argument
        $lineHeight = $leading * $fontSize;
        $lineSpacing = ( $leading - 1 ) * $fontSize;
        $lineCount = count( $lines );
        $textHeight = ( $lineCount * $fontSize ) + ( ( $lineCount - 1 ) * $lineSpacing );


        // This is the other performance culprit
        // Here I was also hoping to find some kind of
        // binary search type algorithm that eliminates
        // the need to decrease the font size only
        // one pixel at a time
        $fontSize -= 1;
    }
    while( $textHeight >= $maxHeight || $fontMetrics[ 'textWidth' ] >= $boundingBoxWidth );

    // The remaining part is no culprit, it just draws the final text
    // based on our calculated parameters
    $fontSize = $draw->getFontSize();
    $gravity = $draw->getGravity();

    if( $gravity < Imagick::GRAVITY_WEST )
    {
        $y = $margins[ 0 ] + $fontSize + $fontMetrics[ 'descender' ];
    }
    else if( $gravity < Imagick::GRAVITY_SOUTHWEST )
    {
        $y = $margins[ 0 ] + ( $boundingBoxHeight / 2 ) - ( $textHeight / 2 ) + $fontSize + $fontMetrics[ 'descender' ];
    }
    else
    {
        $y = ( $imageHeight - $textHeight - $margins[ 2 ] ) + $fontSize;
    }

    $alignment = $gravity - floor( ( $gravity - .5 ) / 3 ) * 3;
    if( $alignment == Imagick::ALIGN_LEFT )
    {
        $x = $margins[ 3 ];
    }
    else if( $alignment == Imagick::ALIGN_CENTER )
    {
        $x = $margins[ 3 ] + ( $boundingBoxWidth / 2 );
    }
    else
    {
        $x = $imageWidth - $margins[ 1 ];
    }
    $draw->setTextAlignment( $alignment );
    $draw->setGravity( 0 );
    foreach( $lines as $line )
    {
        $image->annotateImage( $draw, $x, $y, 0, $line );
        $y += $lineHeight;
    }
}


$image = new Imagick( );
$draw = new ImagickDraw();

// For now, setting a gravity other that 0 is necessary
$draw->setGravity( Imagick::GRAVITY_NORTHWEST );
$text = 'Some text, preferably long, because the longer, the text, the slower the algorithm';
$maxHeight = 120;

// In my actual code it's a class method
fitImageAnnotation( $image, $draw, $text, $maxHeight );

header( 'Content-Type: image/jpeg', true );
echo $image;


?>