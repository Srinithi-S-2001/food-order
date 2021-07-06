<?php include('partials/menu.php') ; ?>
<div class="main-content">
        <h3>ADD CATEGORY</h3>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <!--Add Category Form starts-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="add-admin">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title" required></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>            
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No" required>No
                    </td>
                
                </tr>  
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" required>Yes <!--NOTE::: the text inside value is stored in our database anf ouside written yes is shown to us-->
                        <input type="radio" name="active" value="No" required>No
                    </td>
                
                </tr>      
                <tr>
                    <td colspan=2>
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">              
                    </td>
                </tr>
            </table>
        </form>
        <!--Add Category Form ends-->
        <?php 

            //1.Getting Data
            if(isset($_POST['submit']))
            {                                       //if submit clicked then save data in database
                $title=$_POST['title'];             //here only one value so directly we can save 
                
                                                    //but for radio buttons we need to check if that button is clicked or not
                if(isset($_POST['featured'])){
                    $featured=$_POST['featured'];  //if clicked get the value
                }else{
                    $featured="NO";
                }
                if(isset($_POST['active'])){
                    $active=$_POST['active'];
                }else{
                    $active="No";
                }
                //print_r($_FILES['image']);            //echo cant display array and files is array so used print_r
                //die();                                //similar to break statement
                if(isset($_FILES["image"]["name"]))
                {                                         //to check if file has a name
                    $image_name=$_FILES["image"]["name"];           //for uploading a file we need file name,source path and destination path
                    
                    if($image_name != '')
                    {                                                //auto renaming image becoz if we upload same image the previous is replaced
                        $ext=end(explode('.',$image_name));                   //similar to split to get the extension like jpg,jpeg etc Eg:foo1.jpg and end function gets last value                                               
                        
                        $image_name="Food_Category_".rand(000,999).'.'.$ext;    //a random no is generated using rand(min value,max value) and this is the final image name
                        
                        
                        $source_path=$_FILES["image"]["tmp_name"];      //sourse path we found using print_r and die statement 
                        $destination_path="../images/category/".$image_name;

                        //now we upload using move_uploaded_file(source,destination)
                        $upload=move_uploaded_file($source_path,$destination_path);
                        
                        //checking upload happened or not if not we are redirecting to add-category page
                        
                        if($upload==FALSE){
                            $_SESSION['upload']="<div class='failure'>Failed To Upload Image</div>";
                            header("location:".SITEURL."admin/add-category.php");
                            die();  //to stop the process
                        }
                    }
                }
                else
                {
                        $image_name="";
                }
                //2.creating sql query to insert data
                $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'";

                //3.execute the query
                $res=mysqli_query($conn,$sql);

                //4.check if res is executed
                if($res==True){
                    $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }else{
                    
                    $_SESSION['add']="<div class='error'>Failed To Add Category</div>";
                    header("location:".SITEURL."admin/add-category.php");
                }
            }
        ?>
</div>
<?php include('partials/footer.php') ; ?>