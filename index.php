<?php include "include/header.php";?>

<?php
//login check
if (empty(isset($_SESSION['user']))) {
  header('Location: login.php');
  die();
}
?>

<body class="">
    <?php include "include/navbar.php";?>
    <!--Content Start-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <?php 
                            $sql="select count(id) from customers where status=1";
                            $result=$conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $block=$row['count(id)'];
                            ?>
                            <?php 
                            $sql="select count(id) from customers where status=0";
                            $result=$conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $unblock=$row['count(id)'];
                            ?>
                            <p class="card-category">Active / Block</p>
                            <h3 class="card-title"><?php echo $unblock;?> / <?php echo $block;?>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">person</i>
                                Users
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Settlements / Requests</p>
                            <h3 class="card-title">$300 / 10</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Settlement Requests
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">info_outline</i>
                            </div>
                            <?php 
                            $sql="select count(id) from withdraw_history where status=0";
                            $result=$conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $pending=$row['count(id)'];
                            ?>
                            <p class="card-category">Pending Payments</p>
                            <h3 class="card-title"><?php echo $pending;?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Pending Payments
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <?php 
                            $sql="select count(id) from send_history";
                            $result=$conn->query($sql);
                            $row=mysqli_fetch_assoc($result);
                            $transfer=$row['count(id)'];
                            ?>
                            <p class="card-category">Transfer Payments</p>
                            <h3 class="card-title"><?php echo $transfer;?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Transfer Payments
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Payments</h4>
                            <p class="card-category">
                                Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> Last 24 hours
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Deposits</h4>
                            <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> Last 24 Hours
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-danger">
                            <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Completed Transactions</h4>
                            <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> Last 24 Hours
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
</body>

</html>