<?php include("partials/menu.php"); ?>
    <!--main content starts-->
    <div class="main-content">
        <h3>Manage Admin</h3>
        <br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session
                unset($_SESSION['add']);//removing message
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//displaying session
                unset($_SESSION['delete']);//removing message
            }  
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//displaying session
                unset($_SESSION['update']);//removing message
            }  
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];//displaying session
                unset($_SESSION['user-not-found']);//removing message
            }
            if(isset($_SESSION['not-match'])){
                echo $_SESSION['not-match'];//displaying session
                unset($_SESSION['not-match']);//removing message
            } 
            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];//displaying session
                unset($_SESSION['change-pwd']);//removing message
            }       
        ?>
        <br><br>
        <!--Ading admins here-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <table class="manage-admin">
            <tr>
                <th>S.NO</th>
                <th>FULL NAME</th>
                <th>USER NAME</th>
                <th>ACTIONS</th>
            </tr>
            <?php 
                $sql="SELECT * FROM tbl_admin"; //Displaying all admins
                $res=mysqli_query($conn,$sql) or die(mysqli_error());
                if($res==True)
                {
                        //counting no of rows in admin page
                    $count=mysqli_num_rows($res);//function to get the rows
                    if($count>0){
                            //having data in database
                        $sn=0;
                        while($rows=mysqli_fetch_assoc($res))//fetches all the rows in database and  saves in $rows and loops runs until there is no data
                        {
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $user_name=$rows['user_name'];
                            $sn++;
                            //to display the data we need html so we are breaking php here
            ?>

                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $user_name; ?></td>
                            <td><a href ="<?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change Password</a> 
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete Admin</a>
                        </td>
                        </tr>
            <?php  
                        }
                    }
                    else{
                                //not having data in database
                    }
                }
            ?>
        </table>
        <!--adding admins ends here-->
    </div>
    <!--main content ends-->
<?php include("partials/footer.php") ; ?>