<?php 
        //Authentiction purpose creating this

        //ie.to make sure user visits this page after login only
        if(!isset($_SESSION['user'])){   //if not logged it
            $_SESSION['no-login-message']="<div class='failure'>Please Login To Access Admin Panel</div>";
            header("location:".SITEURL."admin/login.php");
        }



?>