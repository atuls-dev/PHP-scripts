<?php 
include 'common/header2.php'; 
if(ISSET($_REQUEST['eid'])){
    $eid = $_REQUEST['eid'];
}
if(ISSET($_POST['Update_'])){
        $coupon_id  = $_POST['coupon_id'];
        $tour_id = $_POST['tour_id'];

        $discount = $_POST['discount'];
        $start_date = $_POST['start_date'];
        $start_date = explode('/',$start_date);
        $start_date = $start_date[2].'-'.$start_date[0].'-'.$start_date[1];
        $end_date = $_POST['end_date'];
        $end_date = explode('/',$end_date);
        $end_date = $end_date[2].'-'.$end_date[0].'-'.$end_date[1];
        $created = date('Y-m-d H:i:s');
    
        
        $sqlQuery = mysqli_query($dbcnx_1, "UPDATE coupon SET tour_id = $tour_id, discount = '$discount', start_date='$start_date', end_date='$end_date'WHERE coupon_id='$coupon_id' ") or die(mysqli_error($dbcnx_1));
        if($sqlQuery){
            header('location: coupons.php?msg=edited');
        }else{
            $msg_error = 'Coupon Update Failed!';
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
                        <h1 class="page-header">Edit Coupon</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                       <a class="btn btn-primary" href="coupons.php" role="button">Back</a>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php if(isset($msg_error)){?>
                <div class="row">
                    <div class="col-md-12 text-center alert-danger">
                      <?php echo $msg_error ; ?>  
                    </div>                    
                </div>
                <?php } ?>
                <?php $coupon = getCoupon($eid); ?>
                <form action="" method="POST">
                    <input type="hidden" name="coupon_id" value="<?php echo $eid; ?>">
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
                                    $selected="";
                                    if($coupon['tour_id'] == $row_rooms['id']){
                                        $selected = "selected='selected'";
                                    }  
                                     echo "<option value='".$row_rooms['id']."' $selected >".$row_rooms['eventtitle']."</option>";
                              }
                              ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon" id="coupon" value="<?php echo $coupon['coupon_code']; ?>" required="required" disabled/>
                                <br />
                                
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="text" name="discount" value="<?php echo $coupon['discount']; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="text"id="start_date" name="start_date" value="<?php echo date('m/d/Y',strtotime($coupon['start_date'])); ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="text" id="end_date" name="end_date" value="<?php echo date('m/d/Y',strtotime($coupon['end_date'])); ?>"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary text-right" id="submit" value="Update" name="Update_" required="required"/>
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

    //validation for setting date range for coupon
    $(function () {
        $("#start_date").datepicker({
            //minDate:0,
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
