<?php include('partials-front/menu.php'); ?>

   <?php
   //check if food id is set
     
    if(isset($_GET['food_id']))
   {
       //food id and details of selected food
       $food_id = $_GET['food_id'];

       //getting details of selected food
       $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
       //execute query
       $res = mysqli_query($conn, $sql);
       //count the rows
       $count = mysqli_num_rows($res);
       //check if the data is available 
       if($count==1)
       {
           //get data from database
           $row = mysqli_fetch_assoc($res);

           $title = $row['title'];
           $price = $row['price'];
           $image_name = $row['image_name'];
       }
       else
       {
           //food not available
           //redirect to home page
           header('loction:'.SITEURL);
       }
   }
   else
   {
     //redirect to homepage
     header('loaction:'.SITEURL);
   }



   ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill in this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                       <?php
                        if($image_name=="")
                        {
                           //display message
                            echo"<div class='error'>Image not Available<?div>";
                        }
                        else
                        {
                           //image available
                           ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                           <?php
                        }
                       ?>
                      
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden"name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Kshs<?php echo $price; ?></p> 
                        <input type="hidden"name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder=" Mutua Victor" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="07xxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="xxxx@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="   " class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
             //check if submit button is clicked
             if(isset($_POST['submit']))
             {
                 //get all the details from the form

                 $food = $_POST['food'];
                 $price = $_POST['price'];
                 $qty = $_POST['qty'];

                 $total = $price * $qty; //total = price x qty

                 

                 $status = "Ordered"; //ordered, on delivery, delivered, cancelled

                 $customer_name = $_POST['full-name'];
                 $customer_contact = $_POST['contact'];
                 $customer_email = $_POST['email'];
                 $customer_address = $_POST['address'];

                 //save the order in database
                 //sql to save the data
                 $sql2 = "INSERT INTO tbl_order SET
                  food = '$food',
                  price = $price,
                  qty = $qty,
                  total = $total,
                  status = '$status',
                  customer_name = '$customer_name',
                  customer_contact = '$customer_contact',
                  customer_email = '$customer_email',
                  customer_address = '$customer_address'
                  
                 ";

                 //echo $sql2; die();

                 //execute query
                 $res2 = mysqli_query($conn, $sql2);

                 //check whether query executed successfully
                 if($res2==true)
                 {
                     //query executed and order saved
                     $_SESSION['order']="<div class='success text-center'>Food Ordered Succesfully.</div>";
                     //redirect 
                      header('location:'.SITEURL);

                 }
                 else
                 {
                   //failed to save order
                   $_SESSION['order']="<div class='error text-center'>Failed To Order Food.</div>";
                   //redirect 
                   header('location:'.SITEURL);


                 }
             }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>