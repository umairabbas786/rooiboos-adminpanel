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
if(isset($_POST['add_customer'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cemail = $_POST['email'];
    $phone = $_POST['phone_number'];
    $pass=$_POST['pass'];
    $c_pass=$_POST['confirm_pass'];

//for image upload
    $filename = $_FILES["cnicfront"]["name"];
    $tempname = $_FILES["cnicfront"]["tmp_name"];
    $folder = "assets/img/users/" . $filename;
    move_uploaded_file($tempname, $folder);

//for image upload
    $filenamee = $_FILES["cnicback"]["name"];
    $tempnamee = $_FILES["cnicback"]["tmp_name"];
    $folder = "assets/img/users/" . $filenamee;
    move_uploaded_file($tempnamee, $folder);

    $account_holder_name = $_POST['account_holder_name'];
    $account_number = $_POST['account_number'];
    $iban_account_number = $_POST['iban_account_number'];
    $account_type = $_POST['account_type'];
    $country = $_POST['country'];

    $dt = date('Y-m-d h:i:s'); 
    $id=uniqid();
    if($pass == $c_pass){
    $sql = "insert into customers(id,first_name,last_name,email,phone_number,phone_verification,password,cnic_front,cnic_back,country,account_holder_name,account_number,iban_account_number,account_type,status,created_at,updated_at) values('$id','$fname','$lname','$cemail','$phone',0,'$pass','$filename','$filenamee','$country','$account_holder_name','$account_number','$iban_account_number','$account_type',0,'$dt','$dt')";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['add_customer_success'] = "Customer Added Successfully";
        header("location:allcustomers.php");
        die();
    } else {
        $conn->error;
    }
  }
  else{
    $_SESSION['add_customer_error'] = "Password and Confirm Password Must be Same";
        header("location:addcustomer.php");
        die();
  }
}
?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
<div class="content">
        <div class="container-fluid">
        <?php if(isset($_SESSION['add_customer_error'])){?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['add_customer_error'];?>
                </div>
            <?php }unset($_SESSION['add_customer_error']);?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Customer</h4>
                  <p class="card-category">Here You can Add New Customer</p>
                </div>
                <div class="card-body">
                  <form action="#" method="POST" enctype="multipart/form-data">
                  <div class="row mt-2 mb-2" >
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" class="form-control" name="fname" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" class="form-control" name="lname" required>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 mb-2">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" name="email" required>
                        </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone Number</label>
                                <input type="number" class="form-control" name="phone_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="pass" required>
                        </div>
                      </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_pass" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                      <div class="col-md-6">
                          <div class="picture-container">
                              <div class="picture">
                                  <label class="bmd-label-floating">Cnic Front</label>
                                  <input type="file" id="wizard-picture" class="form-control" name="cnicfront" required>
                              </div>
                          </div>
                      </div>
                        <div class="col-md-6">
                            <div class="picture-container">
                                <div class="picture">
                                    <label class="bmd-label-floating">Cnic Back</label>
                                    <input type="file" id="wizard-picture" class="form-control" name="cnicback" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Holder Name</label>
                          <input type="text" class="form-control" name="account_holder_name" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Number</label>
                          <input type="number" class="form-control" name="account_number" maxlength="14" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Account Number with IBAN</label>
                          <input type="text" class="form-control" name="iban_account_number" maxlength="14" required>
                        </div>
                      </div>
                    </div>
                      <div class="row mt-2 mb-2">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="bmd-label-floating">Account Type</label>
                                  <input type="text" value="Personal" class="form-control" name="account_type" required readonly>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <select class="form-control form-control-sm" title="Country" name="country" required>
                                      <option value="" selected disabled>Choose Country</option>
                                      <?php
                                        $sql="select * from countries where status = 1 order by name";
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
                      </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_customer">Add Customer</button>
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