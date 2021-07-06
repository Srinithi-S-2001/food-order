<?php include('partials/menu.php') ; ?>
<div class="main-content">
        <h3>UPDATE CATEGORY</h3>
        <?php 
        
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_category WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                 $row=mysqli_fetch_assoc($res);
                 $title=$row['title'];
                 $current_image=$row['image_name'];
                 $featured=$row['featured'];
                 $active=$row['active'];

            }else{
                $_SESSION['no-category-found']="<div class='failure'>Category Not Found</div>";
                header("location:".SITEURL."admin/manage-category.php");
            }
        
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="add-admin">

                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter the title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td><?php 
                        if($current_image!=""){
                        ?>
                        <img src="../images/category/<?php echo $current_image;?>"alt="" width=100px;></img>
                        <?php 
                        }else{
                            //display Image
                            echo "<div class='failure'>Image not Added</div>";
                        }
                    
                    ?></td>
                
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes   <!--vvvvvvimportant in order to display as checked firstgive php conditon for checked-->
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No

                    </td>
                
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes") echo "checked";?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No") echo "checked";?>  type="radio" name="active" value="No">No

                    </td>
               </tr>
                <tr>
                    <td colspan=2>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">      <!--we can get it from top also but a good programming practice is to pass id--> 
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">                    
                    </td>
                </tr>
            </table>
        </form>
        <?php 

            if(isset($_POST['submit'])){        //to check if user clicked submit
                $id=$_POST['id'];      
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];                                  //getting all the data NOTE: we can use $_POST and get data only from from with input tag and name paramater
                $active=$_POST['active'];
                
                if(isset($_FILES["image"]["name"]))
                {            //to check whether image is selected or not(here is we click the choose file button itself this if becomes true)
                    
                    $image_name=$_FILES["image"]["name"];       
                    
                    if($image_name != "")
                    {                        //we need to check becoz if we click cancel the image_name becomes empty
                        $ext=end(explode('.',$image_name));      //to find extension
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;   //creating a random name for uniformity
                        
                        $source_path = $_FILES["image"]["tmp_name"];               //getting it from Files becoz files is type of image
                        $destination_path = "../images/category/".$image_name;     //creating destination path
                        
                        $upload = move_uploaded_file($source_path,$destination_path);        //uploading the image
                        if($upload==false){
                            $_SESSION['upload']= "<div class='failure'>Failed To Update Image</div>";    //message
                            header("location:".SITEURL."admin/manage-category.php");        //redirect to manage-category page
                            die();                                                          //Stop the process
                        }
                        if($current_image!=""){
                                                                                        //removing the previous image
                            $path="../images/category/".$current_image;
                            $remove=unlink($path);
                            if($remove==false){
                                $_SESSION['upload']="<div class='failure'>Failed To Remove Image</div>";    //message
                                header("location:".SITEURL."admin/manage-category.php");
                                die();
                            }
                        }
                    }
                    else{
                        $image_name=$current_image;    
                    }

                }
                else{
                    $image_name=$current_image;
                }
                //updating the values 
                $sql2="UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active' WHERE id=$id";
                $res2=mysqli_query($conn,$sql2);
                if($res2==True){
                    $_SESSION['update']="<div class='success'>Category Updated Successfully</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }else{
                    $_SESSION['update']="<div class='failure'>Failed To Update Category</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
            }
        
        ?>
</div>
<?php include('partials/footer.php') ; ?>