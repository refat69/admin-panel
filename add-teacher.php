<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

if (!empty($_POST)) {
  $title = $_POST['title'];
  $name = $_POST['name'];
  $prof = $_POST['prof'];
  $image = $_FILES['photo'];
  $imageName = '';

  if ($image['name'] != '') {
    $imageName = 'user_' . time() . rand(100000, 10000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
  }
  $insert = "INSERT INTO teachers(tech_title, tech_name, tech_prof, tech_image) 
  VALUES('$title','$name','$prof','$imageName')";

  if(!empty($title)){
    if(!empty($name)){
      if(!empty($prof)){
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
              <i class="fab fa-gg-circle"></i>Add teachers
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-teacher.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All teacher</a>
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
            <label class="col-sm-3 col-form-label col_form_label">Profession<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="prof">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">teacher-Photo:</label>
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