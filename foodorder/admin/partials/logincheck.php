<?php
     // check if user is logged in
     if(!isset($_SESSION['user']))
     {
          //user is not logged in
         //redirect to login page
         $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel.</div>";
         //redirect to login page
         header('location:'.SITEURL.'admin/login.php');
     }

?>