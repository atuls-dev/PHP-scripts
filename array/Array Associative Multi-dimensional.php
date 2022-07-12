<pre>
<?php 
/*$arr = array("Reet","Arora","sadfs","cvb","jjkb","am","ko"); 
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

$a=array("red","green");
$b=array("blue","yellow");

for($i=0;$i<count($b);$i++)
	{
		array_push($a,$b[$i]);
	}
print_r($a);
*/

$maarr = array("name"=>array("mukul","reet",array("surname","aster","karan")),"lname"=>array("Gupta","Arora","Sharma"),"middlename"=> "dummy");

print_r($maarr);

foreach($maarr as $key => $value)
{
	if(is_array($value))
	{
	//	print_r($value);
		foreach ($value as $key1 => $value1) {
			if(is_array($value1))
			{
				foreach ($value1 as $key2 => $value2)
				{
					echo $key .' = '.$key1.' = '. $key2 .' = '. $value2."<br>";
				}
			}
			else
			{
				echo $key .' = '. $key1 .' = '. $value1."<br>";
			}
		}

	}
	else
	{
		echo $key." = ".$value;
	}

}

?>