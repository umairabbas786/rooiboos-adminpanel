<?php include "include/header.php";?>

<?php 
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>
<?php 
if(isset($_POST['add_country'])){
  $dt = date('Y-m-d h:i:s'); 
  $id=uniqid();
  $name=$_POST['name'];
  $code=$_POST['code'];
  $sql="insert into countries(id,name,code,status,created_at,updated_at)values('$id','$name','$code',1,'$dt','$dt')";
  $result=$conn->query($sql);
  if($result){
    $_SESSION['add_country_success']="Country Added Successfully";
    header("location:countries.php");
    die();
  }
  else{
    $conn->error;
  }
}

?>
<?php 
if(isset($_GET['remove_country'])){
  $id=$_GET['remove_country'];
  $sql="delete from countries where id='$id'";
  $result=$conn->query($sql);
  if($result){
    $_SESSION['remove_country_success']="Country Removed Successfully";
    header("location:countries.php");
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
        <?php if(isset($_SESSION['add_country_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['add_country_success'];?>
                </div>
            <?php }unset($_SESSION['add_country_success']);?>
            <?php if(isset($_SESSION['remove_country_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['remove_country_success'];?>
                </div>
            <?php }unset($_SESSION['remove_country_success']);?>
            <?php if(isset($_SESSION['enable_success'])){?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['enable_success'];?>
                </div>
            <?php }unset($_SESSION['enable_success']);?>
            <div class="row">
                <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Country</h4>
                  <p class="card-category">Here You can Add New Country</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="#">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country Code (2 letters)</label>
                          <input type="text" class="form-control" maxlength="2" name="code" required>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left" name="add_country">Add Country</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary card-header-icon" >
                      <div class="card-icon">
                        <i class="fa fa-globe" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Countries</h4>
                    </div>
                        <!-- DataTales Example -->
        <div class="card-body">
            <div class="table-responsive text-center">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Country</th>
                          <th>Code</th>
                          <th>Enabled / Disabled</th>
                          <th>Created At</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $sql="select * from countries order by name";
                      $result=$conn->query($sql);
                      while($row=mysqli_fetch_assoc($result)){
                      $countryid=$row['id'];
                      $name=$row['name'];
                      $code=$row['code'];
                      $status=$row['status'];
                      $created_at=$row['created_at'];
                      ?>
                        <tr>
                          <td><?php echo $countryid;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $code;?></td>
                          <td><div class="togglebutton">
                                  <label>
                                      <input type="checkbox" name="enable_disable" value="<?php echo $countryid;?>" <?php if($status == 1){echo 'checked=""';} ?> >
                                      <span class="toggle"></span>
                                  </label>
                              </div></td>
                              <td><?php echo $created_at;?></td>
                          <td class="td-actions">
                            <a href="?remove_country=<?php echo $countryid;?>" onclick="alert('Are You Sure?')">
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
      $('input[name=enable_disable]').change(function(){
		    var id=$( this ).val();
        $.ajax({
          type:'POST',
          url:'enable_disable_country.php',
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