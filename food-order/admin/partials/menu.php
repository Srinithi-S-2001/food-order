<?php 
    include('../config/constants.php');
    include('login-check.php'); 
?>
<!--top part of HTML code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Food Order Website</title>
</head>
<body>
    <!--menusection starts-->
    <div class="menu">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-category.php">Category</a></li>
        <li><a href="manage-food.php">Food</a></li>
        <li><a href="manage-order.php">Order</a></li>
        <li><a href="logout.php" style="float:right;margin-right:4%;background-color:#ff6b6b;border-radius:15px;padding:6px;color:black;">logout</a></li>
        </ul>
    </div>
    <!--menusection ends-->
 <div style="background-color:#dfe6e9;">