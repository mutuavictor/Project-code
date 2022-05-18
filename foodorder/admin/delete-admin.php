<?php

include('../config/constants.php');

// get id of admin to be deleted
$id = $_GET['id'];

//create sql query to delete admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";

// execute query
$res = mysqli_query($conn, $sql);

if($res==true)
{
    //query execute successful
   // echo "admin deleted";
   $_SESSION['delete']= "<div class='success'>Admin deleted successfully.</div>";
   //redirect to manage admin
   header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
  //failed to delete admin
  //echo "failed to delete";
  $_SESSION['delete']="<div class='error'>Failed to delete admin. Try Again.</div>";
  header('location:'.SITEURL.'admin/manage-admin.php');
}
// redirect  to manage admin page with message success/error



?>
