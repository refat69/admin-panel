<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

$id = $_GET['e'];
$sel = "SELECT *FROM parent where parent_id='$id'";
$Q = mysqli_query($con, $sel);
$data = mysqli_fetch_assoc($Q);

if (!empty($_POST)) {
  $title = $_POST['title'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $image = $_FILES['photo'];
  $update = "UPDATE parent SET parent_title='$title', parent_name='$name', parent_type='$type' WHERE parent_id='$id'";
}
if (!empty($title)){
  if (!empty($name)){
    if(!empty($type)){
      if (mysqli_query($con, $update)) {
        if ($image['name'] != '') {
          $imageName = 'user_' . time() . rand(100000, 10000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
          $updimg = "UPDATE parent SET parent_image='$imageName' WHERE parent_id='$id'";
          if (mysqli_query($con, $updimg)) {
            move_uploaded_file($image['tmp_name'], 'assets/uploads/' . $imageName);
            header('Location: view-parent.php?v=' . $id);
          }
        }
        header('Location: view-parent.php?v=' . $id);
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
              <i class="fab fa-gg-circle"></i>Update Parent Information
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-parent.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Parent</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="title" value="<?= $data['parent_title']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="name" value="<?= $data['parent_name']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Type<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="type" value="<?= $data['parent_type']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="photo">
            </div>
            <div class="col-md-2">
              <?php if ($data['parent_image'] != '') { ?>
                <img class="img50" src="assets/uploads/<?= $data['parent_image']; ?>" alt="">
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