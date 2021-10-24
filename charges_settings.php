<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>

<?php
if(isset($_POST['add_charges_settings'])){
  $sql1="select * from currency_charges";
  $result1=$conn->query($sql1);
  while($row1=mysqli_fetch_assoc($result1)){
    $ic=$row1['from_id'];
    $fc=$row1['to_id'];
  }
  $from=$_POST['i_currency'];
  $to=$_POST['f_currency'];
  if($ic == $from && $fc == $to){
    $_SESSION['charges_settings_error']="Settings Already existed";
  }
  else{
  $rate=$_POST['rate'];
  $dt = date('Y-m-d h:i:s'); 
  $id=uniqid();
  $sql="insert into currency_charges(id,from_id,to_id,rate,created_at,updated_at)values ('$id','$from','$to','$rate','$dt','$dt')";
  $result=$conn->query($sql);
  if($result){
    $_SESSION['charges_settings_success']="Settings Added Successfully";
    header("location:charges_settings.php");
    die();
  }
  else{
    $conn->error;
  }
}
}
?>

<?php
if(isset($_GET['remove_setting'])){
  $id=$_GET['remove_setting'];
  $sql="Delete from currency_charges where id='$id'";
  $delete=$conn->query($sql);
  if($delete)
    {
      $_SESSION['remove_setting_success']="Charges Setting Removed Successfully";
      header("location: charges_settings.php");
      die();
    }
    else{
        echo $conn->error;
    }
}
?>
<?php 
if(isset($_POST['add_d_fee'])){
    $fee= $_POST['d-fee'];
    $sql="update deposit_fee set deposit_fee = '$fee' where id = 'deposit-fee'";
    $result=$conn->query($sql);
    if($result){
      $_SESSION['remove_setting_success']="Deposit Fee Updated Successfully";
      header("location: charges_settings.php");
      die();
    }
    else{
      echo $conn->error;
    }
}

?>

<?php 
if(isset($_POST['add_p_fee'])){
    $fee= $_POST['p-fee'];
    $sql="update withdraw_fee set withdraw_fee = '$fee' where id = 'withdraw-fee'";
    $result=$conn->query($sql);
    if($result){
      $_SESSION['remove_setting_success']="Withdraw Fee Updated Successfully";
      header("location: charges_settings.php");
      die();
    }
    else{
      echo $conn->error;
    }
}

?>

<?php 
if(isset($_POST['add_s_fee'])){
    $fee= $_POST['s-fee'];
    $sql="update send_fee set send_fee = '$fee' where id = 'send-fee'";
    $result=$conn->query($sql);
    if($result){
      $_SESSION['remove_setting_success']="P2P Fee Updated Successfully";
      header("location: charges_settings.php");
      die();
    }
    else{
      echo $conn->error;
    }
}

?>

<?php 
if(isset($_POST['add_c_fee'])){
    $fee= $_POST['c-fee'];
    $sql="update currency_fee set currency_fee = '$fee' where id = 'currency-fee'";
    $result=$conn->query($sql);
    if($result){
      $_SESSION['remove_setting_success']="Currency Fee Updated Successfully";
      header("location: charges_settings.php");
      die();
    }
    else{
      echo $conn->error;
    }
}

?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <div class="content">
        <div class="container-fluid">
        <?php if(isset($_SESSION['charges_settings_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['charges_settings_success'];?>
                </div>
            <?php }unset($_SESSION['charges_settings_success']);?>
            <?php if(isset($_SESSION['charges_settings_error'])){?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['charges_settings_error'];?>
                </div>
            <?php }unset($_SESSION['charges_settings_error']);?>
            <?php if(isset($_SESSION['remove_setting_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['remove_setting_success'];?>
                </div>
            <?php }unset($_SESSION['remove_setting_success']);?>
            <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Deposit fee</h4>
                  <p class="card-category">Here You can Set Deposit Fee</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="#">
                  <div class="row">
                      <div class="col-md-6 mt-3">
                        <div class="form-group">
                          <?php 
                           $sql = "select deposit_fee from deposit_fee";
                           $result = $conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $dfee=$row['deposit_fee'];
                          ?>
                          <label class="bmd-label-floating">Deposit Fee (%)</label>
                          <input type="number" step="0.01" class="form-control" value="<?php echo $dfee;?>" name="d-fee" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_d_fee">Update Deposit Fee</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Person To Person fee</h4>
                  <p class="card-category">Here You can Set P2P Fee</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="#">
                  <div class="row">
                      <div class="col-md-6 mt-3">
                        <div class="form-group">
                          <?php 
                           $sql = "select send_fee from send_fee";
                           $result = $conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $pfee=$row['send_fee'];
                          ?>
                          <label class="bmd-label-floating">P2P Fee (%)</label>
                          <input type="number" step="0.01" class="form-control" value="<?php echo $pfee;?>" name="s-fee" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_s_fee">Update P2P Fee</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Payout Fee</h4>
                  <p class="card-category">Here You can Set Payout Fee</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="#">
                  <div class="row">
                      <div class="col-md-6 mt-3">
                        <div class="form-group">
                        <?php 
                           $sql = "select withdraw_fee from withdraw_fee";
                           $result = $conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $pfee=$row['withdraw_fee'];
                          ?>
                          <label class="bmd-label-floating">Payout Fee (%)</label>
                          <input type="number" step="0.01" class="form-control" value="<?php echo $pfee;?>" name="p-fee" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_p_fee">Update Payout Fee</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Currency Convert fee</h4>
                  <p class="card-category">Here You can Set Currency conversion Fee</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="#">
                  <div class="row">
                      <div class="col-md-6 mt-3">
                        <div class="form-group">
                          <?php 
                           $sql = "select currency_fee from currency_fee";
                           $result = $conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $cfee=$row['currency_fee'];
                          ?>
                          <label class="bmd-label-floating">Currency Fee (%)</label>
                          <input type="number" step="0.01" class="form-control" value="<?php echo $cfee;?>" name="c-fee" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_c_fee">Update P2P Fee</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Currency Rate And Fee</h4>
                  <p class="card-category">Here You can Add Currency and Currency Fee</p>
                </div>
                <div class="card-body">
                  <form action="#" method="POST">
                  <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">From</label>
                        <select class="form-control form-control-sm" title="Currency" name="i_currency" required>
                                      <option value="" selected disabled>Choose Currency</option>
                                      <?php
                                        $sql="select * from currency order by name";
                                        $result=$conn->query($sql);
                                        while($row=mysqli_fetch_assoc($result)){
                                            $id=$row['id'];
                                            $name=$row['name'];
                                      ?>
                                      <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                      <?php } ?>
                                  </select>
                        </div>
                      </div>
                      <div class="col-md-2 text-center">
                      <i class="fa fa-exchange mt-5" style="font-size:26px" aria-hidden="true"></i>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">To</label>
                        <select class="form-control form-control-sm" title="Currency" name="f_currency" required>
                                      <option value="" selected disabled>Choose Currency</option>
                                      <?php
                                        $sql="select * from currency order by name";
                                        $result=$conn->query($sql);
                                        while($row=mysqli_fetch_assoc($result)){
                                            $id=$row['id'];
                                            $name=$row['name'];
                                      ?>
                                      <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                      <?php } ?>
                                  </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Currency Rate</label>
                          <input type="number" class="form-control" step="0.00005" name="rate" required>
                        </div>
                      </div>
                    </div>
                    <p class="lead bg-warning d-block p-2 rounded text-center">e.g. 1 USD(from) = 172 PKR (To) , Currency Rate = 172</p>
                    <button type="submit" class="btn btn-primary pull-left" name="add_charges_settings">Add Settings</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary card-header-icon" >
                      <div class="card-icon">
                        <i class="fa fa-sliders" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Charges</h4>
                    </div>
                        <!-- DataTales Example -->
        <div class="card-body">
            <div class="table-responsive text-center">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Conversion Rate</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i=1;
                          $sql="select * from currency_charges";
                          $result=$conn->query($sql);
                          while($row=mysqli_fetch_assoc($result)){
                            $charges_id=$row['id'];
                            $from_id=$row['from_id'];
                            $sql1="select name from currency where id= '$from_id'";
                            $result1=$conn->query($sql1);
                            $row1=mysqli_fetch_assoc($result1);
                            $from=$row1['name'];
                            $to_id=$row['to_id'];
                            $sql2="select name from currency where id= '$to_id'";
                            $result2=$conn->query($sql2);
                            $row2=mysqli_fetch_assoc($result2);
                            $to=$row2['name'];
                            $rate=$row['rate'];
                            $created_at = $row['created_at'];
                            $updated_at = $row['updated_at'];
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $from;?></td>
                          <td><?php echo $to;?></td>
                          <td><?php echo $rate;?></td>
                          <td><?php echo $created_at;?></td>
                          <td><?php echo $updated_at;?></td>
                          <td class="td-actions">
                            <!-- <button type="button" data-toggle="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button> -->
                            <a href="?remove_setting=<?php echo $charges_id;?>">
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
            </div>
        </div>
    </div>


    <!--Content End-->
    <?php include "include/footer.php";?>

    <?php include "include/scripts.php";?>
</body>

</html>