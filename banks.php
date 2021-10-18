<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>

<?php 
if(isset($_POST['add_bank'])){
  $dt = date('Y-m-d h:i:s'); 
  $id=uniqid();
  $name=$_POST['name'];
  $city=$_POST['city'];
  $country=$_POST['country'];
  $sql="insert into banks(id,name,city,country,status,created_at,updated_at)values('$id','$name','$city','$country',1,'$dt','$dt')";
  $result=$conn->query($sql);
  if($result){
    $_SESSION['add_bank_success']="Bank Added Successfully";
    header("location:banks.php");
    die();
  }
  else{
    $conn->error;
  }
}

?>

<?php 
if(isset($_GET['remove_bank'])){
  $id=$_GET['remove_bank'];
  $sql="delete from banks where id='$id'";
  $result=$conn->query($sql);
  if($result){
    $_SESSION['remove_bank_success']="Bank Removed Successfully";
    header("location:banks.php");
    die();
  }
  else{
    $conn->error;
  }
}

?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <div class="content">
        <div class="container-fluid">
        <?php if(isset($_SESSION['add_bank_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['add_bank_success'];?>
                </div>
            <?php }unset($_SESSION['add_bank_success']);?>
            <?php if(isset($_SESSION['remove_bank_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['remove_bank_success'];?>
                </div>
            <?php }unset($_SESSION['remove_bank_success']);?>
            <?php if(isset($_SESSION['bank_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['bank_success'];?>
                </div>
            <?php }unset($_SESSION['bank_success']);?>
            <div class="row">
                <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Bank</h4>
                  <p class="card-category">Here You can Add New Bank</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="#">
                  <div class="row">
                      <div class="col-md-12 mt-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Bank Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" class="form-control" name="city" required>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" class="form-control" name="country" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_bank">Add Bank</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary card-header-icon" >
                      <div class="card-icon">
                        <i class="fa fa-university" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Banks</h4>
                    </div>
                        <!-- DataTales Example -->
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Bank Name</th>
                          <th>City</th>
                          <th>Country</th>
                          <th>Status</th>
                          <th>Created At</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $i=1;
                      $sql="select * from banks order by name";
                      $result=$conn->query($sql);
                      while($row=mysqli_fetch_assoc($result)){
                      $bankid=$row['id'];
                      $name=$row['name'];
                      $city=$row['city'];
                      $country=$row['country'];
                      $status=$row['status'];
                      $created_at=$row['created_at'];
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $city;?></td>
                          <td><?php echo $country;?></td>
                          <td><div class="togglebutton">
                                  <label>
                                      <input type="checkbox" name="bank_status" value="<?php echo $bankid;?>" <?php if($status == 1){echo 'checked=""';} ?> >
                                      <span class="toggle"></span>
                                  </label>
                              </div></td>
                            <td><?php echo $created_at;?></td>
                            <td class="td-actions">
                            <a href="?remove_bank=<?php echo $bankid;?>" onclick="alert('Are You Sure?')">
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
    <script>
      $(document).ready(function(){
      $('input[name=bank_status]').change(function(){
		    var id=$( this ).val();
        $.ajax({
          type:'POST',
          url:'enable_disable_bank.php',
          data:{id : id},
          success:function(data)
          {
            window.location.reload(true);
          }
        });
      });
    });
    
    </script>
</body>

</html>