<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>
<?php
if(isset($_GET['remove_staff'])){
  $id=$_GET['remove_staff'];
  $sql="Delete from staffs where id='$id'";
  $delete=$conn->query($sql);
  if($delete)
    {
      $_SESSION['remove_staff_success']="Staff Member Removed Successfully";
      header("location: allstaffs.php");
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
        <?php if(isset($_SESSION['add_staff_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['add_staff_success'];?>
                </div>
            <?php }unset($_SESSION['add_staff_success']);?>
            <?php if(isset($_SESSION['staff_block_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['staff_block_success'];?>
                </div>
            <?php }unset($_SESSION['staff_block_success']);?>
            <?php if(isset($_SESSION['staff_unblock_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['staff_unblock_success'];?>
                </div>
            <?php }unset($_SESSION['staff_unblock_success']);?>
            <?php if(isset($_SESSION['remove_staff_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['remove_staff_success'];?>
                </div>
            <?php }unset($_SESSION['remove_staff_success']);?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                      <div class="card-icon">
                        <i class="fa fa-users" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Staffs</h4>
                    </div>
                  <!-- DataTale-->
        <div class="card-body">
            <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Phone Number</th>
                          <th>Block / Unblock</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $sql="select * from staffs where role='staff'";
                          $result=$conn->query($sql);
                          while($row=mysqli_fetch_assoc($result)){
                            $id=$row['id'];
                            $name=$row['name'];
                            $email=$row['email'];
                            $password=$row['password'];
                            $phone=$row['phone_number'];
                            $status=$row['status'];
                        ?>
                        <tr>
                          <td><?php echo $id;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $email;?></td>
                          <td><?php echo $password;?></td>
                          <td><?php echo $phone;?></td>
                          <td>
                          <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" name="block_staff" value="<?php echo $row['id'];?>" <?php if($status == 1){echo 'checked=""';}?>>
                                            <span class="toggle"></span>
                                        </label>
                                  </div>
                          </td>
                          <td class="td-actions">
                            <!-- <button type="button" data-toggle="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button> -->
                            <a href="?remove_staff=<?php echo $id;?>">
                            <button type="button" data-toggle="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                              <i class="material-icons">close</i>
                            </button>
                            </a>
                          </td>
                        </tr>
                        <?php }?>
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
      $('input[name=block_staff]').change(function(){
		    var id=$( this ).val();
        $.ajax({
          type:'POST',
          url:'block_unblock_staffs.php',
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