<?php 
    include('../config/constants.php');
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name!=""){
        $path="../images/food/".$image_name;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['delete']="<div class='failure'>Failed to remove Food</div>"; 
            header("location:".SITEURL."admin/manage-food.php");
            die();
        }
    }
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['delete']="<div class='success'>Food deleted Successfully</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }else{
        $_SESSION['delete']="<div class='failure'>Failed to delete Food</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
?>