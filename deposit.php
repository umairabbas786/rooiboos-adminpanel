<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                      <div class="card-icon">
                        <i class="fa fa-plus" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Deposits</h4>
                    </div>
                        <!-- DataTales Example -->
    
        <div class="card-body">
            <div class="table-responsive text-center">
            <table id="dataTable" class="table table-reflow table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%;white-space: nowrap;">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Customer Name</th>
                          <th>Customer Email</th>
                          <th>Currency</th>
                        <th>Amount</th>
                        <th>Deposit On</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $i=1;
                      $sql1 = "select * from deposit_history";
                      $result1 = $conn->query($sql1);
                      while($row1=mysqli_fetch_assoc($result1)){
                          $customer_id = $row1['customer_id'];
                          $currency_id = $row1['currency_id'];
                          $balance = $row1['balance'];
                          $deposit_date = $row1['created_at'];
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <?php 
                          $sql="select * from customers where id = '$customer_id'";
                          $result=$conn->query($sql);
                          while($row=mysqli_fetch_assoc($result)){
                              $fname=$row['first_name'];
                              $lname=$row['last_name'];
                              $email=$row['email'];
                          }
                          
                          ?>
                            <td><?php echo $fname .' '.$lname;?></td>
                            <td><?php echo $email;?></td>
                           <?php 
                            //for country name;
                          $ssql="select name,code from currency where id='$currency_id'";
                          $resultt=$conn->query($ssql);
                          $row=mysqli_fetch_assoc($resultt);
                          $c_code=$row['code'];
                          $currency_name=$row['name'];
                            ?>
                            <td><?php echo $currency_name;?></td>
                            <td><?php echo $balance;?> <?php echo $c_code;?></td>
                            <td><?php echo $deposit_date;?></td>
                        </tr>
                      <?php $i++;}?>
                      </tbody>
                    </table>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Content End-->
    <?php include "include/footer.php";?>

    <?php include "include/scripts.php";?>
</body>

</html>