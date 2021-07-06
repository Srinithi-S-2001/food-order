<?php include('partials-front/menu.php') ; ?>
        <!--category-->
        <div id="category">
            <h2 style="text-align:Center;padding-top:70px;">Explore Foods</h2>
        <?php 
        
            //sql to select when active is yes
            $sql="SELECT * FROM tbl_category WHERE active='Yes'";

            //to execute the sql
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <div id="images">
                    <a href="<?php echo SITEURL; ?>category-food.php?category_id=<?php echo $id; ?>">
                     <?php
                        if($image_name==""){
                            echo "<img class='effect' src='images/no-image.jpg'></img><p id='imgcontent'>Image Not Available</p>";
                        
                        }
                        else{
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
        }
        else{
          //category not present
          echo "<div class='failure' style='font-family:monospace;font-size: large;font-weight: bold;text-align:center;padding-top:30px;'>No Category Present</div>";
      }
  
  ?>
  
</div>
<div style="float:none;clear:both"></div>
        <!--category-->
<?php include('partials-front/footer.php'); ?>