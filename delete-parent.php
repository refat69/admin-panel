<?php
require_once('functions/function.php');

$id=$_GET['d'];
$del="DELETE FROM parent WHERE ban_id='$id'";
if(mysqli_query($con,$del)){
    header('Location:all-parent.php');
}else{
  echo "Delete failed!";
}
?>