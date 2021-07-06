<?php include('partials-front/menu.php') ; ?>
        <!--search bar-->
        <div id="foodsection">
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">    
                <input type="search" name="search" placeholder="Search..." id="searchbox"></input>
                <button type="Submit" value="search" id="searchbutton"><i class="fa fa-search"></i></button> 
            </form>
        </div>
        <!--search bar-->
        <!--menu card-->
        <div class="menu">
            <h1 style="text-align:Center;padding:5% 0 3% 0;margin-top:10%">Food Menu</h1>
            <div style="margin-left:10%;">
            <?php 
                //sql to display food that are active
                $sql="SELECT * FROM tbl_food WHERE active='Yes'";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        ?>
                        <div class="catalog">
                            <?php
                                 //checking if image name is not ""
                                 if($image_name==""){
                                    echo "<img src='images/no-image.jpg' alt='no-image'></img>";
                                }else{
                                    ?>
                                    <img src='images/food/<?php echo $image_name; ?>'></img>
                                    <?php 
                                }
                            ?>
                            <ul>
                            <li><h5><?php echo $title; ?></h5></li>
                            <li><section><?php echo $price; ?></section></li>
                            <li><p><?php echo $description; ?></p></li>
                            <li><a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>"><button type="submit" id='1'>Order Now!</button></a></li>
                            </ul>
                        </div>
                        <?php
                    }

                }
                else
                {
                    echo "<div class='failure' style='font-family:monospace;font-size: large;font-weight: bold;padding:10px;margin-left:30%;text-align:left;'>Food Not Available</div>";
                }
            ?>
             
        </div>  

        </div>
        <!--menu card-->
        <div style="float:none;clear:both"></div> 
<?php include('partials-front/footer.php') ; ?>