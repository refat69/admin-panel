<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

$id = $_GET['e'];
$sel = "SELECT *FROM banner where ban_id='$id'";
$Q = mysqli_query($con, $sel);
$data = mysqli_fetch_assoc($Q);

if (!empty($_POST)) {
  $title = $_POST['title'];
  $url = $_POST['url'];
  $btn = $_POST['btn'];
  $image = $_FILES['photo'];
  $update = "UPDATE banner SET ban_title='$title', ban_url='$url', ban_btn='$btn' WHERE ban_id='$id'";
}
if (!empty($title)){
  if (!empty($url)){
    if(!empty($btn)){
      if (mysqli_query($con, $update)) {
        if ($image['name'] != '') {
          $imageName = 'user_' . time() . rand(100000, 10000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
          $updimg = "UPDATE banner SET btn_image='$imageName' WHERE ban_id='$id'";
          if (mysqli_query($con, $updimg)) {
            move_uploaded_file($image['tmp_name'], 'assets/uploads/' . $imageName);
            header('Location: view-banner.php?v=' . $id);
          }
        }
        header('Location: view-banner.php?v=' . $id);
      } else {
        echo "Update failed!";
      }

    }else{
      echo "Btn is required!";
    }

  }else{
    echo "Url is required!";
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
              <i class="fab fa-gg-circle"></i>Update banner Information
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All banner</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="title" value="<?= $data['ban_title']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Url</label>
            <div class="col-sm-7">
              <input type="url" class="form-control form_control" id="" name="url" value="<?= $data['ban_url']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Btn<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="btn" value="<?= $data['ban_btn']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="photo">
            </div>
            <div class="col-md-2">
              <?php if ($data['ban_image'] != '') { ?>
                <img class="img50" src="assets/uploads/<?= $data['ban_image']; ?>" alt="">
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