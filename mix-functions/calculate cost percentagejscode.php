<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div>
		<input type='text'  value='50' class="price">
	</div>
	<div>
		<input type='text'  value='20' class="price">
	</div>
	<div>
		<input type='text'  value='130' class="price">
	</div>
	<div>
		%<input type='text' name="" class="price_perc">
		Amount in %<input type='text' name="perc_amount" class="perc_amount">
		Net price<input type='text' name="net_price" class="net_price">
	</div>

<script>
$( ".price_perc" ).change(function() {
	var sum = 0;
	var perc = $(this).val();
    $('.price').each(function() {
        sum += Number($(this).val());
    });
    
    var perc_amount = (perc/100) * sum;
    var NetPrice = sum - perc_amount;

    $('.perc_amount').val(perc_amount);
    $('.net_price').val(NetPrice);

    console.log('%' + perc + ' amount in perc: ' + perc_amount + ' total: ' + NetPrice);

});

$( ".perc_amount" ).change(function() {
	var sum = 0;
	var perc_amount = $(this).val();
    $('.price').each(function() {
        sum += Number($(this).val());
    });
    
    var NetPrice = sum - perc_amount;
    var perc = perc_amount * (100/sum);

    $('.price_perc').val(perc);
    $('.net_price').val(NetPrice);

    console.log('%' + perc + ' amount in perc: ' + perc_amount + ' total: ' + NetPrice);

});

$( ".net_price" ).change(function() {
	var sum = 0;
	var NetPrice = $(this).val();
    $('.price').each(function() {
        sum += Number($(this).val());
    });
    
    var perc_amount = sum - NetPrice;
    var perc = perc_amount * (100/sum);

    $('.perc_amount').val(perc_amount);
    $('.price_perc').val(perc);

    console.log('%' + perc + ' amount in perc: ' + perc_amount + ' total: ' + NetPrice);

});


</script>

</body>
</html>