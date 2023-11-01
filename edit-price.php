<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

$id=$_GET['e'];
$sel="SELECT * FROM prices WHERE price_id=$id";
$Q=mysqli_query($con,$sel);
$data=mysqli_fetch_assoc($Q);

if(!empty($_POST)){
  $eid=$_POST['eid'];
  $type=$_POST['type'];
  $rate=$_POST['rate'];
  $duration=$_POST['duration'];
  $details=$_POST['details'];
  $button=$_POST['button'];
  $url=$_POST['url'];
  $image=$_FILES['pic'];

  $update="UPDATE prices SET price_type='$type', price_rate='$rate', price_duration='$duration',price_details='$details',
  price_button='$button',price_url='$url' WHERE price_id=$id";

  if(!empty($type)){
      if(!empty($rate)){
        if(!empty($duration)){
          if(mysqli_query($con,$update)){
            if($image['name']!=''){
              $imageName='user_'.time().'_'.rand(100000,1000000).'.'.pathinfo($image['name'],PATHINFO_EXTENSION);
              $upimg="UPDATE price SET price_image='$imageName' WHERE price_id=$id";
              if(mysqli_query($con,$upimg)){
                move_uploaded_file($image['tmp_name'],'admin-panel/assets/uploads/'.$imageName);
                header('Location: view-price.php?v='.$id);;
              }
            }
            header('Location: view-price.php?v='.$id);
          }else {
            echo "Banner information update failed.";
          }
        }else {
          echo "please enter course duration";
        }
      }else {
        echo "please enter course rate.";
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
                        <i class="fab fa-gg-circle"></i>Update Price
                    </div>
                    <div class="col-md-4 card_button_part">
                        <a href="all-price.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Price Information</a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Type<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="hidden" name="eid" value="<?= $data['price_id'] ?>"/>
                      <input type="text" class="form-control form_control" id="" name="type" value="<?=$data['price_type']?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Rate:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="rate" value="<?=$data['price_rate']?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Druation<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="duration" value="<?=$data['price_duration']?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Details<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="details" value="<?=$data['price_details']?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Button<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="button" value="<?=$data['price_button']?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Url<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="url" value="<?=$data['price_url']?>">
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
                <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
              </div>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
 ?>
