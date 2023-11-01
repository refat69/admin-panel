<?php
require_once('functions/function.php');

$id=$_GET['d'];
$del="DELETE FROM teachers WHERE ban_id='$id'";
if(mysqli_query($con,$del)){
    header('Location:all-teacher.php');
}else{
  echo "Delete failed!";
}
?>