<?php include('partials-front/menu.php'); ?>
        <!--search bar-->
        <div id="foodsection">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search..." id="searchbox"></input>
                <button type="Submit" value="submit"name="submit" id="searchbutton"><i class="fa fa-search"></i></button> 
            </form>
        </div>
        <?php 
            if(isset($_SESSION['order'])){
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
        ?>
        <!--search bar-->
        <!--category-->
        <div id="category">
            <h2 style="text-align:Center;padding-top:10px;">Explore Foods</h2>
            <?php 
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";      //getting all data from backend category page
                $res=mysqli_query($conn,$sql);          //executing the sql
                $count=mysqli_num_rows($res);           //counting the rows
                if($count>0)
                {
                    //category present
                    while($row=mysqli_fetch_assoc($res)){
                        //getting id(for telling all the data in that specific id),title for the name and img_name for displaying image
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                        <div id="images">
                            <a href="<?php echo SITEURL;?>category-food.php?category_id=<?php echo $id;?>">
                                <?php 
                                    //checking if image name is ""
                                    if($image_name==""){
                                        echo "<img class='effect' src='images/no-image.jpg'></img><p id='imgcontent'>Image Not Available</p>";
                                    }else{
                                        ?>
                                            <img class="effect" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" >
                                            <p id="imgcontent"><?php echo $title; ?></p>
                                        <?php
                                    }
                                 ?>
                            </a>
                        </div>
                        
                        <?php

                    }
                }else{
                    //category not present
                    echo "<div class='failure' style='font-family:monospace;font-size: large;font-weight: bold;text-align:center;padding-top:30px;'>No Category Present</div>";
                }
            
            ?>
            
        </div>
        <div style="float:none;clear:both"></div>
        <!--category-->
        <!--menu card-->
        <div class="menu">
            <h1 style="text-align:Center;padding:5% 0 3% 0;margin-top:10%">Food Menu</h1>
            <div style="margin-left:8%">
            <?php 
             //sql to get data from tbl_food
             $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
             $res2=mysqli_query($conn,$sql2);
             $count2=mysqli_num_rows($res2);
             if($count2>0){
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $description=$row2['description'];
                        $price=$row2['price'];
                        $image_name=$row2['image_name'];
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
                                <li><a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>"><button type="submit" value="order">Order Now!</button></a></li>
                                </ul>
                        </div>
                        <?php 



                    }
                        
            }
             else{
                echo "<div class='failure' style='font-family:monospace;font-size: large;font-weight: bold;text-align:center;padding-top:10px;margin-bottom:10%;'>Food Not Available</div>";
            }
            ?>
        <div style="float:none;clear:both"></div> 
        </div>   
        <a href ="Food.php" class="menu">See All Foods >></a>
        </div>
        <!--menu card-->
<?php include('partials-front/footer.php') ; ?>