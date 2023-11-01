<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();
?>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8 card_title_part">
            <i class="fab fa-gg-circle"></i>All Banner Information
          </div>
          <div class="col-md-4 card_button_part">
            <a href="add-banner.php" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add Banner</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover custom_table">
          <thead class="table-dark">
            <tr>
              <th>Banner-Title</th>
              <th>Banner-url</th>
              <th>Banner-btn</th>
              <th>Photo</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sel = "SELECT * FROM banner";
            $Q = mysqli_query($con, $sel);
            while ($data = mysqli_fetch_assoc($Q)) {
            ?>
              <tr>
                <td><?= $data['ban_title'] ?></td>
                <td><?= $data['ban_url'] ?></td>
                <td><?= $data['ban_btn'] ?></td>
                <td>
                  <?php if ($data['ban_image'] != '') { ?>
                    <img class="img50" src="assets/uploads/<?= $data['ban_image']; ?>" alt="">
                  <?php } else { ?>
                    <img class="img50" src="assets/images/avatar.jpg" alt="">
                  <?php } ?>
                </td>
                <td>
                  <div class="btn-group btn_group_manage" role="group">
                    <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="view-banner.php?v=<?= $data['ban_id'] ?>">View</a></li>
                      <li><a class="dropdown-item" href="edit-banner.php?e=<?= $data['ban_id'] ?>"">Edit</a></li>
                    <li><a class=" dropdown-item" href="delete-banner.php?d=<?= $data['ban_id'] ?>">Delete</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="btn-group" role="group" aria-label="Button group">
          <button type="button" class="btn btn-sm btn-dark">Print</button>
          <button type="button" class="btn btn-sm btn-secondary">PDF</button>
          <button type="button" class="btn btn-sm btn-dark">Excel</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
?>