<?php

include('../config/constants.php');
//check if id and image name is set
if(isset($_GET['id'])AND isset($_GET['image_name']))
{
    //get value and delte
   // echo "get value and delete";
   $id = $_GET['id'];
   $image_name = $_GET['image_name'];
   //remove the physical image file
   if($image_name != "") 
   {
       //image is available to remove
       $path ="../images/food/".$image_name;
       //remove image
       $remove = unlink($path);
       // if failed add error message
       if($remove==false)
       {
           $_SESSION['upload'] ="<div class='error'>Failed to remove food image.</div>";
           //redirect to manage category page
           header('location:'.SITEURL.'admin/manage-food.php');
           //stop the process
           die();
       }
   }

   //delete data from database
   $sql ="DELETE FROM tbl_food WHERE id=$id";
   //execute query
   $res = mysqli_query ($conn, $sql);
   //check if the data is deleted from database
   if($res==true)
   {
       //set success message and redirect
       $_SESSION['delete'] ="<div class='success'>Food deleted Successfully.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-food.php');
   }
   else
   {
       
       //set Fail message and redirect
       $_SESSION['delete'] ="<div class='error'>Failed to delete food.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-food.php');
   }

}
else
{
    //redirect to manage food page
    $_SESSION['unauthorize'] ="<div class='error'>Failed to delete food.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>