<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>
<?php
//add customer
if(isset($_POST['edit_customer'])) {
    $cid=$_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cemail = $_POST['email'];
    $phone = $_POST['phone_number'];
    $account_holder_name = $_POST['account_holder_name'];
    $account_number = $_POST['account_number'];
    $iban_account_number = $_POST['iban_account_number'];
    $account_type = $_POST['account_type'];
    $country = $_POST['country'];
    $dt = date('Y-m-d h:i:s'); 

    $sql = "update customers set first_name='$fname',last_name='$lname',email='$cemail',phone_number='$phone',country='$country',account_holder_name='$account_holder_name',account_number='$account_number',iban_account_number='$iban_account_number',account_type='$account_type',updated_at='$dt' where id='$cid'";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['edit_customer_success'] = "Customer Edited Successfully";
        header("location:allcustomers.php");
        die();
    } else {
        $conn->error;
    }
}
?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <?php
    //get customer details
        if(isset($_GET['edit_customer_id'])){
            $id=$_GET['edit_customer_id'];
                      $sql="select * from customers where id='$id' ";
                      $result=$conn->query($sql);
                      while($row=mysqli_fetch_assoc($result)){
                          $fname=$row['first_name'];
                          $lname=$row['last_name'];
                          $cemail=$row['email'];
                          $phone=$row['phone_number'];
                          $country=$row['country'];
                          $account_holder_name=$row['account_holder_name'];
                          $account_number=$row['account_number'];
                          $iban=$row['iban_account_number'];
                          $account_type=$row['account_type'];
                      }
                    }
                      ?>
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Customer</h4>
                  <p class="card-category">Here You can Edit Your Selected Customer</p>
                </div>
                <div class="card-body">
                  <form action="#" method="POST" enctype="multipart/form-data">
                  <input type="hidden" value="<?php echo $id;?>" name='id'>
                  <div class="row mt-2 mb-2" >
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" class="form-control" name="lname" value="<?php echo $lname;?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 mb-2">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $cemail;?>" required>
                        </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone Number</label>
                                <input type="number" class="form-control" name="phone_number" value="<?php echo $phone;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Holder Name</label>
                          <input type="text" class="form-control" name="account_holder_name" value="<?php echo $account_holder_name;?>" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Number</label>
                          <input type="number" class="form-control" name="account_number" maxlength="14" value="<?php echo $account_number;?>" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Number with IBAN</label>
                          <input type="text" class="form-control" name="iban_account_number" maxlength="14" value="<?php echo $iban;?>" required>
                        </div>
                      </div>
                    </div>
                      <div class="row mt-2 mb-2">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="bmd-label-floating">Account Type</label>
                                  <input type="text" value="Personal" class="form-control" value="<?php echo $account_type;?>" name="account_type" required readonly>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <select class="form-control form-control-sm" title="Country" name="country" value="<?php echo $country;?>" required>
                                      <option value="<?php echo $country;?>" selected><?php echo $country;?></option>
                                      <?php
                                        $sql="select * from countries where status = 1 and name != '$country'";
                                        $result=$conn->query($sql);
                                        while($row=mysqli_fetch_assoc($result)){
                                            $name=$row['name'];
                                      ?>
                                      <option value="<?php echo $name;?>"><?php echo $name;?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                    <button type="submit" class="btn btn-primary pull-left" name="edit_customer">Edit Customer</button>
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