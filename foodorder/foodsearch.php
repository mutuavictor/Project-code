<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

             //getting search keyword
             $search = $_POST['search'];

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
           

            //query based on search keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check whether food is available or not
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                      <div class="food-menu-box">
                      <div class="food-menu-img">
                          <?php
                          //check if image name is available
                          if($image_name=="")
                          {
                              //image not available
                              echo "<div class='error'>Image not Available.<?div>";
                          }
                          else
                          {
                              //image available
                              ?>
                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt=""class="img-responsive img-curve">
                              <?php
                          }

                          ?>
                     
                     </div>

                      <div class="food-menu-desc">
                     <h4><?php echo $title; ?></h4>
                     <p class="food-price">Kshs<?php echo $price; ?></p>
                     <p class="food-detail">
                        <?php echo $description; ?>
                     </p>
                     <br>

                     <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary" class="btn btn-primary">Order Now</a>
                    </div>
                      </div>


                    <?php

                }
            }

            else
            {
              //food not avilable
              echo "<div class='error'>Food not found.</div>";
            }
            ?>
            

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here --> 

    <?php include('partials-front/footer.php'); ?>