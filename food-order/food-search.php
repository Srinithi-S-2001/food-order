<?php include('partials-front/menu.php'); ?>
<div id="foodsection">
        <?php  
         $search=$_POST['search'];
        ?>
        <h1 style="margin-left:auto;width:60%;">Foods on Your Search "<span style="color:red;"><?php echo $search; ?></span>"</h1>
</div>
 <!--menu card-->
 <div class="menu">
            <h1 style="text-align:Center;padding:5% 0 3% 0;margin-top:10%">Food Menu</h1>
            <div style="margin-left:10%;">
            <?php 
                //getting all the entered values from search of index.php
                $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0){
                        //food is there
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];
                            ?>
                            <div class="catalog">
                            <?php 
                            
                                if($image_name==""){
                                    echo "<img src='images/no-image.jpg' alt='no-image'></img>";
                                }else{
                                    ?>
                                    <img src="images/food/<?php echo $image_name; ?>"alt="<?php echo $title; ?>"></img>
                                    
                                    <?php
                                }
                            
                            
                            ?>
                                <ul>
                                <li><h5><?php echo $title; ?></h5></li>
                                <li><section><?php echo $price; ?></section></li>
                                <li><p><?php echo $description; ?></p></li>
                                <li><a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>"><button type="submit">Order Now!</button></a></li>
                                </ul>
                            </div>
                            <?php
                        }

                }else{
                    //food not available
                    echo "<div class='failure' style='font-family:monospace;font-size: large;font-weight: bold;text-align:center;padding-top:10px;margin-bottom:10%;padding-bottom:50px;'>Food Not Found</div>";
                }
            
            ?>                
</div>
</div>
        <!--menu card-->
<div style="float:none;clear:both;"></div>
<?php include('partials-front/footer.php') ; ?>