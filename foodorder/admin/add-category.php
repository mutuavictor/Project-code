<?php include('partials/menu.php');?>

<div class ="main content">
    <div class ="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

        <!--Add Category-->
        <form action=""method="POST" enctype="multipart/form-data"> <!--will allow uploading of images--> 
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type = "text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured"value="Yes">Yes
                        <input type="radio" name="featured"value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio" name="active"value="Yes">Yes
                    <input type="radio" name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit"value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--add category ends-->

         <?php
         //check button
         if(isset($_POST['submit']))
         {
            // echo "clicked";
            //get value from form
            $title =$_POST['title'];

            //for radio input checking if button is selected
            if(isset($_POST['featured']))
            {
               $featured= $_POST['featured'];
            }
            else{
                //set the default value
                $featured ="No";

            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";
            }
            //check whether the image is selected
            //print_r($_FILES['image']);

           // die();//break the code here
           if(isset($_FILES['image']['name']))
           {
               //upload image
               //image name,source path and destination path
               $image_name=$_FILES['image']['name'];
               //upload image only if image is selected
               if($image_name !="")
               {

               //auto rename image
               //get extension of image(jpg)
               $ext = end(explode('.',$image_name));

               //rename image
               $image_name= "Food_Category_".rand(000, 999).'.'.$ext;//e.g. Food_Category_2.jpg

               $source_path=$_FILES['image']['tmp_name'];
               $destination_path="../images/category/".$image_name;

               //upload the image
               $upload = move_uploaded_file($source_path, $destination_path);
               //check if image is uploaded
               if($upload==false)
               {
                   $_SESSION['upload']="<divclass='error'>Failed to Upload Image.</div>";
                   //redirect
                   header('location:'.SITEURL.'admin/add-category.php');
                   //stop the process so that it doesnt go to database
                   die();
               }
            }
           }
           else
           {
               //dont upload image
               $image_name="";
           }
            //create sql query to insert category into database
            $sql = "INSERT INTO tbl_category SET
            title = '$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //execute query and save
            $res = mysqli_query($conn, $sql);

            //check if query executed
            if($res==true)
            {
                //query executed and category added
                $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                 //failed to add category
                 $_SESSION['add']="div class='success'>Failed to ADD.</div>";
                 //redirect to manage category page
                 header('location:'.SITEURL.'admin/manage-category.php');
            }
         }
         ?>

    </div>
</div>

<?php include('partials/footer.php');?>