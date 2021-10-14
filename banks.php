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
                <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Bank</h4>
                  <p class="card-category">Here You can Add New Bank</p>
                </div>
                <div class="card-body">
                  <form>
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Bank Name</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Bank Code</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-left">Add Bank</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary card-header-icon" >
                      <div class="card-icon">
                        <i class="fa fa-money" style="font-size:24px;"></i>
                      </div>
                      <h4 class="card-title">Banks</h4>
                    </div>
                        <!-- DataTales Example -->
        <div class="card-body">
            <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Bank Name</th>
                          <th>Code</th>
                          <th>Status</th>
                          <th class="disabled-sorting">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Habib Bank Limited</td>
                          <td>HBL</td>
                          <td class="badge badge-success mt-2">Active</td>
                          <td class="td-actions">
                            <button type="button" data-toggle="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                              <i class="material-icons">close</i>
                            </button>
                          </td>
                        </tr>
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
</body>

</html>