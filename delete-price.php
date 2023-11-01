<?php
require_once('functions/function.php');
$id=$_GET['d'];
$del="DELETE FROM prices WHERE price_id=$id";
if(mysqli_query($con,$del)){
  header('Location: all-price.php');
}else {
  echo "delete failed.";
}

 ?>