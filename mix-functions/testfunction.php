<?php
ini_set('display_errors', '1');
include('upload_function.php');
if(isset($_POST['submit'])){
//	print_r($_POST);
list($file_name,$msg) = upload_file('fileToUpload','upload','',array());
echo $file_name;
}

 ?>
<!DOCTYPE html>
<html>
<body>
<?php if(isset($msg)){ echo $msg; } ?>
<pre>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="range" name="range" min="0" max="5" value="50">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
