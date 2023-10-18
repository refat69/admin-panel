<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <header>
    <div class="container-fluid header_part">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7"></div>
        <div class="col-md-3 top_right_menu text-end">
          <div class="dropdown">
            <button class="btn dropdown-toggle top_right_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
              if (!empty($_SESSION['photo'])) {
              ?>
                <img  src="assets/uploads/<?= $_SESSION['photo']; ?>" alt="photo" class="img-fluid">
              <?php
              } else {
              ?>
                <img src="assets/img/avatar.png" alt="photo" class="img-fluid">
              <?php
              }
              ?>
              <?= $_SESSION['name']; ?>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fas fa-user-tie"></i> My Profile</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Manage Account</a></li>
              <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
          </div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
  </header>