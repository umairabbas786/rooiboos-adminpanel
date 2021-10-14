<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>
<?php
if(isset($_GET['remove_customer'])){
  $id=$_GET['remove_customer'];
  $query = "SELECT * FROM customers WHERE id='$id'";
        $result = $conn->query($query);

        while ($roww = mysqli_fetch_assoc($result)) {
            $image = $roww['cnic_front'];
            $file= "assets/img/users/".$image;
            unlink($file);
            $imagee = $roww['cnic_back'];
            $filee= "assets/img/users/".$imagee;
            unlink($filee);
        }
        $sql="Delete from customers where id='$id'";
        $delete=$conn->query($sql);
        if($delete)
        {
            $_SESSION['remove_customer_success']="Customer Removed Successfully";
            header("location: allcustomers.php");
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
        <?php if(isset($_SESSION['edit_customer_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['edit_customer_success'];?>
                </div>
            <?php }unset($_SESSION['edit_customer_success']);?>
            <?php if(isset($_SESSION['add_customer_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['add_customer_success'];?>
                </div>
            <?php }unset($_SESSION['add_customer_success']);?>
            <?php if(isset($_SESSION['block_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['block_success'];?>
                </div>
            <?php }unset($_SESSION['block_success']);?>
            <?php if(isset($_SESSION['remove_customer_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['remove_customer_success'];?>
                </div>
            <?php }unset($_SESSION['remove_customer_success']);?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                      <div class="card-icon">
                        <i class="fa fa-id-badge" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Customers</h4>
                    </div>
                        <!-- DataTales Example -->
    
        <div class="card-body">
            <div class="table-responsive text-center">
            <table id="dataTable" class="table table-reflow table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%;white-space: nowrap;">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                        <th>Phone Verification</th>
                        <th>Cnic Front</th>
                        <th>Cnic Back</th>
                        <th>Country</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Iban Number</th>
                            <th>Account Type</th>
                            <th>Block / Unblock</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $i=1;
                      $sql="select * from customers order by first_name";
                      $result=$conn->query($sql);
                      while($row=mysqli_fetch_assoc($result)){
                            $customer_id=$row['id'];
                          $fname=$row['first_name'];
                          $lname=$row['last_name'];
                          $cemail=$row['email'];
                          $phone=$row['phone_number'];
                          $phone_verify=$row['phone_verification'];
                          $pass=$row['password'];
                          $cnic_front=$row['cnic_front'];
                          $cnic_back=$row['cnic_back'];
                          $country=$row['country'];
                          $account_holder_name=$row['account_holder_name'];
                          $account_number=$row['account_number'];
                          $iban=$row['iban_account_number'];
                          $account_type=$row['account_type'];
                          $status=$row['status'];
                          $created_at=$row['created_at'];
                          $updated_at=$row['updated_at'];
                      ?>
                        <tr>
                          <td><?php echo $i;?></td>
                            <td><?php echo $fname .' '.$lname;?></td>
                            <td><?php echo $cemail;?></td>
                            <td><?php echo $phone;?></td>
                            <?php
                                if($phone_verify == 0){
                                    $verify="Not Verified";
                                }
                                else{
                                    $verify="Verified";
                                }
                            ?>
                            <td><?php echo $verify;?></td>
                            <td><?php echo "<a href='assets/img/users/".$cnic_front."' data-lightbox='$cnic_front'><div style='position: relative;text-align: center;color: white;'><img src='assets/img/users/".$cnic_front."' height='100' width='100' ><div style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'> <b>Click To View</b> <br> <i class='fa fa-eye'></i></div></div></a>"?></td>
                            <td><?php echo "<a href='assets/img/users/".$cnic_back."' data-lightbox='$cnic_back'><div style='position: relative;text-align: center;color: white;'><img src='assets/img/users/".$cnic_back."' height='100' width='100' ><div style='position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'><b>Click To View</b> <br> <i class='fa fa-eye'></i></div></div></a>"?></td>
                            <?php 
                            //for country name;
                          $ssql="select name from countries where id='$country'";
                          $resultt=$conn->query($ssql);
                          $row=mysqli_fetch_assoc($resultt);
                          $country_name=$row['name'];
                            ?>
                            <td><?php echo $country_name;?></td>
                            <td><?php echo $account_holder_name;?></td>
                            <td><?php echo $account_number;?></td>
                            <td><?php echo $iban;?></td>
                            <td><?php echo $account_type;?></td>
                            <td>
                                <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" name="block_status" value="<?php echo $customer_id;?>" <?php if($status == 1){echo 'checked=""';}?>>
                                            <span class="toggle"></span>
                                        </label>
                                  </div>
                            </td>
                            <td><?php echo $created_at;?></td>
                            <td><?php echo $updated_at;?></td>
                          <td class="td-actions">
                          <a href="edit_customer.php?edit_customer_id=<?php echo $customer_id?>" onclick="alert('Are You Sure?')">
                            <button type="button" data-toggle="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button>
                              </a>
                            <a href="?remove_customer=<?php echo $customer_id?>" onclick="alert('Are You Sure?')">
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
      $('input[name=block_status]').change(function(){
		    var id=$( this ).val();
        $.ajax({
          type:'POST',
          url:'block_unblock_customers.php',
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