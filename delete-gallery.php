<?php
require_once('functions/function.php');
$id=$_GET['d'];
$del="DELETE FROM gallery WHERE gallery_id=$id";
if(mysqli_query($con,$del)){
  header('Location: all-gallery.php');
}else {
  echo "delete failed.";
}

 ?>