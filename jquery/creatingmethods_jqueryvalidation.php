
////////////////////////////// validation form//////////////////////

<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$.validator.setDefaults({
  submitHandler: function() { 
    document.hreg.submit();//$('#hreg').submit();
  }
});

$().ready(function() {
  // validate the comment form when it is submitted

    //custom validation rule - deposit amount
    $.validator.addMethod("deposit", 
         function(value, element) {
      if( $('input[name=deposit]:checked').val() == '3' ) {
        var custom_deposit =  parseFloat( value );

        if( isNaN( custom_deposit ) || custom_deposit <= 0 ) return false;
        if( custom_deposit > parseFloat( $('input[name=total_amount]').val() ) ) return false;
        if( custom_deposit < parseFloat( $('input[name=day_amount]').val() ) ) return false;
        return true;
      } else return true;
         }, 
         "Please enter valid deposit amount. Amount should be greater than the minimum deposit and less than the total!"
    );  

  //custom validation rule - date format
    jQuery.validator.addMethod(
        "dateFormat",
        function(value, element) {
            var check = false;
            var re = /^\d{1,2}\-\d{1,2}\-\d{4}$/;
                if( re.test(value)){
                    var adata = value.split('-');
                    var mm = parseInt(adata[0],10);
                    var dd = parseInt(adata[1],10);
                    var yyyy = parseInt(adata[2],10);
                    var xdata = new Date(yyyy,mm-1,dd);
                    if ( ( xdata.getFullYear() === yyyy ) && ( xdata.getMonth () === mm - 1 ) && ( xdata.getDate() === dd ) ) {
                    check = true;
                }
                else {
                    check = false;
                }
            } else {
              check = false;
            }
            return this.optional(element) || check;
        },
        "Wrong date format"
    ); 
    //custom validation rule - passportcountry
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please enter letters only"); 

  // validate signup form on keyup and submit
  $("#hreg").validate({
    rules: {
      roomcategory: "required",
      /*smoking   : "required",*/
      arrival   : "required",
      departure : "required",
      traveler1 : "required",
      t1dob : {  required: true, dateFormat: true },
      t1passcountry : {  required: true, lettersonly: true },
      t2dob : { dateFormat: true },
      custom_deposit : { required: true, deposit: true },
      billingfname: "required",
      /*billinglname: "required",*/
      billingaddr1: "required",
      billingcity : "required",
      billingstate: "required",
      billingzip  : "required",
      billingcountry  : "required",
      billingemail: {
        required: true,
        email: true
      },
      billingphone    : "required",
      cctype    : "required",
      cardnumber  : {
        required: function(value, element) {
              if( $('input[name=optPay]:checked').val() == 'check' ) return false;
              else return true;
                },
        creditcard: function(value, element) {
              if( $('input[name=optPay]:checked').val() == 'check' ) return false;
              else return true;
                },
      },
      cvc     : {
        required: function(value, element) {
              if( $('input[name=optPay]:checked').val() == 'check' ) return false;
              else return true;
                }
      },
      hotelpolicy: "required"
       
    },
    messages: {     
      roomcategory  : "Please select Room type",
      /*smoking     : "Please select Preferences",*/
      arrival     : "Please select Arrival date",
      departure   : "Please select Departure date",
      traveler1   : "Please enter traveler 1 full name",
      tpasscountry : "Please enter passport country",
      custom_deposit  : "Please enter valid deposit amount. Amount should be greater than the minimum deposit and less than the total!",
      /*billingfname  : "Please enter Billing first name",*/
      billinglname  : "Please enter Billing full name",
      billingaddr1  : "Please enter Billing address 1",
      billingcity   : "Please enter Billing city",
      billingstate  : "Please select Billing state",
      billingzip    : "Please enter Billing zip",
      bcountry    : "Please enter Billing country",
      billingemail  : "Please enter a valid email address",
      billingphone  : "Please enter Billing phone",
      cctype      : "Please select Credit Card Type",
      cardnumber    : "Please enter Credit Card",
      cvc       : "Please enter CVC Security code",
      hotelpolicy   : "Please accept our policy"
    }
  });
    
  
  
});
</script>