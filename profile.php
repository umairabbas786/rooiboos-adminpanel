<?php include "include/header.php";?>

<?php
//fetching user data
if(isset($_SESSION['user'])){
    $email = $_SESSION['user'];
    $sql = "SELECT * FROM staffs WHERE email = '$email'";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $name =$row['name'];
      $pass=$row['password'];
      $phone=$row['phone_number'];
    }
 }
 //getting user id
 if(isset($_SESSION['userid'])){
    $id=$_SESSION['userid'];
 }
 //updating password
if(isset($_POST['change_password'])){
    $oldpass=$_POST['old_password'];
    $newpass=$_POST['password'];
    $confirmpass=$_POST['password_confirmation'];
    $sql="SELECT * FROM staffs WHERE id = '$id'";
    $result=$conn->query($sql);
    $row=mysqli_fetch_assoc($result);
    $existingpass=$row['password'];
    if($oldpass==$existingpass){
        if($newpass==$confirmpass){
            $q="update staffs set password='$newpass' where id='$id'";
            $updatepass=$conn->query($q);
            if($updatepass){
                $_SESSION['passsuccess']="Password Updated Successfully.";
                header ("location:profile.php");
                die();
            }
        }else{
            $_SESSION['passerror']="New Passwords must be Same.";
        }
        
    }else{
        $_SESSION['passerror']="Old Password is Incorrect.";
    }
}
?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="#"
                        autocomplete="off" class="form-horizontal">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Profile</h4>
                                <p class="card-category">Information</p>
                            </div>
                            <div class="card-body ">
                                <?php if(isset($_SESSION['error'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['error'];?>
			</div>
		<?php }unset($_SESSION['error']);?>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-7">
                                        <div class="form-group bmd-form-group is-filled">
                                            <input class="form-control" name="name" id="input-name" type="text"
                                                placeholder="Name" readonly value="<?php echo $name;?>" required="true"
                                                aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-7">
                                        <div class="form-group bmd-form-group is-filled">
                                            <input class="form-control" name="email" id="input-email" type="email"
                                                placeholder="Email" readonly value="<?php echo $email;?>" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-7">
                                        <div class="form-group bmd-form-group is-filled">
                                            <input class="form-control" name="phone" id="input-email" type="number"
                                                   placeholder="Phone Number" readonly value="<?php echo $phone;?>" required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="#"
                        class="form-horizontal">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Change password</h4>
                                <p class="card-category">Password</p>
                            </div>
                            <div class="card-body ">
                            <?php if(isset($_SESSION['passerror'])){?>
			<div class="alert alert-danger" role="alert">
			<?php echo $_SESSION['passerror'];?>
			</div>
		<?php }unset($_SESSION['passerror']);?>
        <?php if(isset($_SESSION['passsuccess'])){?>
			<div class="alert alert-success" role="alert">
			<?php echo $_SESSION['passsuccess'];?>
			</div>
		<?php }unset($_SESSION['passsuccess']);?>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="input-current-password">Current
                                        Password</label>
                                    <div class="col-sm-7">
                                        <div class="form-group bmd-form-group">
                                            <input class="form-control" input="" type="password" name="old_password"
                                                id="input-current-password" placeholder="Current Password" value=""
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="input-password">New Password</label>
                                    <div class="col-sm-7">
                                        <div class="form-group bmd-form-group">
                                            <input class="form-control" name="password" id="input-password"
                                                type="password" placeholder="New Password" value="" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="input-password-confirmation">Confirm New
                                        Password</label>
                                    <div class="col-sm-7">
                                        <div class="form-group bmd-form-group">
                                            <input class="form-control" name="password_confirmation"
                                                id="input-password-confirmation" type="password"
                                                placeholder="Confirm New Password" value="" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" name="change_password" class="btn btn-primary">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Content End-->
    <?php include "include/footer.php";?>

    <?php include "include/scripts.php";?>
</body>

</html>