<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>



        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text"name ="title" palceholder= "Title of food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"cols="30" rows="5" placeholder="Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number"name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file"name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            
                            <?php
                            //create php code to dispay categories from database
                            //create sql to get all active categories from database
                            $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                            //executing query
                            $res = mysqli_query($conn, $sql);
                            //count rows to check whether there are categories
                            $count = mysqli_num_rows($res);
                            //if count is greater than zero there are categories
                            if($count>0)
                            {
                                //there are categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //details of categories are got
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php

                                }
                            }
                            else
                            {
                                //no categories
                                ?>

                                <option value="0">No category found</option>

                                <?php
                            }

                            //Display on dropdown
                            ?>
                        
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio"name="featured"value="Yes">Yes
                        <input type="radio"name="featured"value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio"name="active"value="Yes">Yes
                    <input type="radio"name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        //check if button is clicked
        if(isset($_POST['submit']))
        {
            //add food
            //1. getting data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio on button for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured ="No";
            }
            if(isset($_POST['active']))
            {
                $featured = $_POST['active'];
            }
            else
            {
                $featured ="No";
            }


            //2. uploading image when selected
            //check if image selected is clicked or not
            if(isset($_FILES['image']['name']))
            {
                //getting details of selected image
                $image_name = $_FILES['image']['name'];
                //check if image is selected or not 
                if($image_name!="")
                {
                    //image is selected
                    //rename image
                    //getting extension of selected image(jpg)
                    $image_info = explode (".", $image_name);
                    $ext = end ($image_info);
                    //create new name for image
                    $image_name = "Food-Name-".rand(0000,9999).".".$ext;// new image name

                    //upload image
                    //getting the src path and destination path

                    //source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];
                    //destination path for the image to be uploaded
                    $dst = "../images/food/".$image_name;
                    //finally upload the food image
                    $upload = move_uploaded_file($src, $dst);
                    //check if image is uploaded
                    if($upload==false)
                    {
                        //failed to uplaod
                        //redirect back to add food page with message error
                        $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                        header('loaction:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }
            }
            else
            {
                $image_name="";//default value set as blank

    
            }

            //3. insert into database
            // sql query to save or add food
            $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active ='$active'
            ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //check if data is inserted

            //4. redirect with message to manage food page
            if($res2 == true)
            {
                //data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:'. SITEURL.'admin/manage-food.php');
            }
            else
            {
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                header('location:'. SITEURL.'admin/manage-food.php');
            }
        }

        ?>



    </div>
</div>
<?php include ('partials/footer.php'); ?>