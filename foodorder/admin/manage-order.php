<?php include("<partials/menu.php")?>

<div class="main-content">
<div class="wrapper">
    <h1>Manage Orders</h1>
    

           <br /><br><br/>

       <table class="tbl-full">
              <tr>
              <th>Serial Number</th>
              <th>Food</th>
              <th>Price</th>
              <th>Qty.</th> 
              <th>Total</th> 
              <th>Status</th>
              <th>Customer Name</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Address</th>
              

       
              </tr>
              <?php
              //get orders from database
              $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //latest order first
              //execute query
              $res = mysqli_query($conn, $sql);
              //count the rows
              $count = mysqli_num_rows($res);

              $sn = 1; //serial number set to its initial value as 1


              if($count>0)
              {
                     //order available
                     while($row=mysqli_fetch_assoc($res))
                     {
                            //get all details
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $status= $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>
                              <tr>
                              <td><?php echo $sn++; ?></td>
                              <td><?php echo $food; ?></td>
                              <td><?php echo $price; ?></td>
                              <td><?php echo $qty; ?></td>
                              <td><?php echo $total; ?></td>
                              <td><?php echo $status; ?></td>
                              <td><?php echo $customer_name; ?></td>
                              <td><?php echo $customer_contact; ?></td>
                              <td><?php echo $customer_email; ?></td>
                              <td><?php echo $customer_address; ?></td>
                              
                              
                             </tr>

                            <?php

                     }
              }
              else
              {
                //order not available
                echo "<tr><td colspan='12'class='error'>Orders not Available</td></tr>";
              }
              
              ?>

              
              
              
              </tr>
       </table>

    </div>   
</div>

<?php include("<partials/footer.php")?>