<?php
session_start();
ob_start();
include "include/conn.php";

?>
<?php
//block banks
if(isset($_POST['id'])){
    $id=$_POST['id'];
    $sql="select status from banks where id='$id'";
    $result=$conn->query($sql);
    $row=mysqli_fetch_assoc($result);
    $status=$row['status'];
    if($status == 0){
      $newsql="update banks set status = 1 where id='$id'";
      $run=$conn->query($newsql);
      if($run){
        $_SESSION['bank_success']="Bank Enabled Successfully";
      }
      else{
        $conn->error;
      }
    }
    else if($status == 1){
      $newsqll="update banks set status = 0 where id='$id'";
      $runn=$conn->query($newsqll);
      if($runn){
        $_SESSION['bank_success']="Bank Disabled Successfully";
      }
      else{
        $conn->error;
      }
    }
}
?>