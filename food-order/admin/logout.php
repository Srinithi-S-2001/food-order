<?php 
    include("../config/constants.php");           //including this for SITEURL 
    session_destroy();                            //DESTROYING ALL SESSIONS CREATED
    header("location:".SITEURL."admin/login.php"); //REDIRECTING TO LOGIN PAGE

; ?>