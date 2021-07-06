<?php include('partials-front/menu.php') ; ?>
        <!--ordering page --> 
        <?php 
            if(isset($_GET['food_id'])){
                $food_id=$_GET['food_id'];       //getting id
            
                //sql to get the data required
                $sql="SELECT * FROM tbl_food WHERE id=$food_id";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count==1){

                    //continue the process
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];

                }
                else{

                    header("location:".SITEURL);

                }
            
            }
            else{
                header("location:".SITEURL);        //taking to home page
            }
       ?>
        <div id="order">
            <h1 style="color:white;">Fill this form to confirm the Order!!</h1>
        <form action="" method="POST">
            <fieldset>
                <legend >Selected Food</legend>
                <?php 
                    if($image_name==""){
                        echo "<img src='images/no-image.jpg' alt='no-image' style='width:100px;height:auto;float:left;border-radius:15px;'></img>";
                    }else{
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" style="width:100px;height:auto;float:left;border-radius:15px;">
                    <?php
                    }
                
                ?>
                    <div style="float:none;"></div>
                        <table style="padding-left:10%;">
                            <tr >
                                <td><?php echo $title; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $price; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Quantity<input type="number" name="qty" value='1' required>
                                </td>
                            </tr>
                        </table>
            </fieldset>
            <fieldset style="margin-top:5%;">
                <legend >Delivery Details</legend>
                    <div style="padding-left:10%;">
                            <div class="forms">
                                <p>Full Name:</p>
                                <input type="text" name="name" placeholder="Eg:Srinithi" required>
                            </div>
                            <div class="forms">
                                <p>Phone number:</p>
                                <input type="tel" name="number" placeholder="9841*****" required>
                            </div>
                            <div class="forms">
                                <p>Email:</p>
                                <input type="email" name="email" placeholder="Eg:abc@gmail.com" required>
                            </div>
                            <div class="forms">
                                <p>Address:</p>
                                <textarea name="address"  cols="30" rows="5" style="margin-left:10%;" placeholder="Eg:123,abc st,area,city"></textarea>
                            </div>
                            <input type="hidden" name="title" value="<?php echo $title; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" name="submit" value="Confirm Order!!" class="button"></input>    
        </form>
                        </div>
            </fieldset>
        <?php 
            if(isset($_POST['submit'])){
                $food= $_POST['title'];
                $price= $_POST['price'];
                $qty= $_POST['qty'];
                $total= $price * $qty;
                $order_date= date("Y-m-d h:i:sa");   //date year-maonth-date hour-minute-sec-am/pm
                $status="Ordered"; 
                $customer_name= $_POST['name'];
                $customer_contact= $_POST['number'];
                $customer_email= $_POST['email'];
                $customer_address= $_POST['address'];

                //sql to save the data
                $sql2="INSERT INTO tbl_order SET 
                food= '$food',
                price= $price,
                qty= $qty,
                total= $total,
                order_date= '$order_date',
                status= '$status',
                customer_name= '$customer_name',
                customer_contact= '$customer_contact',
                customer_email= '$customer_email',
                customer_address= '$customer_address'
                ";
                //executing the sql2
                $res2=mysqli_query($conn,$sql2);
                if($res2==true){
                        $_SESSION['order']="<div class='success' style='text-align:center;font-size:20px;padding-top:2%;'>Order Placed Successfully</div>";
                        header("location:".SITEURL);
                }else{
                        
                    $_SESSION['order']="<div class='failure' style='text-align:center;font-size:20px;padding-top:2%;'>Failed To Place Order..Try Again Later</div>";
                    header("location:".SITEURL);
                }
                
            }
        
        
        
        ?>
    <fieldset style="margin-top:5%;">
        <?php include('partials-front/footer.php') ; ?>    
    </fieldset>    
</div>
