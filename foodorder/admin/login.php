<?php include('../config/constants.php'); ?>




<html>
    <head>
        <title>Login - Restaurant Order System</title>
        <link rel="stylesheet" href="Admin.css">
    </head>

    <body>
        <div clas="login">
            <h1 class="text-center"> Login </h1>
            <br><br>
            
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            ?>
            <br><br>



            <!--login form-->
            <form action=""method="POST"class= "text-center">
                Username:<br>
                <input type="text"name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password"name="password" placeholder="Enter Password"><br><br>

                <input type="submit"name="submit" value ="Login" class="btn-primary">
                 <br><br>
            </form>
            <!--login form-->
        </div>
    </body>
</html>
<?php
//check if submit button is clicked
if(isset($_POST['submit']))
{
    //process for login
    //1.get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2.sql to check username and password
    $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.execute query
    $res = mysqli_query($conn, $sql);
    //4.count rows to check whether users exists
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //user available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful!</div>";
        $_SESSION['user'] = $username;// to check user is logged in
        //redirect to home page
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //user login fail
        $_SESSION['login'] = "<div class='error text-center'>Login Unsuccessful!<br>Username or Password is wrong.</div>";
        //redirect to home page
        header('location:'.SITEURL.'admin/login.php');

    }
    
   
   
}

?>