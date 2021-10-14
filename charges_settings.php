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
  $sql1="select * from currency_setting";
  $result1=$conn->query($sql1);
  while($row1=mysqli_fetch_assoc($result1)){
    $ic=$row1['initial_currency'];
    $fc=$row1['final_currency'];
  }
  $from=$_POST['i_currency'];
  $to=$_POST['f_currency'];
  if($ic == $from && $fc == $to){
    $_SESSION['charges_settings_error']="Settings Already existed";
  }
  else{
  $rate=$_POST['rate'];
  $fee = $_POST['fee'];
  $dt = date('Y-m-d h:i:s'); 
  $id=uniqid();
  $sql="insert into currency_setting(id,initial_currency,final_currency,rate,fee,created_at,updated_at)values ('$id','$from','$to','$rate','$fee','$dt','$dt')";
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
  $sql="Delete from currency_setting where id='$id'";
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
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Currency Rate</label>
                          <input type="number" class="form-control" step="0.01" name="rate" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Conversion Fee (%)</label>
                          <input type="number" class="form-control" step="0.01" name="fee" required>
                        </div>
                      </div>
                    </div>
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
                        <i class="fa fa-money" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Currency</h4>
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
                          <th>Currency Rate</th>
                          <th>Conversion Fee</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i=1;
                          $sql="select * from currency_setting";
                          $result=$conn->query($sql);
                          while($row=mysqli_fetch_assoc($result)){
                            $charges_id=$row['id'];
                            $from_id=$row['initial_currency'];
                            $sql1="select name from currency where id= '$from_id'";
                            $result1=$conn->query($sql1);
                            $row1=mysqli_fetch_assoc($result1);
                            $from=$row1['name'];
                            $to_id=$row['final_currency'];
                            $sql2="select name from currency where id= '$to_id'";
                            $result2=$conn->query($sql2);
                            $row2=mysqli_fetch_assoc($result2);
                            $to=$row2['name'];
                            $rate=$row['rate'];
                            $fee=$row['fee'];
                            $created_at = $row['created_at'];
                            $updated_at = $row['updated_at'];
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $from;?></td>
                          <td><?php echo $to;?></td>
                          <td><?php echo $rate;?></td>
                          <td><?php echo $fee;?>%</td>
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