<?php 

     //constants file
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
             $path ="../images/category/".$image_name;
             //remove image
             $remove = unlink($path);
             // if failed add error message
             if($remove==false)
             {
                 $_SESSION['remove'] ="<div class='error'>Failed to remove category image.</div>";
                 //redirect to manage category page
                 header('location:'.SITEURL.'admin/manage-category.php');
                 //stop the process
                 die();
             }
         }

         //delete data from database
         $sql ="DELETE FROM tbl_category WHERE id=$id";
         //execute query
         $res = mysqli_query ($conn, $sql);
         //check if the data is deleted from database
         if($res==true)
         {
             //set success message and redirect
             $_SESSION['delete'] ="<div class='success'>Category deleted Successfully.</div>";
              //redirect to manage category page
              header('location:'.SITEURL.'admin/manage-category.php');
         }
         else
         {
             
             //set Fail message and redirect
             $_SESSION['delete'] ="<div class='success'>Failed to delete category.</div>";
              //redirect to manage category page
              header('location:'.SITEURL.'admin/manage-category.php');
         }

      }
      else
      {
          //redirect to manage category pge
          header('location:'.SITEURL.'admin/manage-category.php');
      }
      
?>
