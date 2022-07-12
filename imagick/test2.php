<?php
// ciskomi 23 sept 2014. France.

// create magick object
$test=new Imagick();

// create white picture with A4 format ratio
$test->newImage(1240, 1753, new ImagickPixel('white'));

// create font object
$draw = new ImagickDraw();
$draw->setFontSize(50);

// get all available font names
$fonts=$test->queryFonts();

// write each font, 1 per line
$y=5;
/*
foreach ($fonts as $id=>$font) {
  $draw->setFont($font);
}
*/
$test->annotateImage($draw,10,50,0, 'Expinator');

// set 150 dpi, with the 1240 x 1753 pixels image, means 210 x 297mm (A4 format)
$test->setImageResolution(150,150);

// define compression and quality
$test->setImageCompression(Imagick::COMPRESSION_LZW);
$test->setImageCompressionQuality(95); 

// define PDF format
$test->setImageFormat("pdf");

// output file in browser
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="imagicktest.pdf"');
echo $test;

?>
