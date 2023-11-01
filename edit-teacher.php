<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

$id = $_GET['e'];
$sel = "SELECT *FROM teachers where tech_id='$id'";
$Q = mysqli_query($con, $sel);
$data = mysqli_fetch_assoc($Q);

if (!empty($_POST)) {
  $title = $_POST['title'];
  $name = $_POST['name'];
  $prof = $_POST['prof'];
  $image = $_FILES['photo'];
  $update = "UPDATE teachers SET tech_title='$title', tech_name='$name', tech_prof='$prof' WHERE tech_id='$id'";
}
if (!empty($title)){
  if (!empty($name)){
    if(!empty($prof)){
      if (mysqli_query($con, $update)) {
        if ($image['name'] != '') {
          $imageName = 'user_' . time() . rand(100000, 10000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
          $updimg = "UPDATE teachers SET tech_image='$imageName' WHERE tech_id='$id'";
          if (mysqli_query($con, $updimg)) {
            move_uploaded_file($image['tmp_name'], 'assets/uploads/' . $imageName);
            header('Location: view-teacher.php?v=' . $id);
          }
        }
        header('Location: view-teacher.php?v=' . $id);
      } else {
        echo "Update failed!";
      }

    }else{
      echo "type is required!";
    }

  }else{
    echo "Name is required!";
  }

}else{
  echo "Title is required!";
}
?>
<div class="row">
  <div class="col-md-12 ">
    <form method="post" action="#" enctype="multipart/form-data">
      <div class="card mb-3">
        <div class="card-header">
          <div class="row">
            <div class="col-md-8 card_title_part">
              <i class="fab fa-gg-circle"></i>Update teachers Information
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-tech.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All teachers</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="title" value="<?= $data['tech_title']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="name" value="<?= $data['tech_name']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Profession<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="prof" value="<?= $data['tech_prof']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="photo">
            </div>
            <div class="col-md-2">
              <?php if ($data['tech_image'] != '') { ?>
                <img class="img50" src="assets/uploads/<?= $data['tech_image']; ?>" alt="">
              <?php } else { ?>
                <img class="img50" src="assets/images/avatar.jpg" alt="">
              <?php } ?>
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