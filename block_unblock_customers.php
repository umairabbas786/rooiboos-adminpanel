<?php
session_start();
ob_start();
include "include/conn.php";

?>
<?php
//block customer
if(isset($_POST['id'])){
    $customer_id=$_POST['id'];
    $sql="select status from customers where id='$customer_id'";
    $result=$conn->query($sql);
    $row=mysqli_fetch_assoc($result);
    $status=$row['status'];
    if($status == 0){
      $newsql="update customers set status = 1 where id='$customer_id'";
      $run=$conn->query($newsql);
      if($run){
        $_SESSION['block_success']="User Blocked successfully";
      }
      else{
        $conn->error;
      }
    }
    else if($status == 1){
      $newsqll="update customers set status = 0 where id='$customer_id'";
      $runn=$conn->query($newsqll);
      if($runn){
        $_SESSION['block_success']="User Unblocked successfully";
      }
      else{
        $conn->error;
      }
    }
}
?>