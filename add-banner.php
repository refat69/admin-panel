<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

if (!empty($_POST)) {
  $title = $_POST['title'];
  $url = $_POST['url'];
  $btn = $_POST['btn'];
  $image = $_FILES['photo'];
  $imageName = '';

  if ($image['name'] != '') {
    $imageName = 'user_' . time() . rand(100000, 10000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
  }
  $insert = "INSERT INTO banner(ban_title, ban_url, ban_btn, ban_image) 
  VALUES('$title','$url','$btn','$imageName')";

  if(!empty($title)){
    if(!empty($url)){
      if(!empty($btn)){
        if(mysqli_query($con,$insert)){
          move_uploaded_file($image['tmp_name'], 'assets/uploads/'.$imageName);
          echo "registration done.";
        }else{
          echo "registration failed";
        }
      }else{
        echo "please enter your button.";
      }
    }else{
      echo "please enter your url.";
    }
  }else{
    echo "please enter your title.";
  }
}

?>
<div class="row">
  <div class="col-md-12 ">
    <form method="post" action="#" enctype="multipart/form-data">
      <div class="card mb-3">
        <div class="card-header">
          <div class="row">
            <div class="col-md-8 card_title_part">
              <i class="fab fa-gg-circle"></i>Add Banner
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Banner</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">banner-title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="title">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">banner-url</label>
            <div class="col-sm-7">
              <input type="url" class="form-control form_control" id="" name="url">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Banner-btn<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="btn">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Banner-Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="photo">
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-sm btn-dark">REGISTRATION</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
get_footer();
?>