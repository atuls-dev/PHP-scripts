<?php 
include 'common/header2.php'; 
if( isset($_GET['msg']) ){
    $msg = ($_GET['msg'] =='edited'? 'Coupon has been Edited Successfully' : '');
}
if(isset($_REQUEST['delid'])) {
    $sqlDel = "DELETE FROM coupon WHERE coupon_id='".$_REQUEST['delid']."'";
    mysqli_query($dbcnx_1,$sqlDel);
    $msg_del = 1;
}

include 'common/header.php'; 
 ?>

        <div id="wrapper">
            <?php include 'common/sidebar.php'; ?>
    
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Manage Coupons</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12 text-center alert-success">
                        <?php  if(isset($msg)){  echo $msg; }  ?>
                    </div>
                    <div class="col-md-12 text-center alert-danger">
                        <?php 
                            if(isset($msg_del)){
                                echo "Coupon has been Deleted Successfully"; }
                        ?>
                    </div>
                </div>          
                <?php  $rData = getCoupons(); //echo"<pre>"; print_r($rData); ?>
                 <table style="width:100%" class="table table-bordered">
                        <tr>
                            <th>Coupon Code</th><th>Discount Value</th><th>Start Date</th><th>End Date</th><th>Tour package</th><th>Action</th>
                        </tr>
                    <?php 
                    foreach($rData as $row ) {
                     ?>
                       <tr>
                            <td><?php  echo $row['coupon_code']; ?></td> 
                            <td><?php  echo $row['discount']; ?></td>  
                            <td><?php  echo $row['start_date']; ?></td>  
                            <td><?php  echo $row['end_date']; ?></td>  
                            <td>
                            <?php
                              $sql_tours = "SELECT * FROM tours WHERE id = '".$row['tour_id']."'";
                              $res_tours = mysqli_query($dbcnx_1,$sql_tours);
                                 if(mysqli_num_rows($res_tours) > 0){
                                    $tour = mysqli_fetch_assoc($res_tours);
                                    if( !empty($tour['eventtitle']) ){
                                        echo $tour['eventtitle'];
                                    }else{ echo "NA";  }
                                 }else{  echo "No Package Found..."; }      
                                 ?>   
                            </td>
                            <td>
                                <a href="coupon_edit.php?eid=<?php echo $row['coupon_id']; ?>" class="btn btn-primary" data-toggle="tooltip" title="Edit" ><i class="fa fa-edit"></i></a>
                                <a href="coupons.php?delid=<?php echo $row['coupon_id']; ?>" onClick=" javascript: return confirm('Are you sure You want to delete');"  class="btn btn-primary" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>                            
                        <?php } ?>
                    </table>
            </div>
            <!-- /#page-wrapper -->
    </div>
        <!-- /#wrapper -->
<?php include 'common/footer.php'; ?>
