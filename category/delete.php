<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$link = mysqli_connect('localhost', 'dev', 'password' , 'demo');
if (!$link) {
    die('Not connected : ' . mysqli_connect_error());
}
include 'functions.php';
include 'class.php';

$cid = (int)$_GET['cat_id'];
if( isset($cid) ){

	$parent_id = getParentID((int)$cid);
	$child_ids = getChildID((int)$cid);

	if(!empty($child_ids)){
		foreach($child_ids as $child_id){
			mysqli_query($link,"UPDATE category SET parent = '$parent_id' WHERE cid = '$child_id'");		
		}
		// sql to delete a record
		if (mysqli_query($link, "DELETE FROM category WHERE cid='$cid'" )) {
			echo "Category deleted successfully";
		} else {
			echo "Error Deleting Category: " . mysqli_error($link);
		}
	}else {
		// sql to delete a record
		if (mysqli_query($link, "DELETE FROM category WHERE cid = '$cid'" )) {
			echo "Category deleted successfully";
		} else {
			echo "Error Deleting Category: " . mysqli_error($link);
		}

	}
}



?> 

