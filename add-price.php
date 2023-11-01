<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

if(!empty($_POST)){
  $type=$_POST['type'];
  $rate=$_POST['rate'];
  $duration=$_POST['duration'];
  $details=$_POST['details'];
  $button=$_POST['Button'];
  $url=$_POST['url'];
  $image=$_FILES['pic'];
  $imageName='';

  if($image['name']!=''){
    $imageName='user_'.time().'_'.rand(100000,1000000).'.'.pathinfo($image['name'],PATHINFO_EXTENSION);
  }

  $insert="INSERT INTO prices(price_type,price_rate,price_duration,price_details,price_button,price_url,price_image)
  VALUES('$type','$rate','$duration','$details','$button','$url','$imageName')";

  if(!empty($type)){
    if(!empty($rate)){
      if(!empty($button)){
        if(!empty($url)){
          if(mysqli_query($con,$insert)){
            move_uploaded_file($image['tmp_name'],'assets/uploads/'.$imageName);
            echo "Price information uploaded.";
          }else {
            echo "Price information upload failed.";
          }
        }else {
          echo "please enter button url.";
        }
      }else {
        echo "please enter button name.";
      }
    }else {
      echo "please enter course price.";
    }
  }else {
    echo "please enter course type.";
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
                          <i class="fab fa-gg-circle"></i>Price Information Upload
                      </div>
                      <div class="col-md-4 card_button_part">
                          <a href="all-price.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Price Information</a>
                      </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label col_form_label">Course Type<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="" name="type">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label col_form_label">Course Rate:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="" name="rate">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label col_form_label">Course duration<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="" name="duration">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label col_form_label">Details<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="" name="details">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label col_form_label">Button<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="" name="Button">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label col_form_label">Url<span class="req_star">*</span>:</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form_control" id="" name="url">
                      </div>
                    </div>
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
