//// function file for saving functions purpose only dont run this file ////

<?php
$con=mysqli_connect('localhost','dev','password','mysite_db_test');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

/*
function getSubAffDetails($affID) {
	global $dbcnx_1;
	$sql = mysqli_query( $dbcnx_1,"SELECT user_type, aff_name, aff_email, aff_phone FROM affiliates WHERE aff_id='". $affID . "' AND user_type = 4 AND superior = 2; " );
	$res = mysqli_fetch_assoc($sql);
	return $res;
}
*/
function getsingle(){
	$result = array();
	$sql = "SELECT * FROM cruise_registration order by regdate DESC LIMIT 10";
	$res = mysqli_query( $con,$sql );
	// $row = mysqli_fetch_assoc($res);

	while ($row = mysqli_fetch_assoc($res)) {
		$result[] = $row;
	}
	return $result;
}

function getReservations(){
	$result = array();

	$sql[] = "SELECT * FROM cruise_registration order by regdate DESC LIMIT 10";
	$sql[] = "SELECT * FROM liveaboard_registration order by regdate DESC LIMIT 10";
	$sql[] = "SELECT * FROM hotel_registrations order by regdate DESC LIMIT 10";
	$sql[] = "SELECT * FROM island_registrations order by regdate DESC LIMIT 10";

	foreach ($sql as $key => $sSql) {
		
		$res = mysqli_query( $con,$sSql );

		while( $row = mysqli_fetch_assoc($res) ) {
			$result[]= $row; 
		}
	}

	usort($result, 'sortByOrder');
	$result = array_slice($result, 0, 10);
	return $result;
}

function sortByOrder($a, $b) {
    $t1 = strtotime($a['regdate']);
    $t2 = strtotime($b['regdate']);
    return $t1 < $t2;
}
function test(){

	 $sql[] = "SELECT bfname, blname, email, traveler1, traveler2, regdate, aff_id FROM cruise_registration WHERE aff_id = $affID
			   UNION ALL
			   SELECT bfname, blname, email, traveler1, traveler2, regdate, aff_id FROM hotel_registrations WHERE aff_id = $affID
			   ORDER BY regdate DESC";


			   $sql[] = "SELECT bfname, blname, email, traveler1, traveler2, regdate, aff_id FROM cruise_registration	
			   UNION ALL
			   SELECT bfname, blname, email, traveler1, traveler2, regdate, aff_id FROM hotel_registrations";

			   //working
			   	$sql[] = "SELECT id, regdate FROM cruise_registration
  				UNION ALL 
  			  SELECT id, regdate FROM hotel_registrations
  				ORDER BY regdate DESC";


			}


//Note: Left Joins On Reservations for Union All to work in 2 or more tables all columns must be of same datatype and same number of columns..
function getReservations(){
	session_start();
	global $dbcnx_1;
	$result = array();
	$chk = '';
	$aff_id = $_SESSION['aff_id'];
	$user_level = $_SESSION['user_level'];
	
	$chk = "WHERE aff_id = ".$aff_id;

	if( $user_level == 1 ){
		$chk = '';
	}
	elseif($user_level == 2){

		$sql2 = "select * from affiliates where superior='" . $aff_id . "' ";
		$res2 = mysqli_query($dbcnx_1, $sql2) or die(mysqli_error($dbcnx_1));
		$num = mysqli_num_rows($res2);
		if ( $num > 0 ) {
		  while( $row2 = mysqli_fetch_assoc($res2) ) {
		
			$chk .= " OR aff_id = ".$row2['aff_id']; 
			}
		}

	}
	elseif($user_level == 3){

		$sql1 = "select * from affiliates where superior='" . $aff_id . "' ";
		$res1 = mysqli_query($dbcnx_1, $sql1) or die(mysqli_error($dbcnx_1));
		$num = mysqli_num_rows($res1);
		if ( $num > 0 ) {
		  while( $row1 = mysqli_fetch_assoc($res1) ) {
		
			$chk .= " OR aff_id = ".$row1['aff_id']; 
			}
		}
	
	}
	elseif( $user_level == 4 ){

	    $chk = "WHERE aff_id = ".$aff_id;
	
	}


	$sql[] = "SELECT *, tour_id AS cruise_id, cruise_tours.eventtitle AS tour_name FROM cruise_registration LEFT JOIN cruise_tours ON cruise_registration.tour_id = cruise_tours.id ".$chk." order by regdate DESC LIMIT 10";
	$sql[] = "SELECT *, tour_id AS hotel_id, tours.eventtitle AS tour_name FROM hotel_registrations LEFT JOIN tours ON hotel_registrations.tour_id = tours.id ".$chk." order by regdate DESC LIMIT 10";
	$sql[] = "SELECT *, event_id AS liveaboard_id, liveaboard_events.eventtitle AS tour_name FROM liveaboard_registration LEFT JOIN liveaboard_events ON liveaboard_registration.event_id = liveaboard_events.id ".$chk." order by regdate DESC LIMIT 10";
	$sql[] = "SELECT *, event_id AS island_id, island_events.eventtitle AS tour_name FROM island_registrations LEFT JOIN island_events ON island_registrations.event_id = island_events.id ".$chk." order by regdate DESC LIMIT 10";


	foreach ($sql as $key => $sSql) {
		
		$res = mysqli_query( $dbcnx_1,$sSql );

		while( $row = mysqli_fetch_assoc($res) ) {
			$result[]= $row; 
		}
	}

	usort($result, 'sortByOrder');
	$result = array_slice($result, 0, 10);
	return $result;
}

function sortByOrder($a, $b) {
    $t1 = strtotime($a['regdate']);
    $t2 = strtotime($b['regdate']);
    return $t1 < $t2;
}

?>
