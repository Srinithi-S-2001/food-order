<?php include("partials/menu.php"); ?>
    <!--main content starts-->
    <div class="main-content">
        <h3>Manage Food</h3>
        <br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
           
        
        ?>
        <br>
        <!--Ading admins here-->
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <table class="manage-admin">
            <tr>
                <th>SNO</th>
                <th>TITLE</th>
                <th>PRICE</th>
                <th>IMAGE </th>
                <th>FEATURED</th>
                <th>ACTIVE</th>
                <th>ACTIONS</th>
            </tr>
            <?php 
                $sql="SELECT * FROM tbl_food";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0){
                    $i=1;
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                         <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>                            
                            <td>
                                <?php
                                    if($image_name == ""){
                                        echo "<div class='failure'>Image Not Added</div>";  //image not there display this
                                    }else{
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="image added" width=80px>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td> <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan=7 class="failure">Food Not Added Yet</td>
                    </tr>
                    <?php
                }
            
            ?>
           
        </table>      
    </div>
    <!--main content ends-->
<?php include("partials/footer.php") ; ?>