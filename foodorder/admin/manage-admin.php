<?php include("partials/menu.php"); ?>

       <!--Main Content-->
       <div class="Main content">
        <div class="wrapper">
       <h1>Manage Admin</h1>

       <br /><br><br/>

       <?php
       if(isset($_SESSION['add']))
       {
              echo $_SESSION['add'];//displaying message
              unset($_SESSION['add']);//removing session message
       }

       if(isset($_SESSION['delete']))
       {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
       }

       if(isset($_SESSION['update']))
       {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
       }

       if(isset($_SESSION['user-not-found']))
       {
              echo $_SESSION['user-not-found'];
              unset($_SESSION['user-not-found']);
       }

       if(isset($_SESSION['pwd-not-match']))
       {
              echo $_SESSION['pwd-not-match'];
              unset($_SESSION['pwd-not-match']);
       }

       ?>
       <br><br><br>


       <!--Button to add admin-->
           <a href="add-admin.php" class="btn-primary">Add Admin</a>

           <br /><br><br/>

       <table class="tbl-full">
              <tr>
              <th>Serial Number</th>
              <th>Full Name</th>
              <th>Username</th>
              <th>Actions</th> 
       
              </tr>
              <?php
              //query to get all admin
              $sql = "SELECT * FROM tbl_admin";
              //execute query
              $res = mysqli_query($conn, $sql);
              //check whether query is executed
              if($res==TRUE)
              {
                     //Count rows to check for data in database
                     $count = mysqli_num_rows($res);// to get all rows in database

                     $sn=1; // assign a value
                     //check no.of rows
                     if($count>0)
                     {
                            //there is data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                   //getting data from database
                                   $id=$rows['id'];
                                   $full_name=$rows['full_name'];
                                   $username=$rows['username'];

                                   //dispay values in table
                                   ?>
                                     <tr>
                               <td><?php echo $sn++; ?></td>
                               <td><?php echo $full_name; ?></td>
                               <td><?php echo $username; ?></td>
                               <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"class="btn-primary">Change password</a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"class="btn-danger">Delete Admin</a>
                           
                     </td>
                   </tr>

                                   <?php


                            }
                     }
                     else
                     {
                            //no data

                     }

              }
              
              ?>

       </table>

        </div>
       </div>
       <!--Main content Ends-->

       <?php include("partials/footer.php"); ?>
       