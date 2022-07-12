<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include 'config.php';
//include 'functions.php';

$con=mysqli_connect('localhost','dev','password','mysite_db_test');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	// echo "<pre>";
	// print_r($result);
	// echo "</pre>";
  // $rData = getReservations();
  // echo "<pre>";
  // print_r($rData);
  // echo "</pre>";
  $affID = 151;
  $result = array();
	// $sql[] = "SELECT * FROM cruise_registration order by regdate DESC LIMIT 10";
	// $sql[] = "SELECT * FROM liveaboard_registration order by regdate DESC LIMIT 10";
	// $sql[] = "SELECT * FROM hotel_registrations order by regdate DESC LIMIT 10";
	// $sql[] = "SELECT * FROM island_registrations order by regdate DESC LIMIT 10";
  	$sql[] = "SELECT id, regdate FROM cruise_registration
  				UNION ALL 
  			  SELECT id, regdate FROM hotel_registrations
  				ORDER BY regdate DESC";
			   print_r($sql);
	foreach ($sql as $key => $sSql) {
		
		$res = mysqli_query( $con,$sSql );

		while( $row = mysqli_fetch_assoc($res) ) {
			$result[]= $row; 
		}
	}

	// usort($result, 'sortByOrder');
	// $result = array_slice($result, 0, 10);

                ?>
                 <table style="width:100%" class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>traveler1</th>
                            <th>traveler2</th>
                            <!-- <th>Tour package</th> -->
                            <th>Booking Date</th>
                        </tr>
                    <?php 
                    foreach ($result as $row) { 
                     // $sql = "SELECT * FROM `cruise_tours` where id = '".$row['tour_id'];."' ";
                     ?>
                       <tr>
                       		<td><?php  echo $row['id']; ?></td>  
                            <td><?php  /*echo $row['bfname'].' '.$row['blname'];*/ ?></td> 
                            <td><?php  /*echo $row['email'];*/ ?></td>  
                            <td><?php  /*echo $row['traveler1'];*/ ?></td>  
                            <td><?php  /*echo $row['traveler2'];*/ ?></td>  
                        <!-- <td><?php  //echo $row['tour_id']; ?></td>   -->
                            <td><?php  echo $row['regdate']; ?></td>  
                        </tr>                            
                        <?php } ?>
                    </table>