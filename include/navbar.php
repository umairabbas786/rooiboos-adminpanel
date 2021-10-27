<?php
//fetching name
if(isset($_SESSION['user'])){
    $email = $_SESSION['user'];
    $sql = "SELECT * FROM staffs WHERE email = '$email'";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $name =$row['name'];
    }
 }
?>
<div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <div class="logo"><a href="#" class="simple-text logo-normal">
      <?php echo $name;?>
        </a></div>
      <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/profile.php" || $_SERVER['REQUEST_URI'] == "/logout.php"){echo 'active';}?>">
            <a data-toggle="collapse" href="#collapseExamplee" class="nav-link">
            <i class="fa fa-user-circle-o" style="color:#2775AB;"></i>
              <p> <?php echo $name;?>
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="collapseExamplee">
              <ul class="nav">
                <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/profile.php"){echo 'active';}?>">
                  <a class="nav-link" href="profile.php">
                    <span class="sidebar-mini"> <i class="material-icons">person</i> </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">
                    <span class="sidebar-mini"> <i class="fa fa-sign-out"></i> </span>
                    <span class="sidebar-normal"> Logout </span>
                  </a>
                </li>
              </ul>
            </div>
</li>
            </ul>
            <hr>
        <ul class="nav">
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/index.php"){echo 'active';}?>">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/allcustomers.php" || $_SERVER['REQUEST_URI'] == "/addcustomer.php"){echo 'active';}?>">
            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
              <i class="fa fa-id-badge"></i>
              <p> Customers
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="componentsExamples">
              <ul class="nav">
                <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/allcustomers.php"){echo 'active';}?>">
                  <a class="nav-link" href="allcustomers.php">
                    <span class="sidebar-mini"> AC </span>
                    <span class="sidebar-normal"> All Customers </span>
                  </a>
                </li>
                <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/addcustomer.php"){echo 'active';}?>">
                  <a class="nav-link" href="addcustomer.php">
                    <span class="sidebar-mini"> AC </span>
                    <span class="sidebar-normal"> Add Customer </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <?php if($_SESSION['role'] == "admin"){?>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/allstaffs.php" || $_SERVER['REQUEST_URI'] == "/addstaff.php"){echo 'active';}?>">
            <a class="nav-link" data-toggle="collapse" href="#componentsExample">
              <i class="fa fa-users"></i>
              <p> Staffs
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="componentsExample">
              <ul class="nav">
                <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/allstaffs.php"){echo 'active';}?>">
                  <a class="nav-link" href="allstaffs.php">
                    <span class="sidebar-mini"> AS </span>
                    <span class="sidebar-normal"> All Staffs </span>
                  </a>
                </li>
                <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/addstaff.php"){echo 'active';}?>">
                  <a class="nav-link" href="addstaff.php">
                    <span class="sidebar-mini"> AS </span>
                    <span class="sidebar-normal"> Add Staff </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <?php }?>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/deposit.php"){echo 'active';}?>">
            <a class="nav-link" href="deposit.php">
              <i class="fa fa-plus"></i>
              <p>Deposit</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/transfer_payments.php"){echo 'active';}?>">
            <a class="nav-link" href="transfer_payments.php">
              <i class="fa fa-exchange"></i>
              <p>Transfer Payments</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/settlement_requests.php"){echo 'active';}?>">
            <a class="nav-link" href="settlement_requests.php">
              <i class="fa fa-handshake-o"></i>
              <p>Settlement Requests</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/charges_settings.php"){echo 'active';}?>">
            <a class="nav-link" href="charges_settings.php">
              <i class="fa fa-sliders"></i>
              <p>Charges Settings</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/currencies.php"){echo 'active';}?>">
            <a class="nav-link" href="currencies.php">
              <i class="fa fa-money"></i>
              <p>Supported Currency</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/countries.php"){echo 'active';}?>">
            <a class="nav-link" href="countries.php">
              <i class="fa fa-globe"></i>
              <p>Supported Countries</p>
            </a>
          </li>
          <li class="nav-item <?php if($_SERVER['REQUEST_URI'] == "/banks.php"){echo 'active';}?>">
            <a class="nav-link" href="banks.php">
              <i class="fa fa-university"></i>
              <p>Supported Banks</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-cogs"></i>
              <p>Settings</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
          <!-- <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div> -->
            
            <!--For Page Heading-->
            <?php 
  $heading="Dashboard";
  if($_SERVER['REQUEST_URI'] == "/index.php"){$heading="Dashboard";}
  else if($_SERVER['REQUEST_URI'] == "/profile.php"){$heading="My Profile";}
  else if($_SERVER['REQUEST_URI'] == "/allcustomers.php"){$heading="Customers";}
  else if($_SERVER['REQUEST_URI'] == "/addcustomer.php"){$heading="Customer";}
  else if($_SERVER['REQUEST_URI'] == "/allstaffs.php"){$heading="Staffs";}
  else if($_SERVER['REQUEST_URI'] == "/addstaff.php"){$heading="Staffs";}
  else if($_SERVER['REQUEST_URI'] == "/currencies.php"){$heading="Currency";}
  else if($_SERVER['REQUEST_URI'] == "/charges_settings.php"){$heading="Charges Settings";}
  else if($_SERVER['REQUEST_URI'] == "/countries.php"){$heading="Countries";}
  else if($_SERVER['REQUEST_URI'] == "/banks.php"){$heading="Banks";}
  else if($_SERVER['REQUEST_URI'] == "/edit_customer.php"){$heading="Customer";}
  else if($_SERVER['REQUEST_URI'] == "/settlement_requests.php"){$heading="Settlement Requests";}
  else if($_SERVER['REQUEST_URI'] == "/deposit.php"){$heading="Deposit History";}
  else if($_SERVER['REQUEST_URI'] == "/transfer_payments.php"){$heading="Transfer Payments";}
  ?>
            <!--end- Page Heading-->
            <a class="navbar-brand" href="javascript:;"><?php echo $heading;?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Notifications
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="profile.php">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->