<?php
require_once('functions/function.php');
needLogged();
get_header();
get_sidebar();

$id=$_GET['v'];
$sel="SELECT * FROM gallery  WHERE gallery_id=$id";
$Q=mysqli_query($con,$sel);
$data=mysqli_fetch_assoc($Q);
 ?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-8 card_title_part">
                    <i class="fab fa-gg-circle"></i>View Images
                </div>
                <div class="col-md-4 card_button_part">
                    <a href="all-gallery.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Images</a>
                </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table class="table table-bordered table-striped table-hover custom_view_table">
                      <tr>
                        <td>Image</td>
                        <td>:</td>
                        <td>
                          <?php if($data['gallery_image']!=''){ ?>
                            <img class="img200" src="assets/uploads/<?=$data['gallery_image']?>" alt=""/>
                          <?php }else{ ?>
                              <img class="img200" src="images/avatar.jpg" alt=""/>
                          <?php } ?>
                        </td>
                      </tr>
                    </table>
                </div>
                <div class="col-md-2"></div>
            </div>
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
