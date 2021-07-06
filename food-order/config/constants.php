<?php 
//starting of session which appears as long browser is open
session_start();
//we are creating constants
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');
    define('SITEURL','http://localhost/food-order/');
//creating constants ends here and making connection starts below 
    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());//connecting to database 
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//select database 
 ?>