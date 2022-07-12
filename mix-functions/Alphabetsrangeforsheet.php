<?php
error_reporting(E_ALL);
ini_set('error_display','1');


echo (100 % 20);

function generateAlphabet($start='E', $end=50) {

	for($i=0; $i < 26; $i++) {
		$char = chr($i+65) ;
		if( $char == $start ) {
			$start_number = $i;
		}
	}
	//echo $start_number;



	/*	
		$alphabet = Array();
	    for ($num = $start_number; $num < $end; $num++) {
	        $alphabet[]=generateAlpha($num);
	    }
		echo $alphabet;
	*/

}

generateAlphabet();

function generateAlpha($num) {
	$sa = "";
    while ($num >= 0) {
        $sa = chr($num % 26 + 65) . $sa;
        $num = floor($num / 26) - 1;
    }
    return $sa;
}

function getAlpha($start, $end) {

	for($i=0; $i < 26; $i++) {
		$char = chr($i+65);
		if( $char == $start ) {
			$start_number = $i;
		}
	}

	$alphabet = Array();
    for ($num = $start_number; $num < $end; $num++) {
        $alphabet[]=generateAlpha($num);
    }

	return $alphabet;
}

echo "<pre>";
    //print_r(getAlpha('E', 50));
echo "</pre>";


/*
$sample = array('E','F','G','H');
echo "<pre>";
print_r($sample);
echo "</pre>";
*/

$alphas = range('A', 'Z');

echo "<pre>";
print_r($alphas);
echo "</pre>";

/*


function generateAlphabet($na) {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }

$alphabet = Array();
for ($na = 0; $na < 100; $na++) {
    $alphabet[]=generateAlphabet($na);
}
echo "<pre>";
    print_r($alphabet);
echo "</pre>";

*/

?>