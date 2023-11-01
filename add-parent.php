<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

if (!empty($_POST)) {
  $title = $_POST['title'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $image = $_FILES['photo'];
  $imageName = '';

  if ($image['name'] != '') {
    $imageName = 'user_' . time() . rand(100000, 10000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
  }
  $insert = "INSERT INTO parent(parent_title, parent_name, parent_type, parent_image) 
  VALUES('$title','$name','$type','$imageName')";

  if(!empty($title)){
    if(!empty($name)){
      if(!empty($type)){
        if(mysqli_query($con,$insert)){
          move_uploaded_file($image['tmp_name'], 'assets/uploads/'.$imageName);
          echo "submit done.";
        }else{
          echo "submit failed";
        }
      }else{
        echo "please enter your type.";
      }
    }else{
      echo "please enter your name.";
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
              <i class="fab fa-gg-circle"></i>Add Parents
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-parent.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Parents</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="title">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="name">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Type<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="type">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Parent-Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="photo">
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-sm btn-dark">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
get_footer();
?>