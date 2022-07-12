<?php
include 'config.php';

$con=mysqli_connect('localhost','dev','password','mysite_db_test');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  	$current_date = date('Y-m-d H:i:s');

  	echo $current_date;

	//$sql = "SELECT * FROM date_record WHERE start_date <= Now()";
	///records older than given hours in after interval///
	$sql = "SELECT * FROM date_record WHERE start_date <= (NOW() - INTERVAL 2 HOUR)";
	
	$res = mysqli_query( $con,$sql );

	while($row = mysqli_fetch_assoc($res)){
		echo "<pre>";
		print_r($row);
		echo "</pre>";
	}

//$insert = "INSERT INTO date_record SET start_date = NOW()";
//$sql_insert = mysqli_query( $con,$insert); 
?>