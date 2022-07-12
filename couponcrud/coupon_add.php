<?php 
include 'common/header2.php'; 

if(ISSET($_POST['save_'])){
        $tour_id = $_POST['tour_id'];
        $coupon_code = $_POST['coupon'];
        $discount = $_POST['discount'];
        $start_date = $_POST['start_date'];
        $start_date = explode('/',$start_date);
        $start_date = $start_date[2].'-'.$start_date[0].'-'.$start_date[1];
        $end_date = $_POST['end_date'];
        $end_date = explode('/',$end_date);
        $end_date = $end_date[2].'-'.$end_date[0].'-'.$end_date[1];
        $created = date('Y-m-d H:i:s');
    
        $query = mysqli_query($dbcnx_1, "SELECT * FROM coupon WHERE coupon_code = '$coupon_code'") or die(mysqli_error($dbcnx_1));
        $row = mysqli_num_rows($query);
        
        if($row > 0){
            $msg_error = 'Coupon Already Use, Please Try Again';
        }else{
            mysqli_query($dbcnx_1, "INSERT INTO coupon ( tour_id, coupon_code, discount, start_date, end_date, created ) VALUES ( $tour_id, '$coupon_code', '$discount', '$start_date', '$end_date', '$created')") or die(mysqli_error($dbcnx_1));
            $msg = 'Coupon Saved!';
        }
 }

include 'common/header.php'; 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

        <div id="wrapper">
            <?php include 'common/sidebar.php'; ?>
    
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Create Coupon</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php if(isset($msg)){?>
                <div class="row">
                    <div class="col-md-12 text-center alert-success">
                      <?php echo $msg; ?>  
                    </div>                    
                </div>
                <?php } ?>
                <?php if(isset($msg_error)){?>
                <div class="row">
                    <div class="col-md-12 text-center alert-danger">
                      <?php echo $msg_error ; ?>  
                    </div>                    
                </div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <select class="form-control" name="tour_id" id="tour_id" required>
                            <option value="">Select Tour/Event</option>
                              <?php
                              $currentdate = date('Y-m-d');
                              $sql_rooms = "SELECT * FROM tours WHERE eventstartdate > $currentdate";
                              $res_rooms = mysqli_query($dbcnx_1,$sql_rooms);
                             
                              while ($row_rooms= mysqli_fetch_array($res_rooms)){
                               
                                     echo "<option value='".$row_rooms['id']."'>".$row_rooms['eventtitle']."</option>";
                              }
                              ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon" id="coupon" readonly="readonly" required="required"/>
                                <br />
                                <button id="generate"  type="button"><span class="glyphicon glyphicon-random"></span> Generate</button>
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="text" name="discount" required="required"/>
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="text"id="start_date" name="start_date" required="required"/>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="text" id="end_date" name="end_date" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" id="submit" value="Create" name="save_" required="required"/>
                            </div>
                        </div>
                 
                    <div style="clear:both;"></div>

                </div>
            </form>               
                  
            </div>
            <!-- /#page-wrapper -->

        </div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script >
    //get coupon code js
    $(document).ready(function(){
        $('#generate').on('click', function(){
            $.get("get_coupon.php", function(data){
                $('#coupon').val(data);
            });
        });
    });


    //validation for setting date range for coupon
    $(function () {
        $("#start_date").datepicker({
            minDate:0,
            numberOfMonths: 1,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate());
                $("#end_date").datepicker("option", "minDate", dt);
            }
         });
        $("#end_date").datepicker({
            numberOfMonths: 1,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate());
                $("#start_date").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>

 <!-- Footer JavaScript Code-->
        <script src="js/bootstrap.min.js"></script>

        <script src="js/metisMenu.min.js"></script>

        <script src="js/startmin.js"></script>

    </body>
</html>
        <!-- /#wrapper -->
<?php// include 'common/footer.php'; ?>
