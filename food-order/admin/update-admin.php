<?php include('partials/menu.php') ; ?>
<div class="main-content">
    <h3>UPDATE ADMIN</h3>
    <?php 
        
        $id=$_GET['id'];                                            //1.getting id from the url
        $sql="SELECT * FROM tbl_admin WHERE id=$id";                //2.SQL query to get the info
        $res=mysqli_query($conn,$sql) or die(mysqli_error());       //3.executing the query
        if($res==TRUE){                                             //4.Checking if it is executed
                $count=mysqli_num_rows($res);                       //5.counting the no of rows in res
                if($count==1){                                      //6.the id is unique so count will be 1 so checking that
                    
                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username=$row['user_name'];

                }else{                                              
                    header("location:".SITEURL."admin/manage-admin.php"); //8.redirecting to mamage admin page if not available
                }
        } 
    
    ?>
    <form action="" method="POST">
        <table class="add-admin">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter your full name" value="<?php echo $full_name; ?>"></td>
            </tr>
            <tr>
                <td>User Name:</td>
                <td><input type="text" name="user_name" placeholder="Enter your User Name" value="<?php echo $username; ?>"></td>
            </tr>
            <tr >
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <td colspan=2><input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
            </tr>
        </table>   
    </form>
</div>
<?php 
    if(isset($_POST['submit'])){
        //echo "Update done";
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $user_name=$_POST['user_name'];
        
        //sql query
        $sql="UPDATE tbl_admin SET        
        full_name='$full_name',
        user_name='$user_name' 
        WHERE id='$id'
        ";

        //executing query
        $res=mysqli_query($conn,$sql) or die(mysqli_error());
        if($res==true){
            $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
        else{
            $_SESSION['update']="<div class='failure'>Failed to Update Admin</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
    }

?>
<?php include('partials/footer.php') ; ?>
