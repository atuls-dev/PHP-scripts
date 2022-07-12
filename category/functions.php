<?php
// $link = mysqli_connect('localhost', 'dev', 'password' , 'demo');
// if (!$link) {
//     die('Not connected : ' . mysql_error());
// }

function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {
  global $link;

  if (!is_array($user_tree_array))
    $user_tree_array = array();
	 // return "ldddd1"; 
  $sql = "SELECT cid, name, parent FROM category WHERE 1 AND parent = $parent ORDER BY cid ASC";
  $query = mysqli_query($link,$sql);

  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_object($query)) {
      $user_tree_array[] = array("id" => $row->cid, "name" => $spacing . $row->name);
      $user_tree_array = fetchCategoryTree($row->cid, $spacing . '&nbsp;&nbsp;', $user_tree_array);

    }
  }
  return $user_tree_array;
}

function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {
  global $link;

  if (!is_array($user_tree_array))
  $user_tree_array = array();

  $sql = "SELECT cid, name, parent FROM category WHERE 1 AND parent = $parent ORDER BY cid ASC";
  $query = mysqli_query($link,$sql);
  if (mysqli_num_rows($query) > 0) {
     $user_tree_array[] = "<ul>";
    while ($row = mysqli_fetch_object($query)) {
	  $user_tree_array[] = "<li>". $row->name."</li>";
      $user_tree_array = fetchCategoryTreeList($row->cid, $user_tree_array);
    }
	$user_tree_array[] = "</ul>";
  }
  return $user_tree_array;
}

function fetchCategoryTreeListView($parent = 0, $space='', $user_tree_array = '') {
  global $link;

  if (!is_array($user_tree_array))
  $user_tree_array = array();

  $sql = "SELECT cid, name, parent FROM category WHERE 1 AND parent = $parent ORDER BY cid ASC";
  $query = mysqli_query($link,$sql);
  if($parent==0){
    $space='';
  }else{
    $space .="--";
  }
  if (mysqli_num_rows($query) > 0) {
     // $user_tree_array[] = "<table  border='1'>";
    while ($row = mysqli_fetch_object($query)) {
    $user_tree_array[] = "<tr><td>".$space.$row->name.'</td><td><a href="edit.php?cat_id='.$row->cid.'">EDIT</td><td><a href="delete.php?cat_id='.$row->cid.'">Delete</td></tr>';
      $user_tree_array = fetchCategoryTreeListView($row->cid,$space,$user_tree_array);
    }
  // $user_tree_array[] = "</table>";
  }
  return $user_tree_array;
}

/*select option in edit*/
function fetchCategoryTreeEdit( $cid, $parent = 0, $spacing = '', $user_tree_array = '') {
  global $link;

  if (!is_array($user_tree_array))
    $user_tree_array = array();
   // return "ldddd1"; 
  $sql = "SELECT cid, name, parent FROM category WHERE 1 AND parent = $parent ORDER BY cid ASC";
  $query = mysqli_query($link,$sql);

  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_object($query)) {
     if($row->cid != $cid && $row->parent != $cid){
        $user_tree_array[] = array("id" => $row->cid, "name" => $spacing . $row->name);
        $user_tree_array = fetchCategoryTreeEdit((int)$cid,$row->cid, $spacing . '&nbsp;&nbsp;', $user_tree_array);
     }
    }
  }
  return $user_tree_array;
}

function getParentID($cid){
    global $link;
    $parent_id = '';
    $sql = "SELECT * FROM category WHERE 1 AND cid = $cid";
    $query = mysqli_query($link,$sql);
    if (mysqli_num_rows($query) > 0) {
      $parent_array =  mysqli_fetch_array($query);
      $parent_id = $parent_array['parent'];
    }
    return $parent_id;
}
function getChildID($cid){
    global $link;
    $child_ids = array();
    $sql = "SELECT * FROM category WHERE 1 AND parent = $cid";
    $query = mysqli_query($link,$sql);
    if (mysqli_num_rows($query) > 0) {
       while($childs_array =  mysqli_fetch_array($query)){
          $child_ids[] = $childs_array['cid'];
       }
      
    }
    return $child_ids;
}

?>
