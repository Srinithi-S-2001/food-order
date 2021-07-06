<?php include('partials-front/menu.php'); ?>
<?php 
    if(isset($_GET['category_id'])){
        $category_id=$_GET['category_id'];
        $sql="SELECT title from tbl_category WHERE id=$category_id";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        $category_title=$row['title'];

    }else{
        header("location:".SITEURL);
    }
?>
<div id="foodsection">
        <h1 style="margin-left:auto;width:60%;">Foods on "<span style="color:red;"><?php echo $category_title; ?></span>"</h1>
</div>
 <!--menu card-->
 <div class="menu">
            <h1 style="text-align:Center;padding:5% 0 3% 0;margin-top:10%">Food Menu</h1>
            <?php 
                //sql to get food based on category
                $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";
                //executing sql
                $res2=mysqli_query($conn,$sql2);
                //counting the outputs
                $count2=mysqli_num_rows($res2);
                if($count2>0){
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id=$row2['id'];
                        $title2=$row2['title'];
                        $price2=$row2['price'];
                        $description2=$row2['description'];
                        $image_name=$row2['image_name'];
                        ?>
                        <div class="catalog">
                            <?php 
                                if($image_name==""){
                                    echo "<img src='images/no-image.jpg' alt='no-image'></img>";
                                }else{
                                    ?>
                                    <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"></img>
                                    <?php
                                }
                            
                            
                            ?>
                                <ul>
                                <li><h5><?php echo $title2; ?></h5></li>
                                <li><section><?php echo  $price2; ?></section></li>
                                <li><p><?php echo $description2; ?></p></li>
                                <li><a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>"><button type="submit">Order Now!</button></a></li>
                                </ul>
                        </div>
                

                        <?php 

                    }
                
                
                
                }
                else{
                    echo "<div class='failure' style='font-family:monospace;font-size: large;font-weight: bold;text-align:center;padding-top:30px;padding-bottom:30px;'>No Food found based on this Category </div>";
                }
               ?>
</div>
<!--menu card-->
<div style="float:none;clear:both;"></div>
<?php include('partials-front/footer.php') ; ?>