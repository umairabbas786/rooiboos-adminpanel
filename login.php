<?php include "include/header.php";?>
<?php
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}
if(isset($_POST['login']))
{
	$status="";
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="select * from staffs where email='$email' && password='$password'";
    $result=mysqli_query($conn,$sql);
	if($row=mysqli_fetch_assoc($result)){
		$id=$row['id'];
		$status=$row['status'];
		$role=$row['role'];
	}
	if($status==1){
		$_SESSION['message']="Your Account is Temporarily Blocked by Admin, Contact Admin for More details.";
		header("Location:login.php");
		die();
	}
    $count = mysqli_num_rows($result);
    if($count>=1)
    {
		$_SESSION['userid']=$id;
        $_SESSION['user'] = $email;
		$_SESSION['role']=$role;
        header("Location:index.php");
        die();
    }
    else{
        $_SESSION['message']="Invalid Username Or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css" type="text/css">
</head>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/img/logo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="#" class="mt-0">
                    <?php
      if (isset($_SESSION['message'])) {
        echo "<div class='text-center text-danger' style='font-size:16px'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
      }
      ?><br>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="email" class="form-control input_user" value="" placeholder="Email">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="login" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>