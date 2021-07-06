<?php include("partials/menu.php"); ?>
    <!--main content starts-->
    <div class="main-content">
        <h3>Manage Order</h3>
        <br>
        <?php 
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
        ?>
        <br>
        <table class="manage-order">
            <tr>
                <th>SNO</th>
                <th>FOOD</th>
                <th>PRICE</th>
                <th>QTY</th>
                <th>TOTAL</th>
                <th>ORDER DATE</th>
                <th>STATUS</th>
                <th>CUSTOMER NAME</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>ADDRESS</th>
                <th>ACTIONS</th>
            </tr>
            <?php 
        
                //sql to get data from tbl_order
                $sql="SELECT * FROM tbl_order ORDER BY order_date";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                $i=1;
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $food= $row['food'];
                        $price= $row['price'];
                        $qty= $row['qty'];
                        $total= $row['total'];
                        $order_date=$row['order_date'];   //date year-month-date hour-minute-sec-am/pm
                        $status=$row['status']; 
                        $customer_name= $row['customer_name'];
                        $customer_contact= $row['customer_contact'];
                        $customer_email= $row['customer_email'];
                        $customer_address= $row['customer_address'];
                    ?>
                        <tr>
                            <td><?php echo $i++ ; ?></td>
                            <td><?php echo $food ; ?></td>
                            <td><?php echo $price ; ?></td>
                            <td><?php echo $qty ; ?></td>
                            <td><?php echo $total ; ?></td>
                            <td><?php echo $order_date ; ?></td>
                            <td>
                                <?php
                                    if($status=="Ordered"){
                                        echo "<div style='color:#130f40;'>Ordered</div>";
                                    }
                                    else if($status=="On Delivery"){
                                        echo "<div style='color:#f0932b;'>On Delivery</div>";
                                    }
                                    else if($status=="Delivered"){
                                        echo "<div style='color:#6ab04c;'>Delivered</div>";
                                    }
                                    else if($status=="Cancelled"){
                                        echo "<div style='color:#eb4d4b;'>Cancelled</div>";
                                    }
                                
                                ?>
                            </td>
                            <td><?php echo $customer_name ; ?></td>
                            <td><?php echo $customer_contact ; ?></td>
                            <td><?php echo $customer_email ; ?></td>
                            <td><?php echo $customer_address ; ?></td>
                            <td> <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">UpdateOrder</a>
                            </td>
                        </tr>
                    <?php
                    
                    }    
                
                }
                else{
                    
                }
            ?>
            
        </table>      
    </div>
    <!--main content ends-->
<?php include("partials/footer.php") ; ?>