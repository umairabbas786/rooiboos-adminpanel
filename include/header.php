<?php
session_start();
ob_start();
include "include/conn.php";

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <?php 
  $title="Rooi Boos";
  if($_SERVER['REQUEST_URI'] == "/login.php"){$title="Login - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/index.php"){$title="Dashboard - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/profile.php"){$title="My Profile - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/allcustomers.php"){$title="Customers - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/addcustomer.php"){$title="Add Customer - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/allstaffs.php"){$title="Staffs - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/addstaff.php"){$title="Staffs - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/currencies.php"){$title="Currencies - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/charges_settings.php"){$title="Currency Charges Settings - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/countries.php"){$title="Countries - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/banks.php"){$title="Banks - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/edit_customers.php"){$title="Edit Customer - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/settlement_requests.php"){$title="Settlement Requests - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/deposit.php"){$title="Deposit History - Rooi Boos";}
  else if($_SERVER['REQUEST_URI'] == "/transfer_payments.php"){$title="Transfer Payments - Rooi Boos";}
  ?>
  <title><?php echo $title;?></title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- <link href="assets/css/material-dashboard.min.css?v=1.0.1" rel="stylesheet" /> -->
  <!-- Custom styles for this page -->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/css/lightbox.css" rel="stylesheet">
  
</head>