<?php
class cat{
 	public $child_cat_cid;
 
 
 
	function cat_list($p_cid=0,$space=''){
 	global $link;
 	$q="SELECT * FROM category WHERE parent='$p_cid'";
	$r=mysqli_query($link,$q) or die(mysql_error());
	
	$count=mysqli_num_rows($r);
	
	if($p_cid==0){
		$space='';
	}else{
		$space .="--";
	}
	if($count > 0){
		
		while($row=mysqli_fetch_array($r)){
			echo '<option value="'.$row['cid'].'">'.$space.$row['name'].'</option>';
			
			$this->cat_list($row['cid'],$space);
			}
			
		}
	
 	}



			/*select option in edit*/
		function fetchCategoryTreeEdit($parent, $spacing = '', $user_tree_array = '') {
			global $link;

			if (!is_array($user_tree_array))
			$user_tree_array = array();
			// return "ldddd1"; 
			$sql = "SELECT cid, name, parent FROM category WHERE 1 AND parent = $parent ORDER BY cid ASC";
			$query = mysqli_query($link,$sql);

			if (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_object($query)) {
			  		$user_tree_array[] = array("id" => $row->cid, "name" => $spacing . $row->name);
			  		$user_tree_array = fetchCategoryTreeEdit($row->cid, $spacing . '&nbsp;&nbsp;', $user_tree_array);

				}
			}
			return $user_tree_array;
		}

 
}
?>