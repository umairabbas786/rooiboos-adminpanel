<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>
<?php
//add staff
if(isset($_POST['add_staff'])){
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $pass=$_POST['pass'];
  $cnfrm_pass=$_POST['cnfrm_pass'];
  $role="staff";
  if($pass==$cnfrm_pass){
    $sql="insert into staffs(name,email,password,phone_number,role) values('$name','$email','$pass','$phone','$role')";
    $result=$conn->query($sql);
    if($result){
      $_SESSION['add_staff_success']="Staff member Added Successfully";
      header("location:allstaffs.php");
      die();
    }
    else{
      $conn->error;
    }
  }
  else{
    $_SESSION['add_staff_error']="Password and Confirm Password Must be Same";
    header("location:addstaff.php");
    die();
  }
}

?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
<div class="content">
        <div class="container-fluid">
        <?php if(isset($_SESSION['add_staff_error'])){?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['add_staff_error'];?>
                </div>
            <?php }unset($_SESSION['add_staff_error']);?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Staff</h4>
                  <p class="card-category">Here You can Add New Staff</p>
                </div>
                <div class="card-body">
                  <form action="#" method="POST">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Full Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="number" class="form-control" name="phone" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="email" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="pass" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="password" class="form-control" name="cnfrm_pass" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_staff">Add Staff</button>
                    <div class="clearfix"></div>
                  </form>
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