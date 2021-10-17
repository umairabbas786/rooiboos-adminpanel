<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>

<?php
if(isset($_POST['add_currency'])){
  $name=$_POST['name'];
  $code=$_POST['code'];
  $dt = date('Y-m-d h:i:s'); 
  $id=uniqid();
  $sql="insert into currency(id,name,code,created_at,updated_at)values ('$id','$name','$code','$dt','$dt')";
  $result=$conn->query($sql);
  if($result){
    $_SESSION['add_currency_success']="Currency Added Successfully";
    header("location:currencies.php");
    die();
  }
  else{
    $conn->error;
  }
}
?>

<?php
if(isset($_GET['remove_currency'])){
  $id=$_GET['remove_currency'];
  $sql="Delete from currency where id='$id'";
  $delete=$conn->query($sql);
  if($delete)
    {
      $_SESSION['remove_currency_success']="Currency Removed Successfully";
      header("location: currencies.php");
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
        <?php if(isset($_SESSION['add_currency_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['add_currency_success'];?>
                </div>
            <?php }unset($_SESSION['add_currency_success']);?>
            <?php if(isset($_SESSION['remove_currency_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['remove_currency_success'];?>
                </div>
            <?php }unset($_SESSION['remove_currency_success']);?>
            <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Currency</h4>
                  <p class="card-category">Here You can Add Currency</p>
                </div>
                <div class="card-body">
                  <form action="#" method="POST">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Currency Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Currency Code</label>
                          <input type="text" class="form-control" maxlength="5" name="code" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_currency">Add Currency</button>
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
                          <th>Currency</th>
                          <th>Code</th>
                          <th>Created At</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i=1;
                          $sql="select * from currency";
                          $result=$conn->query($sql);
                          while($row=mysqli_fetch_assoc($result)){
                            $currency_id=$row['id'];
                            $name=$row['name'];
                            $code=$row['code'];
                            $created_at=$row['created_at'];
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $code;?></td>
                          <td><?php echo $created_at;?></td>
                          <td class="td-actions">
                            <!-- <button type="button" data-toggle="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button> -->
                            <a href="?remove_currency=<?php echo $currency_id;?>">
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