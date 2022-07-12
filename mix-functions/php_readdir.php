<?php

/*include('/home2/shorelin/home/shorelin/public_html/carrsaltpi/uploads/testfile.php');
*/

$files = scandir('/home2/shorelin/home/shorelin/public_html/carrsaltpi/uploads', SCANDIR_SORT_DESCENDING);
$newest_file = $files[0];
echo $newest_file;
echo "<br /><pre>";
print_r($files);
echo "<br /><pre>";

/*$file_name = $file['name'];
$file_ext = substr($file_name, strrpos($file_name, ‘.’)+1);
if(!in_array($file_ext,$allowedExtensions)){
$error_msg = ‘File ‘.$file_name.’ is not allowed’;
}
*/
echo "<br /><pre>";
//print_r($files);
$dirss = glob("/home2/shorelin/home/shorelin/public_html/carrsaltpi/uploads/*.csv");
print_r($dirss);

$final = glob("/home2/shorelin/home/shorelin/public_html/carrsaltpi/uploads/[uselog]*.csv");
print_r($final);
rsort($final);
echo "sort";
print_r($final);
echo "sort4444";
 $files = glob("/home2/shorelin/home/shorelin/public_html/carrsaltpi/uploads/[uselog]*.csv");
            rsort($files);
            $newest_file = $files[0];

echo $newest_file; 
?>