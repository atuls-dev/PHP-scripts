<?php 
function upload_file($input,$target="",$limitsize="",$limittypes=array()){
	//$result = array();
	$File = basename($_FILES[$input]["name"]);
	$FileName = pathinfo($File,PATHINFO_FILENAME);
	$ActualName  = $FileName;
	$FileType = strtolower(pathinfo($File,PATHINFO_EXTENSION));

	//Target Where the file must be uploaded to
    if(isset($target)){ 
	    $target_dir = $target.'/'; 
	    $year = date("Y");   
		$month = date("M");   
	    if( is_dir( $target ) ){
			$target_dir .= $year;   
	    	mkdir($target_dir, 0755);
			if( is_dir( $target_dir ) ){
				$target_dir .= "/".$month;
				mkdir($target_dir, 0755);
			}
	    }
    } //Add a '/' at the end of the folder
    echo $target_dir;
   die();

   
	$target_file = $target_dir.$File;

	// Check if file already exists
	if (file_exists($target_file)) {
		$i = 1;
		while(file_exists($target_dir.$FileName.".".$FileType)){
			$FileName = (string)$ActualName."(".$i.")";
			$File = $FileName.".".$FileType;
			$i++;
		}
	} 

	///checking if file is image or not////
	/*$check = getimagesize($_FILES[$input]["tmp_name"]);
	if($check !== false) {
        $error = "File is an image - " . $check["mime"] . ".";
        return array('',$error);
    } else {
        $error = "File is not an image.";
        return array('',$error);
    }
	*/

	// Check file size
	if( !empty($limitsize) ) {
		if ($_FILES[$input]["size"] > $limitsize) {
			$error = "Sorry, your file is too large.";
			return array('',$error);
		}
	}

	// Allow certain file formats
	if( !empty($limittypes) ) {
        if(in_array($FileType,$limittypes));
        else {
            $error = "'".$_FILES[$input]['name']."' is not a valid file."; //Show error if any.
            return array('',$error);
        }
    }
	
	$target_file = $target_dir . $File;
	if (move_uploaded_file($_FILES[$input]["tmp_name"], $target_file)) {
        $success= "The file ". basename( $_FILES[$input]["name"]). " has been uploaded.";
       return array($File,$success);
    } else {
        $error = "Sorry, there was an error uploading your file.";
        return array('',$error);
    }

}







function upload_files($input,$target_dir="",$limitsize="",$limittypes=array()){
	//$result = array();
	$File = basename($_FILES[$input]["name"]);
	$FileName = pathinfo($File,PATHINFO_FILENAME);
	$ActualName  = $FileName;
	$FileType = strtolower(pathinfo($File,PATHINFO_EXTENSION));
	$target_file = $target_dir.$File;

	// Check if file already exists
	if (file_exists($target_file)) {
		$i = 1;
		while(file_exists($target_dir.$FileName.".".$FileType)){
			$FileName = (string)$ActualName."(".$i.")";
			$File = $FileName.".".$FileType;
			$i++;
		}
	} 

	///checking if file is image or not////
	/*$check = getimagesize($_FILES[$input]["tmp_name"]);
	if($check !== false) {
        $error = "File is an image - " . $check["mime"] . ".";
        return array('',$error);
    } else {
        $error = "File is not an image.";
        return array('',$error);
    }
	*/

	// Check file size
	if( !empty($limitsize) ) {
		if ($_FILES[$input]["size"] > $limitsize) {
			$error = "Sorry, your file is too large.";
			return array('',$error);
		}
	}

	// Allow certain file formats
	if( !empty($limittypes) ) {
        if(in_array($FileType,$limittypes));
        else {
            $error = "'".$_FILES[$input]['name']."' is not a valid file."; //Show error if any.
            return array('',$error);
        }
    }
	
	$target_file = $target_dir . $File;
	if (move_uploaded_file($_FILES[$input]["tmp_name"], $target_file)) {
        $success= "The file ". basename( $_FILES[$input]["name"]). " has been uploaded.";
       return array($File,$success);
    } else {
        $error = "Sorry, there was an error uploading your file.";
        return array('',$error);
    }

}



?>