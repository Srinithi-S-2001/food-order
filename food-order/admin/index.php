<?php  include("partials/menu.php"); ?>
<!--main content starts-->
    <div class="main-content">
        <h3>DASHBOARD</h3>
        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
      <div id="col">
          <h2><?php 
            $sql1="SELECT * from tbl_category";
            $res1=mysqli_query($conn,$sql1);
            $count1=mysqli_num_rows($res1);
            echo $count1; ?></h2>
          <p>Categories</p>
      </div>
      <div id="col">
          <h2><?php 
          $sql2="SELECT * FROM tbl_food";
          $res2=mysqli_query($conn,$sql2);
          $count2=mysqli_num_rows($res2);
          echo $count2;
          ?></h2>
          <p>Foods</p>
      </div>
      <div id="col">
          <h2><?php 
          $sql3="SELECT * FROM tbl_order";
          $res3=mysqli_query($conn,$sql3);
          $count3=mysqli_num_rows($res3);
          echo $count3;
          ?></h2>
          <p>Total Orders</p>
      </div>
      <div id="col">
          <h2><?php 
          $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
          $res4=mysqli_query($conn,$sql4);
          $row4=mysqli_fetch_assoc($res4);
          $total_revenue=$row4['Total'];
          echo $total_revenue;
          ?></h2>
          <p>Revenue Generated</p>
      </div>
      <div style="float:none;clear:both"></div>
    </div>
    <!--main content ends-->
<?php include("partials/footer.php"); ?>