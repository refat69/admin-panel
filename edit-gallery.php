<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

$id=$_GET['e'];
$sel="SELECT * FROM gallery WHERE gallery_id=$id";
$Q=mysqli_query($con,$sel);
$data=mysqli_fetch_assoc($Q);

if(!empty($_FILES)){
  $image=$_FILES['pic'];

  if(!empty($image)){
    if($image['name']!=''){
      $imageName='user_'.time().'_'.rand(100000,1000000).'.'.pathinfo($image['name'],PATHINFO_EXTENSION);
      $upimg="UPDATE gallery SET gallery_image='$imageName' WHERE gallery_id=$id";
      if(mysqli_query($con,$upimg)){
        move_uploaded_file($image['tmp_name'],'assets/uploads/'.$imageName);
        echo "Updated";
      }
    }else {
      echo "Update failed.";
    }
  }else {
    echo "please select an image.";
  }

}
 ?>
<div class="row">
    <div class="col-md-12 ">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card mb-3">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 card_title_part">
                        <i class="fab fa-gg-circle"></i>Update Image
                    </div>
                    <div class="col-md-4 card_button_part">
                        <a href="all-gallery.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Images</a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Image:</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control form_control" id="" name="pic">
                    </div>
                  </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
              </div>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
 ?>
