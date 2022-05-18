<?php

//start session
session_start();

  // create constants to store non repeating values
  define('SITEURL','http://localhost/foodorder/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','foodorder');



  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);//database connection
  $db_select = mysqli_select_db($conn, DB_NAME);

?>