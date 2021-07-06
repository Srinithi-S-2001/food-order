<?php include('partials/menu.php') ; ?>
<div class="main-content">
        <h3>Change Password</h3>
        <?php 
            $id=$_GET['id'];

        ?>
        <form action="" method="POST">
            <table class="add-admin">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder='Enter the Current Password'></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="Enter the new Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan=2>
                        <input type="hidden" name='id' value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
</div>
<?php include('partials/footer.php') ; ?>
<?php 
            if(isset($_POST['submit'])){
                //getting data from form
                $id=$_POST['id'];
                $current_password=md5($_POST['current_password']);
                $new_password=md5($_POST['new_password']);
                $confirm_password=md5($_POST['confirm_password']);
                
                //checking if the entered value exist in table
                $sql="SELECT * FROM tbl_admin WHERE id=$id AND 
                password='$current_password'
                ";

                //executing query
                $res=mysqli_query($conn,$sql);

                //checking if query executed
                if($res==true){
                    $count=mysqli_num_rows($res);
                    if($count==1){
                        if($new_password==$confirm_password){
                            $sql2="UPDATE tbl_admin SET 
                            password='$new_password' WHERE id=$id";
                            $res2=mysqli_query($conn,$sql2);
                            if($res2==True){
                                $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully</div>";
                                header("location:".SITEURL."admin/manage-admin.php");
                            }else{
                                $_SESSION['change-pwd']="<div class='failure'>Failed To Change Password</div>";
                                header("location:".SITEURL."admin/manage-admin.php");
                            }

                        }else{
                            //redirect to manage admin with error
                            $_SESSION['not-match']="<div class='failure'>Password did not match</div>";
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                    }else{
                        $_SESSION['user-not-found']="<div class='failure'>User not Found</div>";
                        header("location:".SITEURL."admin/manage-admin.php");

                    }
                }

            }       
        ?>