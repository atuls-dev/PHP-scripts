<pre>
<?php
$arr = array("Reet","Arora","sadfs","cvb","jjkb","am","ko"); 
echo count($arr)."<br/>";

$new1 = array("Reet","am","ko"); 
print_r($new1);
$tot1 = count($new1);
echo count($new1)."<br/>";

$diff = array_diff($arr,$new1);
print_r($diff);

if($tot1 < 4)
{
 		$output = array_slice($diff, 0,(4 - $tot1)); 
 		print_r($output);
 		$new1 = array_merge($new1,$output);
 		print_r($new1);


}

?>