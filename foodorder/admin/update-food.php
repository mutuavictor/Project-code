<?php include('partials/menu.php');?>

<div class ="main content">
    <div class ="wrapper">
        <h1>Update Food</h1>

        <br><br>

    <?php
    //check if id is set or not
    if(isset($_GET['id']))
    {
        //echo"getting data";
        $id = $_GET['id'];
        //create sql query to get the details
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($res2);
            //getting values
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else
        {
            //redirect to manage category with session message
            
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    ?>
        <form action=""method="POST" enctype="multipart/form-data"> <!--will allow uploading of images--> 
       
        <table class="tbl-30">
                <tr>               
                   <td>Title: </td>
                    <td>                  
                        <input type = "text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                      
                <tr>
                    <td>Current Image: </td>
                    <td>
                     <?php
                       if($current_image == "")
                       {
                        //display the message
                        echo "<div class='error'>Image Not Available.</div>";
                       }
                       else
                       {
                        //image available
                        ?>
                        <img src ="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width="150px">
                        <?php
                       }

                     ?>
                    
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php 
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        //execute query
                        $res = mysqli_query($conn, $sql);
                        //count rows
                        $count =mysqli_num_rows($res);

                        //check if category is available
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title = $row['title'];
                                $category_id = $row['id'];

                                //echo "<option value='$category_id'>$category_title</option>";
                                ?>
                                <option <?php if($current_category==$category_id){echo "selected ";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                <?php

                            }
    
                            
                        }
                        else
                        {
                            echo"<option value='0'>Category Not Available.</option>";
                        }
                        
                        ?>

                        </select>
                    </td>
                
                    
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                    <input type = "file" name="image">
                    </td>
                </tr>

                    </tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                         <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                         <input <?php if($active=="No"){echo "checked";} ?>type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden"name= "current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden"name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>

                </tr>
                    </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                
                    //get all values from form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];

                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //updating new image if selected
                    //check if image is selected
                    if(isset($_FILES['image']['name']))
               {
                        //get image details
                        $image_name = $_FILES['image']['name'];
                        //check if image is available
                        if($image_name!= "")
                        {
                            //image available

                            //Upload new Image 

                           //auto rename image
                           //get extension of image(jpg)
                          $ext = end(explode('.', $image_name));

                           //rename image
                           $image_name= "Food-Name-".rand(0000, 9999).'.'.$ext;//e.g. Food_Category_2.jpg

                           $source_path=$_FILES['image']['tmp_name'];

                           $destination_path="../images/food/".$image_name;

                           //Upload the image
                          $upload = move_uploaded_file($source_path, $destination_path);
                          //check if image is uploaded
                         if($upload==false)
                          {
                             $_SESSION['upload']="<divclass='error'>Failed to Upload Image.</div>";
                             //redirect
                             header('location:'.SITEURL.'admin/manage-food.php');
                             //stop the process so that it doesnt go to database
                             die();
                          }
               // remove the current image if available
                        }
                  if($current_image!="")
               {
                 $remove_path = "../images/food/".$current_image;
                 $remove = unlink($remove_path);
                 //check if image is removed
                 if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['remove-failed'] ="<div class='error'>Failed to remove current image.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();// stop the process
                }

               }
               
                        
                        else
                        {
                            $image_name = $current_image;
                        }
                }
                    else
                    {
                        $image_name = $current_image;
                    }
                    

                    //update the database
                    $sql3 = "UPDATE tbl_food SET
                     title = '$title',
                     description = '$description',
                     price = '$price,
                     image_name = '$image_name',
                     featured = '$featured',
                     category_id = '$category',
                     active = '$active'
                     WHERE id=$id 
                     ";
                    //execute query
                     $res3 = mysqli_query($conn, $sql3);

                //redirect to manage category
                if($res3==true)
                {
                    //category updated
                    $_SESSION['update']="<div class='success'>Food Updated Successfully.<?div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                     //failed to update category 
                     $_SESSION['update']="<div class='error'>Food Failed to Update.<?div>";
                     header('location:'.SITEURL.'admin/manage-food.php');
                }

                }
            ?>

    </div>
</div>
<?php include('partials/footer.php');?>
