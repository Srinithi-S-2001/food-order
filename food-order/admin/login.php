<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page-Food Order-System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body style="background-image:url(../images/login-backdrop.jpg);background-size:cover;background-position:center;">
    <div class="login">
        <h1>LOGIN</h1>
        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <!--login form starts-->
        <br>
        <form action="" method="POST">
        User Name:
        <input type="text" name="username" placeholder="Enter the user name"><br><br>
        Password:
        <input type="password" name="password" placeholder="Enter the password"><br><br><br>
        <input type="submit" name="submit" value="Login" class="login-button">

        </form>
        <!--login form ends-->
        <p>Created By-<a href="https://github.com/Srinithi-S-2001" target="blank" >Srinithi.S</a></p>
    
    </div>
</body>
</html>
<?php 
    if(isset($_POST["submit"])) //if login is clicked
    {
        $username=$_POST["username"];               //1.getting data from form
        $password=md5($_POST["password"]);

        $sql="SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password'"; //2.sql query for checking

        $res=mysqli_query($conn,$sql);       //3.executing sql

        if($res==True){
            $count=mysqli_num_rows($res);
            if($count==1){
                    //success in login
                $_SESSION['login']="<div class='success'>Login Successful</div>";

                $_SESSION['user']=$username; //we are creating this to check the user remains logged in  to ender the various session
                header("location:".SITEURL."admin/");

            }else{
                //failure in login
                $_SESSION['login']="<div class='failure'>User Name or Password does not Match</div>";
                header("location:".SITEURL."admin/login.php");
            }

        }

    }

; ?>