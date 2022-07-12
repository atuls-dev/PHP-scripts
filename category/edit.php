<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$link = mysqli_connect('localhost', 'dev', 'password' , 'demo');
if (!$link) {
    die('Not connected : ' . mysqli_connect_error());
}

$cid = (int)$_GET['cat_id'];

if(isset($_POST['Edit'])){

	$cid = $_POST['cid'];
	$name = $_POST['name'];
	$parent = $_POST['p_cid'];

	if(mysqli_query($link,"UPDATE category SET name = '$name', parent = '$parent' WHERE cid = '$cid'")){
		echo "updated succesfully";
	}else{
		echo "failed";
	}
}
include 'functions.php';
include 'class.php';

$sql=mysqli_query($link,"SELECT * FROM category WHERE cid='$cid'") or die(mysql_error());
$row=mysqli_fetch_array($sql);
extract($row);
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Edit Category</title>
</head>
<body>
<div style="text-align:center;" >
	<form action="" method="post">
	<input name="cid" type="text" readonly value="<?php echo $cid; ?>" />	
		<?php
	  $categoryList = fetchCategoryTreeEdit((int)$cid); 
	 ?>
	<select name="p_cid">
	<option value="0">Select Parent</option><?php //$category = new cat(); $category->cat_list($cid); ?>

				<?php foreach($categoryList as $cl) { ?>
				<option value="<?php echo $cl["id"] ?>"  <?php if($cl["id"] == $parent){ echo "selected='selected'"; } ?> ><?php echo $cl["name"]; ?></option>
	<?php } ?>
	</select>
	Category : <input name="name" type="text" value="<?php echo $name; ?>" /> <input name="Edit" type="submit" value="Submit" />
	</form>
</div>
</body>
</html>
