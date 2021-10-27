<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>

<?php 
if(isset($_GET['complete'])){
    $dt = date('Y-m-d h:i:s'); 
    $id=uniqid();

    $cid = $_GET['c_id'];
    $bal = $_GET['balance'];
    $ccode = $_GET['ccode'];
    $msg = $bal ." ".$ccode ." "."has been successfully Transferred to your Bank Account";

    $sql1 = "insert into notification (id,customer_id,msg,state,created_at,updated_at)values('$id','$cid','$msg','UNREAD','$dt','$dt')";
    $result1 = $conn->query($sql1);

    $id = $_GET['complete'];
    $sql = "update withdraw_history set status = 1 where id = '$id'";
    $result = $conn->query($sql);
    if($result){
        $_SESSION['success'] = "Settlement marked as COMPLETED";
        header("location: settlement_requests.php");
        die();
    }
    else{
        $conn->error;
    }

}


?>

<?php 
if(isset($_GET['cancle'])){

    $id = $_GET['cancle'];
    $ssql = "select customer_id,currency_id,balance from withdraw_history where id = '$id'";
    $rresult = $conn->query($ssql);
    $roww=mysqli_fetch_assoc($rresult);
    $balance = $roww['balance'];
    $cus_id = $roww['customer_id'];
    $cur_id = $roww['currency_id'];

    $sql2 = "select balance from customer_wallet where customer_id = '$cus_id' and currency_id = '$cur_id'";
    $result2 = $conn->query($sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $existing_bal = $row2['balance'];

    $new_bal = $balance + $existing_bal;

    $sql3 = "update customer_wallet set balance = '$new_bal' where customer_id = '$cus_id' and currency_id = '$cur_id'";
    $result3 =$conn->query($sql3);
    if($result3){

        $dt6 = date('Y-m-d h:i:s'); 
    $uid6=uniqid("db");

    $cid6 = $_GET['cc_id'];
    $bal6 = $_GET['bbalance'];
    $ccode6 = $_GET['cccode'];
    $msg6 = $bal6 ." ".$ccode6 ." "."Can not been Transferred to your Bank Account due to technical issue." ." ".$bal6." ".$ccode6." "."is been deposited back to your Account.";
    $sql6 = "insert into notification (id,customer_id,msg,state,created_at,updated_at)values('$uid6','$cid6','$msg6','UNREAD','$dt6','$dt6')";
    $result6 = $conn->query($sql6);


        $sql = "update withdraw_history set status = 2 where id = '$id'";
        $result = $conn->query($sql);
        if($result){
            $_SESSION['success'] = "Settlement marked as CANCELLED";
            header("location: settlement_requests.php");
            die();
        }
        else{
            $conn->error;
        }
    }else{
        $conn->error;
        die();
    }

}
?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <div class="content">
        <div class="container-fluid">
        <?php if(isset($_SESSION['success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success'];?>
                </div>
            <?php }unset($_SESSION['success']);?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-handshake-o" style="font-size:24px;"></i>
                            </div>
                            <h4 class="card-title">Pending Requests</h4>
                        </div>
                        <!-- DataTales Example -->

                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table id="dataTable"
                                    class="table table-reflow table-striped table-bordered table-hover" cellspacing="0"
                                    width="100%" style="width:100%;white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Currency</th>
                                            <th>Bank Name</th>
                                            <th>Account Holder Name</th>
                                            <th>Iban Number</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Withdraw On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                      $i=1;
                      $sql1 = "select * from withdraw_history where status = 0";
                      $result1 = $conn->query($sql1);
                      while($row1=mysqli_fetch_assoc($result1)){
                          $w_id = $row1['id'];
                          $customer_id = $row1['customer_id'];
                          $currency_id = $row1['currency_id'];
                          $bank_id = $row1['bank_id'];
                          $account_holder_name = $row1['account_holder_name'];
                          $iban = $row1['iban'];
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
                                            <?php 
                            //for bank name;
                          $ssql="select name from banks where id='$bank_id'";
                          $resultt=$conn->query($ssql);
                          $row=mysqli_fetch_assoc($resultt);
                          $bank_name=$row['name'];
                            ?>
                                            <td><?php echo $bank_name;?></td>
                                            <td><?php echo $account_holder_name;?></td>
                                            <td><?php echo $iban;?></td>
                                            <td><?php echo $balance;?> <?php echo $c_code;?></td>
                                            <td><span class="badge badge-danger" style="font-size:14px;">Pending</span></td>
                                            <td><?php echo $deposit_date;?></td>
                                            <td class="td-actions">
                          <a href="settlement_requests.php?complete=<?php echo $w_id?>&&c_id=<?php echo $customer_id;?>&&balance=<?php echo $balance;?>&&ccode=<?php echo $c_code;?>" onclick="alert('Are You Sure?')">
                            <button type="button" data-toggle="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                              <i class="material-icons">done</i>
                            </button>
                              </a>
                            <a href="settlement_requests.php?cancle=<?php echo $w_id?>&&cc_id=<?php echo $customer_id;?>&&bbalance=<?php echo $balance;?>&&cccode=<?php echo $c_code;?>" onclick="alert('Are You Sure?')">
                            <button type="button" data-toggle="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                              <i class="material-icons">close</i>
                            </button>
                            </a>
                          </td>
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-handshake-o" style="font-size:24px;"></i>
                            </div>
                            <h4 class="card-title">Completed / Cancelled Requests</h4>
                        </div>
                        <!-- DataTales Example -->

                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table id="dataTable"
                                    class="table table-reflow table-striped table-bordered table-hover" cellspacing="0"
                                    width="100%" style="width:100%;white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Currency</th>
                                            <th>Bank Name</th>
                                            <th>Account Holder Name</th>
                                            <th>Iban Number</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Withdraw On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                      $i=1;
                      $sql1 = "select * from withdraw_history where status = 1 or status = 2";
                      $result1 = $conn->query($sql1);
                      while($row1=mysqli_fetch_assoc($result1)){
                          $w_id = $row1['id'];
                          $customer_id = $row1['customer_id'];
                          $currency_id = $row1['currency_id'];
                          $bank_id = $row1['bank_id'];
                          $account_holder_name = $row1['account_holder_name'];
                          $iban = $row1['iban'];
                          $status = $row1['status'];
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
                                            <?php 
                            //for bank name;
                          $ssql="select name from banks where id='$bank_id'";
                          $resultt=$conn->query($ssql);
                          $row=mysqli_fetch_assoc($resultt);
                          $bank_name=$row['name'];
                            ?>
                                            <td><?php echo $bank_name;?></td>
                                            <td><?php echo $account_holder_name;?></td>
                                            <td><?php echo $iban;?></td>
                                            <td><?php echo $balance;?> <?php echo $c_code;?></td>
                                            <td>
                                            <?php if($status == 1){?>    
                                            <span class="badge badge-success" style="font-size:14px;">Completed</span>
                                            <?php }else {?>
                                                <span class="badge badge-warning" style="font-size:14px;">Cancelled</span>
                                            <?php }?>
                                            </td>
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