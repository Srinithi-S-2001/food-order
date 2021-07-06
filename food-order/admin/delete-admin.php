<?php 

    include('../config/constants.php');
    $id=$_GET['id'];
    $mysql= "DELETE FROM tbl_admin WHERE id=$id";
    $res=mysqli_query($conn,$mysql) or die(mysqli_error());
    if($res==True){
            $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
            header("location:".SITEURL."admin/manage-admin.php");
    }
    else{
            $_SESSION['delete']="<div class='failure'>Failed to delete Admin.Try Again Later</div>";
            header("location:".SITEURL."admin/manage-admin.php");
    }

; ?>