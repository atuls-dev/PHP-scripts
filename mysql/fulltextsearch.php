<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/********************

######## FULL TEXT SEARCH: ENABLE FTS COMMAND      #####
ALTER TABLE TABLE_NAME FULLTEXT(COULUM1,COULUM2,COULUM3);
Note: you have to specify exact fields in match as above;
*********************/

$servername = "localhost";
$username = "dev";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password, 'mi_test');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<style type="text/css">
 table, td { 
 	border:1px solid;
 }
</style>
<?php
$sql = "SELECT * FROM search";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $data = array();
     echo "<table style='border:1px solid;' ><tr><th>id</th><th>Full name</th><th>Description</th><th></th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["id"]. " </td><td> " . $row["firstName"]. " " . $row["lastName"]." </td><td>" . $row["description"]. "</td></tr>";
        $data[] = $row;
    }
    echo "</table>";

  /*  echo "<pre>";
    	print_r($data);
    echo "</pre>";*/
} else {
    echo "0 results";
}

echo "<br/><br/>";

if(ISSET($_POST['submit'])){
	$text = $_POST['search'];
	$sql1 = "SELECT * FROM search WHERE MATCH(firstName,lastName,description)
AGAINST('".$text."' IN NATURAL LANGUAGE MODE)";

$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    $data1 = array();
    echo "<table style='border:1px solid;' ><tr><th>id</th><th>Full name</th><th>Description</th><th></th></tr>";
    while($row = mysqli_fetch_assoc($result1)) {
        echo "<tr><td>".$row["id"]. " </td><td> " . $row["firstName"]. " " . $row["lastName"]." </td><td>" . $row["description"]. "</td></tr>";
        $data1[] = $row;
    }
    echo "</table>";

  /*  echo "<pre>";
    	print_r($data1);
    echo "</pre>";*/
} else {
    echo "0 results";
}

}

?>
<form action="" method="post">
	<input type="text" name="search">
	<input type="submit" name="submit">
</form>