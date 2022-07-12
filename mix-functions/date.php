<?php
function validate_Date($mydate,$format = 'DD-MM-YYYY') {

    if ($format == 'YYYY-MM-DD') list($year, $month, $day) = explode('-', $mydate);
    if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $mydate);
    if ($format == 'YYYY.MM.DD') list($year, $month, $day) = explode('.', $mydate);

    if ($format == 'DD-MM-YYYY') list($day, $month, $year) = explode('-', $mydate);
    if ($format == 'DD/MM/YYYY') list($day, $month, $year) = explode('/', $mydate);
    if ($format == 'DD.MM.YYYY') list($day, $month, $year) = explode('.', $mydate);

    if ($format == 'MM-DD-YYYY') list($month, $day, $year) = explode('-', $mydate);
    if ($format == 'MM/DD/YYYY') list($month, $day, $year) = explode('/', $mydate);
    if ($format == 'MM.DD.YYYY') list($month, $day, $year) = explode('.', $mydate);       

    if (is_numeric($year) && is_numeric($month) && is_numeric($day))
        return checkdate($month,$day,$year);
    return false;           
}         

if(isset($_POST['date'])){
	echo $_POST['date']."<br/>";
$date = explode('/', $_POST['date']);
print_r($date);
$year = $date[2]; $day = $date[1]; $month = $date[0];

 $dateValid = checkdate ( $month, $day, $year );
 var_dump($dateValid);
 if($dateValid){

 	echo "valid";
 }else{
 	echo " not valid";
 }
}

?>

<form id="myform" method="post">
	<input type="text" name="idate" placeholder="mm/dd/yyyy">
	<!-- <span class="error"> Invalid Date.(mm/dd/yyyy or mm-dd-yyyy)
	</span> -->
	<input type="submit" name="submit" id="btnSubmit">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
<script>

// just for the demos, avoids form submit
/*jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});*/

$( "#myform" ).validate({
  rules: {
    idate: {
      required: true,
      date: true
    }
  },
/*  message:{
      idate; {
        date: 'invalid format'
      }
    },*/
 submitHandler: function(form) {
      form.submit();
    }
});

</script>