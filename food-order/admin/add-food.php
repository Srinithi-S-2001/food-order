<?php include('partials/menu.php'); ?>
<div class="main-content">
    <h3>Add Food</h3>
    <?php 
         if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
    
    ?>
    <form action="" method="post" enctype="multipart/form-data">
    <table class="add-admin">
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" placeholder="Enter the title"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td>
                <textarea name="description"  cols="30" rows="5" placeholder="Description of Food..."></textarea>        <!--here we need to give a large description so used text area-->
            </td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="number" name="price"></td>             <!--number input so type=number-->
        </tr>
        <tr>
            <td>Select Image:</td>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="category">
            <?php                                                           //displaying data from category table
                //1.create a sql to get all the active categories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                //executing the sql query
                $res=mysqli_query($conn,$sql);
                if($res==TRUE){
                    
                    //counting the no.of rows    
                    $count=mysqli_num_rows($res);
                    
                    //if count>0 then category exists
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){       //fetching the rows and storing as array in $row

                            $id= $row['id'];
                            $title= $row['title'];
                            ?>

                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                            
                            <?php
                        }
                    }
                    else{
                        ?>

                            <option value="0">No Category Found</option>
                        
                        <?php
                    }
                }
            
            ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name="featured" value="Yes" required>Yes
                <input type="radio" name="featured" value="No"required>No

            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="active" value="Yes" required>Yes
                <input type="radio" name="active" value="No" required>No
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type="hidden" value="<?php echo $id;?>" name="id">
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </td>
        </tr>
    </table>
    </form>
    <?php 
        if(isset($_POST["submit"]))  //checking if add food is clicked
        {
            //1.getting data except image 
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            //2.getting the image if isset and image name!=""
            if(isset($_FILES['image']['name']))
            {
                $image_name=$_FILES['image']['name'];
                if($image_name!="")
                {
                    $ext=end(explode('.',$image_name));
                    $image_name="Food_Name_".rand(0000,9999).'.'.$ext;
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../images/food/".$image_name;
                    $upload=move_uploaded_file($source_path,$destination_path);
                    if($upload==false)
                    {          //upload true
                        $_SESSION['upload']="<div class='failure'>Failed To Upload Image</div>";
                        header("location:".SITEURL."admin/add-food.php");
                        die();
                    }
                }else{
                    $image_name="";
                }
            }
            else
            {
                $image_name="";
            }
        
            //3.sql to enter the data
            $sql2="INSERT INTO tbl_food SET
            title='$title',
            description ='$description',
            price=$price,
            image_name ='$image_name',
            category_id= $category ,
            featured='$featured',
            active='$active'";
            
            //4.executing the sql
            $res2=mysqli_query($conn,$sql2);
            if($res2==true){
                $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                header("location:".SITEURL."admin/manage-food.php");
            }else{
                $_SESSION['add']="<div class='failure'>Failed to Add Food</div>";
                header("location:".SITEURL."admin/manage-food.php");
            }
        }
    ?>
</div>
<?php include('partials/footer.php') ; ?>