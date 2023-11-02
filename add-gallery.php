<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

if(!empty($_FILES)){
  $image=$_FILES['pic'];
  $imageName='';

  if($image['name']!=''){
    $imageName='user_'.time().'_'.rand(100000,1000000).'.'.pathinfo($image['name'],PATHINFO_EXTENSION);
  }

  $insert="INSERT INTO gallery(gallery_image)
  VALUES('$imageName')";

  if(mysqli_query($con,$insert)){
    move_uploaded_file($image['tmp_name'],'assets/uploads/'.$imageName);
    echo "Image Uploaded.";
  }else {
    echo "upload failed.";
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
                          <i class="fab fa-gg-circle"></i>Image Upload
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
                  <button type="submit" class="btn btn-sm btn-dark">UPLOAD</button>
                </div>
              </div>
          </form>
      </div>
  </div>
<?php
get_footer();
 ?>
