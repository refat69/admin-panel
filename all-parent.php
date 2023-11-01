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
            <i class="fab fa-gg-circle"></i>All Parent Information
          </div>
          <div class="col-md-4 card_button_part">
            <a href="add-parent.php" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add Parent</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover custom_table">
          <thead class="table-dark">
            <tr>
              <th>Parent-Title</th>
              <th>Parent-Name</th>
              <th>Parent-Type</th>
              <th>Photo</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sel = "SELECT * FROM parent";
            $Q = mysqli_query($con, $sel);
            while ($data = mysqli_fetch_assoc($Q)) {
            ?>
              <tr>
                <td><?= $data['parent_title'] ?></td>
                <td><?= $data['parent_name'] ?></td>
                <td><?= $data['parent_type'] ?></td>
                <td>
                  <?php if ($data['parent_image'] != '') { ?>
                    <img class="img50" src="assets/uploads/<?= $data['parent_image']; ?>" alt="">
                  <?php } else { ?>
                    <img class="img50" src="assets/images/avatar.jpg" alt="">
                  <?php } ?>
                </td>
                <td>
                  <div class="btn-group btn_group_manage" role="group">
                    <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="view-parent.php?v=<?= $data['parent_id'] ?>">View</a></li>
                      <li><a class="dropdown-item" href="edit-parent.php?e=<?= $data['parent_id'] ?>"">Edit</a></li>
                    <li><a class=" dropdown-item" href="delete-parent.php?d=<?= $data['parent_id'] ?>">Delete</a></li>
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