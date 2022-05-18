<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <a href="category-foods.html">
            <div class="box-3 float-container">
                

                <h3 class="float-text text-white"></h3>
            </div>
            </a>

         <?php

          //display active categories
          $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

          //execute query
          $res = mysqli_query($conn, $sql);
          // count rows
          $count = mysqli_num_rows($res);
          //if category is available
          if($count>0)
          {
              //catrgories available
              while($row=mysqli_fetch_assoc($res))
              {
                  //get values
                  $id=$row['id'];
                  $title=$row['title'];
                  $image_name=$row['image_name'];
            ?>
                   <a href="<?php echo SITEURL; ?>foodcategory.php?category_id=<?php echo $id; ?>">
                       <div calss = "box-3 float-container">
                         <?php
                           if($image_name=="")
                           {
                               //image not available
                               echo"<div class ='error'> Image not found.</div>";

                           }
                           else
                           {
                               //image available
                               ?>
                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                               <?php
                           }
                         ?> 

                         <h3 class="float-text text-white"><?php echo $title; ?></h3>

                         </div>
                         </a>

                          <?php
              }

          }
          else
          {
              //categories not available
              echo "<div class='error'>Category not found<?div>";
          }
         
        ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>