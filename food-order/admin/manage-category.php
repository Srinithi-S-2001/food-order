<?php include("partials/menu.php"); ?>
<!--main content starts-->
    <div class="main-content">
        <h3>Manage Category</h3>
        <br>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <!--Ading categories here-->
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <table class="manage-admin">
            <tr>
                <th>S.NO</th>
                <th>TITLE</th>
                <th>IMAGE</th>
                <th>FEATURED</th>
                <th>ACTIVE</th>
                <th>ACTIONS</th>
            </tr>
            <?php 

                $sql="SELECT * FROM tbl_category"; //query to get rows
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                
                if($count>0){
                        //data is present
                        $i=0;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            $i++;
            ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $title; ?></td>
                        
                        <td>
                            <?php 
                                //if image print it else message
                                if($image_name!=""){
                                    //break and dispaly image
                                ?>
                                
                                    <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name?>" width="100px;">
                                <?php

                                }else{
                                    echo "<div class='failure'>Image not added</div>";
                                }

                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td> <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                        </tr>

                        <?php
                        }

                }else{
                    //no data
                        ?>

            <tr>
                <td colspan=6><div class="failure">No Category Added</div></td>
            </tr>


            <?php 
                }
            
            ?>
        </table>
        <!--category ends here-->
    </div>
<!--main content ends-->
<?php include("partials/footer.php"); ?>