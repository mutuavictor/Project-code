<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>

        <br><br>

        <?php 
        if(isset($_SESSION['add']))//checking session is set
        {
            echo $_SESSION['add'];//dispaly session message
            unset($_SESSION['add']);
        }



        ?>
        
        <form action=""method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text"name="username"placeholder="Your username">

                    </td>

                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password"placeholder="Your password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"name="submit" value="Add Admin"class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>


<?php include("partials/footer.php"); ?>


<?php
 //process value from form and save in database
 //check if submit button is clicked or not

if(isset($_POST["submit"]))
{
    //button is clicked
   
    //get data from form
     $full_name =$_POST['full_name'];
     $username =$_POST['username'];
     $password =md5($_POST['password']);//password encrypted

     //sql query to save data to database
     $sql = "INSERT INTO tbl_admin SET
         full_name='$full_name',
         username='$username',
         password='$password'   
     ";
   
  //executing query and saving to database
     $res = mysqli_query($conn, $sql);


     //checkif ok
    if($res==TRUE)
    {
        //Data inserted
        //echo"data inserted";
       //create a session variable to display message

       $_SESSION['add']= "Admin Added Successfully";
       //redirect page
       header("location:".SITEURL.'admin/manage-admin.php');


    }


else
{
    //failed
   // echo "failed";
   //create a session variable to display message

   $_SESSION['add']= "Failed to Add Admin";
   //redirect page to add admin
   header("location:".SITEURL.'admin/add-admin.php');
}

}


 ?>