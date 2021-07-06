<?php include('partials/menu.php') ; ?>
<?php 
    $id=$_GET['id'];
    $sql1="SELECT * FROM tbl_food WHERE id=$id";
    $res1=mysqli_query($conn,$sql1);
    $count1=mysqli_num_rows($res1);
    if($count1==1){
        $row1=mysqli_fetch_assoc($res1);
        $title=$row1['title'];
        $description=$row1['description'];
        $price=$row1['price'];
        $current_image=$row1['image_name'];
        $current_category=$row1['category_id'];
        $featured=$row1['featured'];
        $active=$row1['active'];
    }
?>
<div class="main-content">
    <h3>Update Food</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="add-admin">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>" placeholder="Enter the Food name"></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description"  cols="30" rows="5" placeholder="Enter about Food.."><?php echo $description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="price" value="<?php echo $price;?>"></td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php 
                        if($current_image==""){
                            echo "<div class='failure'>Image not Available.</div>";
                        }else{
                            ?>
                                <img src="../images/food/<?php echo $current_image; ?>"  width=100px>
                            <?php

                        }
                    
                    ?>
                
                </td>
            </tr>
            <tr>
                <td>Select New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                <select name="category">
                <?php 
                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                                $category_id=$row['id'];
                                $category_title=$row['title'];
                            ?>
                                <option <?php if($current_category == $category_id){ echo "selected"; }?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                        }
                    }else{
                        echo "<option value='0'>No Category Available.</option>";
                    }
                
                ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No                
                </td>
            </tr> 
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        </table>    
    </form>
    <?php 
        if(isset($_POST['submit']))                     //if submit is clicked proceed
        {
            //getting all data except the new image
            $id=$_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            //getting new image name
            if(isset($_FILES['image']['name'])){
                $image_name=$_FILES['image']['name'];
                if($image_name!=""){
                    $ext=end(explode('.',$image_name));
                    $image_name="Food_Name_".rand(0000,9999).'.'.$ext;
                    $source=$_FILES['image']['tmp_name'];
                    $destination_path="../images/food/".$image_name;
                    $upload=move_uploaded_file($source,$destination_path);
                    if($upload==false){
                        $_SESSION['upload']="<div class='error'>Failed to Update Image</div>";
                        header("location:".SITEURL."admin/manage-food.php");
                        die();
                    }
                    //remove current image if !="" and new image is inserted
                    if($current_image!=""){
                        $path="../images/food/".$current_image;
                        $remove=unlink($path);
                        if($remove==false){
                            $_SESSION['upload']="<div class='error'>Failed to remove Image</div>";
                            header("location:".SITEURL."admin/manage-food.php");
                            die();
                        }
                    }
                }else{
                    $image_name=$current_image;
                }

            }else{

                $image_name=$current_image;

            }

            
            $sql3 = "UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active' WHERE id=$id";

            $res3= mysqli_query($conn,$sql3);
            
            if($res3==true){
                $_SESSION['update']="<div class='success'>Food Updated Successfully</div>";
                header("location:".SITEURL."admin/manage-food.php");
            }else{
                $_SESSION['update']="<div class='error'>Failed to Update Food</div>";
                header("location:".SITEURL."admin/manage-food.php");
                
            }
        }

    ?>
</div>
<?php include('partials/footer.php') ; ?>