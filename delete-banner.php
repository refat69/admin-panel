<?php
require_once('functions/function.php');

$id=$_GET['d'];
$del="DELETE FROM banner WHERE ban_id='$id'";
if(mysqli_query($con,$del)){
    header('Location:all-banner.php');
}else{
  echo "Delete failed!";
}
?>