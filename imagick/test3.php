<?php

$imagick = new Imagick();
$imagickDraw = new ImagickDraw();

$pixel = new ImagickPixel( 'white' );

/* New image */
$imagick->newImage(50, 50, $pixel);

$boxWidth = 500;
$boxHeight = 500;
$boxX = 0;
$boxY = 0;
$lineHeight = 0;

$content = "This is very long text with text to see fit break...";

$content = trim($content);
$words = explode(' ', $content);

$lines = [];
$currentLine = [];
foreach ($words as $word) {
    $newLines = [];

    if (substr_count($word, PHP_EOL) > 1) {
        // The word contains multiple line breaks, so we need to ensure they are adhered to
        $newLines = array_fill(0, substr_count($word, PHP_EOL) - 1, '');
    }

    if (strpos($word, PHP_EOL) === 0) {
        // Newline characters are at the start of the word
        $lines[] = implode(' ', $line);
        $lines = array_merge($lines, $newLines);
        $currentLine = [trim($word)];
    } elseif (strpos($word, PHP_EOL) > 0) {
        // Newline characters are at the end of the word
        $line[] = trim($word);
        $lines[] = implode(' ', $line);
        $lines = array_merge($lines, $newLines);
        $line = [];
    } else {
        $line[] = trim($word);

        $metrics = $imagick->queryFontMetrics($imagickDraw, implode(' ', $line));
        $lineHeight = max($metrics['textHeight'], $lineHeight);

        if ($metrics['textWidth'] > $boxWidth)
        {
            if (count($line) == 1) {
                // There is only one word on this line and it is too wide, but we will just add it anyway
                $lines[] = $line[0];
                $line = [];
            } else {
                // The last word added made the line too wide, so we remove the word and store the line as it was
                array_pop($line);
                $lines[] = implode(' ', $line);

                $line = [$word];
            }
        }

        // If there are no more words to process, add the last line to the array
        if (next($words) === false) {
            $lines[] = implode(' ', $line);
        }
    }
}

for($i = 0; $i < count($lines); $i++) {
    $topOfLinePosition = $i * $lineHeight;

    if ($topOfLinePosition < $boxHeight) {
        $boxY = $boxY + $topOfLinePosition;
        $imagick->annotateImage($imagickDraw, $boxX, $boxY + $imagickDraw->getFontSize(), 0, $lines[$i]);
    }
}

    // define compression and quality
	$imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
	$imagick->setImageCompressionQuality(100); 

	// define PDF format
	$imagick->setImageFormat("jpg");

	// output file in browser
	 header("Content-Type: image/png");
   echo $imagick;
?>