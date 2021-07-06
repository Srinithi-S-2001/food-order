<?php 
    include('../config/constants.php');
    $id=$_GET['id'];                    //getting id from url
    $image_name=$_GET['image_name'];    //getting image name from url
    if($image_name != ""){                //if image is not empty it must be first removed from  image/category then from database
        $path = "../images/category/".$image_name;

        $remove=unlink($path);          //unlink =>built in function to remove from folder

        if($remove==false)              //if failed to unlink
        {
            $_SESSION['delete']="<div class='failure'>Failed to remove Category</div>"; 
            header("location:".SITEURL."admin/manage-category.php");
            die(); //stop immediately
        }

    }
    $sql="DELETE from tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==TRUE){
        $_SESSION['delete']="<div class='success'>Category deleted Successfully</div>";
        header("location:".SITEURL."admin/manage-category.php");
    }else{
        $_SESSION['delete']="<div class='failure'>Failed to delete Category</div>";
        header("location:".SITEURL."admin/manage-category.php");
    }
?>