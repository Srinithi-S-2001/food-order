<?php include('partials/menu.php') ; ?>
<div class="main-content">
    <h3>Update Order</h3>
    <?php 
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql="SELECT * FROM tbl_order WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                $row=mysqli_fetch_assoc($res);
                $id=$row['id'];
                $food= $row['food'];
                $price=$row['price'];
                $qty= $row['qty'];
                $status=$row['status']; 
                $customer_name= $row['customer_name'];
                $customer_contact= $row['customer_contact'];
                $customer_email= $row['customer_email'];
                $customer_address= $row['customer_address'];
            }else{
                header("location:".SITEURL."admin/manage-order.php");
            }

        }else{
            header("location:".SITEURL."admin/manage-order.php");
        }
    ?>
    <form action="" method="post">
        <table class="add-admin">
            <tr>
                <td>Food Name:</td>     <!--we dont change food name here-->
                <td><b><i><?php echo $food; ?></i></b></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><b><i><?php echo $price; ?></i></b></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="status">
                    <option <?php if($status=="Ordered"){ echo "selected"; }?> value="Ordered">Ordered</option>
                    <option <?php if($status=="On Delivery"){ echo "selected"; }?> value="On Delivery">On Delivery</option>
                    <option <?php if($status=="Delivered"){ echo "selected"; }?> value="Delivered">Delivered</option>
                    <option <?php if($status=="Cancelled"){ echo "selected"; }?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Customer Name:</td>
                <td><input type="text" name="customer_name" value="<?php echo $customer_name ; ?>"></td>
            </tr>
            
            <tr>
                <td>Customer Contact:</td>
                <td><input type="text" name="customer_contact" value="<?php echo $customer_contact ; ?>"></td>
            </tr>
            
            <tr>
                <td>Customer Email:</td>
                <td><input type="text" name="customer_email" value="<?php echo $customer_email ; ?>"></td>
            </tr>
            
            <tr>
                <td>Customer Address:</td>
                <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea></td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                </td>

            </tr>
        </table>
    </form>
    <?php 
    
        if(isset($_POST['submit']))         //to check if submit is pressed
        {
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty= $_POST['qty'];
                $total=$price*$qty;
                $status=$_POST['status']; 
                $customer_name= $_POST['customer_name'];
                $customer_contact= $_POST['customer_contact'];
                $customer_email= $_POST['customer_email'];
                $customer_address= $_POST['customer_address'];

                //sql to update
                $sql2="UPDATE tbl_order SET
                    price=$price,
                    qty=$qty,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address' WHERE id=$id";

                //execute the sql
                $res2=mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
                    header("location:".SITEURL."admin/manage-order.php");
                }else{
                    
                    $_SESSION['update']="<div class='failure'>Failed To Update Order</div>";
                    header("location:".SITEURL."admin/manage-order.php");
                }
        }
    ?>
</div>
<?php include('partials/footer.php') ; ?>