<?php include('partials/menu.php') ; ?>
    <div class="main-content">
        <h3>ADD ADMIN</h3>
        <?php 
            if(isset($_SESSION['add'])){//if not set this is executed
                echo $_SESSION['add'];//displaying if set
                unset($_SESSION['add']);//deleting message
            }
        ?>
        <form action="#" method="POST">
            <table class="add-admin">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="user_name" placeholder="Enter your User Name"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="**********"></td>
                </tr>
                <tr>
                    <td colspan=2>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php include('partials/footer.php') ; ?>

<?php 
    //form to the database operation done here
    if(isset($_POST['submit']))
    {
        //1.processing data if button is clicked 
        $full_name=$_POST["full_name"];
        $user_name=$_POST["user_name"];
        $password=md5($_POST["password"]);

        //2.SQL Query to save data into database
        $sql="INSERT INTO tbl_admin SET 
        full_name='$full_name',
        user_name='$user_name',
        password='$password'
         ";

        //3.executing and saving data in database
        $res=mysqli_query($conn,$sql) or die(mysqi_error());

        //4.checking if we have inserted the data
        if($res==True){
            //echo "Data Inserted";
            $_SESSION['add']="<div class='success'>Admin added successfully</div>";
            //redirecting page to manage admin
            header("location:".SITEURL."admin/manage-admin.php");
        }else{
            //echo "Error";
            $_SESSION['add']="<div class='failure'>Failed to ADD admin</div>";
            //redirecting page to add admin
            header("location:".SITEURL."admin/add-admin.php");

        }
    }
        
?>