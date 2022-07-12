<?php
include 'config.php';

$con=mysqli_connect('localhost','dev','password','mysite_db_test');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<table style="width:100%" class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Phone</th>
           
        </tr>

<?php ///find duplicates  of diffrent two column in one table////
    $sql= "SELECT a.* FROM leads a JOIN (SELECT email, COUNT(*) FROM leads GROUP BY email HAVING COUNT(*) > 1 ) b ON a.email = b.email 
                          UNION
          SELECT a.* FROM leads a JOIN (SELECT phone, COUNT(*) FROM leads GROUP BY phone HAVING COUNT(*) > 1 ) b ON a.phone = b.phone ";

    print_r($sql);
    $res = mysqli_query( $con,$sql );

    while( $row = mysqli_fetch_assoc($res) ) { ?>
      
     <tr>
         <td><?php  echo $row['id']; ?></td>  
          <td><?php  echo $row['email']; ?></td>  
          <td><?php  echo $row['phone']; ?></td>  
      </tr>                            
      <?php } ?>
</table>


<!-- 
SELECT email, COUNT(*) FROM leads GROUP BY email HAVING COUNT(*) > 1 ;
SELECT phone, COUNT(*) FROM leads GROUP BY phone HAVING COUNT(*) > 1 ;

 -->
