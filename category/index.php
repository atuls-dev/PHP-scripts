<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$link = mysqli_connect('localhost', 'dev', 'password' , 'demo');
if (!$link) {
    die('Not connected : ' . mysqli_connect_error());
}
if(isset($_POST['submit'])){ 

  $parent=$_POST['p_cid']; 
  $name=$_POST['name']; 
  mysqli_query($link,"INSERT INTO category (name,parent) VALUES('$name','$parent') ") or die(mysqli_error($link)); 
// mysqli_close($link);
 }

include 'functions.php';
include 'class.php';



  // $sql1 = "SELECT * FROM category WHERE 1 AND parent = 0 ORDER BY cid ASC";
  // $query1 = mysqli_query( $link, $sql1);
  // $row1 = mysqli_fetch_object($query1);
  // print_r($row1);
  // die('sdsf');
/*  $spacing = '';
  $sql = "SELECT cid, name, parent FROM category WHERE 1 AND parent = 0 ORDER BY cid ASC";
  $query = mysqli_query($link,$sql);
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_object($query)) {
      $user_tree_array[] = array("id" => $row->cid, "name" => $spacing . $row->name);
      $sql1 = "SELECT cid, name, parent FROM category WHERE parent = $row->cid ORDER BY cid ASC";
      $query1 = mysqli_query($link,$sql1);
        if (mysqli_num_rows($query1) > 0) {
          while ($row1 = mysqli_fetch_object($query1)) {
              $user_tree_array[] = array("id" => $row1->cid, "name" => '--'. $row1->name);

              $sql2 = "SELECT cid, name, parent FROM category WHERE parent = $row1->cid ORDER BY cid ASC";
              $query2 = mysqli_query($link,$sql2);
              if (mysqli_num_rows($query2) > 0) {
              while ($row2 = mysqli_fetch_object($query2)) {
                $user_tree_array[] = array("id" => $row2->cid, "name" => '---'. $row2->name);
                 }
              }
          }
        }

      // $user_tree_array = fetchCategoryTree($row->cid, $spacing . '&nbsp;&nbsp;', $user_tree_array);
    }
  }*/
  echo "<pre>";
  // print_r($user_tree_array);
  echo "</pre>";




?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
	<title>Create Category tree with PHP and mysql</title>
  </head>
  <body>
    <div id="container">
      <div id="body">
        <div class="mainTitle" >Create Category tree with PHP and mysql</div>
          <?php//  echo $emsg; ?>
        <article>
        	<div style="text-align:center;" >
				<form action="" method="post"><select name="p_cid">
				<option value="0">Select Category</option><?php $category = new cat(); $category->cat_list(); ?>
				</select>
				Category : <input name="name" type="text" /> <input name="submit" type="submit" value="Submit" />
				</form>
			</div>
      <br/>
      <hr/>
      <br/>
			<div style="text-align:center;" >
				<select style="width:200px;height:35px;border:1px solid #6d37b0;padding:5px;">
				<?php $categoryList = fetchCategoryTree(); ?>
				<?php foreach($categoryList as $cl) { ?>
				<option value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>
				<?php } ?>
				</select>
			</div>
			   
          <div class="height20"></div>
          <table border='1'>
            <?php
            $res1 = fetchCategoryTreeListView();
            foreach ($res1 as $r1) {
              echo  $r1;
            }
            ?>
          </table>
          <div class="height10"></div>

          <div class="height20"></div>
          <h4>User Tree Listing will be displayed below(if any user will be in database):</h4>
          <ul>
            <?php
            $res = fetchCategoryTreeList();
            foreach ($res as $r) {
              echo  $r;
            }
            ?>
          </ul>
          <div class="height10"></div>
        </article>
        <div class="height10"></div>
      </div>

    </div>
  </body>
</html>
