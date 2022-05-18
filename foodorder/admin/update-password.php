<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password"name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New pasword: </td>
                    <td>
                        <input type="password"name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                     <td>
                     <input type="password"name="confirm_password" placeholder="Confirm Password">
                     </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit"name="submit" placeholder="Change Password"class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>

<?php
//check submit button
if(isset($_POST['submit']))
{
    //echo "clicked";
    //get data
    $id=$_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    
    //check if current password exists
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //execute query
    $res =mysqli_query($conn, $sql);
    if($res==true)
    {
        //check whether data is available
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //user exists and password can be changed
           // echo "user found";
           if($new_password==$confirm_password)
           {
               //update password
               
           }
           else
           {
               //redirect
               $_SESSION['pwd-not-match'] ="<div class='error'>password not match. </div>";
               //redirect user
               header('location'.SITEURL.'admin/manage-admin.php');
           }
        }
    }
    else
    {
        //user does not exist
        $_SESSION['user-not-found'] ="<div class='error'>User not found. </div>";
        //redirect user
        header('location'.SITEURL.'admin/manage-admin.php');
    }
}

?>

<?php include("partials/footer.php"); ?>