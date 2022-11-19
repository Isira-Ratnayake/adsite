<?php
  $get_next_ad_record_query = 'select * from ad_table where ad_user_id = :user_id order by ad_last_modified desc;';
  $get_next_ad_record_statement;
  $get_next_ad_record_result = null;
  $current_time_obj = new DateTime();
  try {
      $get_next_ad_record_statement = $db->prepare($get_next_ad_record_query);
      $get_next_ad_record_statement->bindValue(':user_id', $_SESSION['user_id']);
      $get_next_ad_record_statement->execute();
      $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
  }
  catch(Exception $e) {
      //Error handling
      echo $e->getMessage();
  }
?>

<ul class="nav pt-2 px-2 mb-3 justify-content-end">
        <li class="nav-item">
          <a class="rounded-pill btn btn-outline-dark" href="./index.php?action=logout">&nbsp;&nbsp;Sign-Out&nbsp;&nbsp;</a>
        </li>
    </ul>
    <div class="container-fluid main-body">
      <h1 class="ms-5"><?php echo $heading?></h1>
      <div class="row justify-content-center">
        <div class="col col-11">
          <hr>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col col-11">
            <a class="rounded-pill btn btn-dark btn-lg" href="./index.php?action=adtype">&nbsp;&nbsp;&nbsp;&nbsp;New&nbsp;Ad&nbsp;&nbsp;&nbsp;&nbsp;</a>
          </div>
        </div>

<?php while($get_next_ad_record_result != null):?>
  <?php if($get_next_ad_record_result['ad_type_id'] == 1):?>
    <!-- Ad Card -->
    <div class="container-fluid my-5 mb-5">
        <div class="row justify-content-center">
          <div class="col col-11">
            <div class="card border-dark mb-3 overflow-x-hidden">
              <div class="row py-1 border-bottom">
                <div class="col m-1 mx-2">
                  <!-- Preview -->
                  <a href="./index.php?action=displayad&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="rounded-pill btn btn-outline-dark">Preview</a>
                </div>
                <div class="col text-end align-self-center mx-2">
                  <?php if($get_next_ad_record_result['ad_status'] == 'PENDING'):?>
                    <img class="img-fluid status-img-max-height" src="./images/pending_icon.svg" alt="PENDING">
                  <?php elseif($get_next_ad_record_result['ad_status'] == 'DECLINED'):?>
                    <img class="img-fluid status-img-max-height" src="./images/declined_icon.svg" alt="DECLINED">
                  <?php else:?>
                    <img class="img-fluid status-img-max-height" src="./images/verified_icon.svg" alt="VERIFIED">
                  <?php endif;?>
                </div>
              </div>
              <div class="row py-1 pe-2 border-bottom text-end">
                <div class="py-1">
                  <!-- Make Top Ads -->
                  <a href="./index.php?action=maketopadselect&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="border border-2 border-warning btn rounded-pill btn-outline-warning text-dark fw-bold btn-sm">&nbsp;&nbsp;Make&nbsp;Top&nbsp;Ad&nbsp;&nbsp;</a>
                </div>
              </div>
              <div class="row g-0">
                <div class="col col-xl-2 col-lg-3 col-md-4 col-sm-5 col-12 overflow-x-hidden">
                  <img src="<?php echo $get_next_ad_record_result['ad_image_path']?>" class="img-fluid rounded-start ad-img-size" alt="Ad Image">
                </div>
                <div class="col">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $get_next_ad_record_result['ad_title']?></h5>
                    <h6 class="card-subtitle text-muted"><?php echo get_category_name_from_id($get_next_ad_record_result['ad_category_id'])?>&nbsp;|&nbsp;<?php echo get_city_name_from_id($get_next_ad_record_result['ad_city_id'])?></h6>
                    <div class="row">
                      <div class="col col-12">
                        <hr>
                      </div>
                    </div>
                    <p class="card-text card-text-custom">
                      <?php echo $get_next_ad_record_result['ad_description']?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="row py-1 border-top">
                <div class="col text-center">
                <a href="tel:<?php echo get_phone_no_from_user_id($get_next_ad_record_result['ad_user_id'])?>" class="tel-link"><?php echo get_phone_no_from_user_id($get_next_ad_record_result['ad_user_id'])?></a>
                </div>
                <div class="col text-center fw-bold">
                  Rs&nbsp;<?php echo $get_next_ad_record_result['ad_price']?>
                </div>
                <div class="col text-center text-truncate">
                  <?php
                    $ad_date_created = new DateTime($get_next_ad_record_result['ad_created']);
                    $interval = get_time_diff($ad_date_created, $current_time_obj);
                    echo $interval . ' ago';
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col col-11">
            <div class="row gx-2 justify-content-end">
            <div class="col col-xl-1 col-md-2 col-sm-3 col-4">
              <div class="d-grid">
                <!-- Update -->
                <a href="./index.php?action=updatead&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="btn btn-secondary">Update</a>
              </div>
            </div>
            <div class="col col-xl-1 col-md-2 col-sm-3 col-4">
              <div class="d-grid">
                <!-- Delete -->
                <a href="./index.php?action=deletead&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="btn btn-secondary">Delete</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
  <?php else:?>
    <div class="container-fluid my-5 mb-5">
        <div class="row justify-content-center">
          <div class="col col-11">
            <div class="card mb-3 overflow-x-hidden border border-5 border-warning">
              <div class="row py-1 border-bottom border-1">
                <div class="col m-1 mx-2">
                <a href="./index.php?action=displayad&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="rounded-pill btn btn-outline-dark">Preview</a>
                </div>
                <div class="col text-end align-self-center mx-2">
                  <?php if($get_next_ad_record_result['ad_status'] == 'PENDING'):?>
                    <img class="img-fluid status-img-max-height" src="./images/pending_icon.svg" alt="PENDING">
                  <?php elseif($get_next_ad_record_result['ad_status'] == 'DECLINED'):?>
                    <img class="img-fluid status-img-max-height" src="./images/declined_icon.svg" alt="DECLINED">
                  <?php else:?>
                    <img class="img-fluid status-img-max-height" src="./images/verified_icon.svg" alt="VERIFIED">
                  <?php endif;?>
                </div>
              </div>
              <div class="row py-1 pe-2 border-bottom border-1 text-end">
                <div class="pb-1">
                  <span class="badge rounded-pill bg-warning text-dark">&nbsp;&nbsp;Top&nbsp;Ad&nbsp;&nbsp;</span>
                </div>
              </div>
              <div class="row g-0">
                <div class="col col-xl-2 col-lg-3 col-md-4 col-sm-5 col-12 overflow-x-hidden">
                <img src="<?php echo $get_next_ad_record_result['ad_image_path']?>" class="img-fluid rounded-start ad-img-size" alt="Ad Image">
                </div>
                <div class="col">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $get_next_ad_record_result['ad_title']?></h5>
                    <h6 class="card-subtitle text-muted"><?php echo get_category_name_from_id($get_next_ad_record_result['ad_category_id'])?>&nbsp;|&nbsp;<?php echo get_city_name_from_id($get_next_ad_record_result['ad_city_id'])?></h6>
                    <div class="row">
                      <div class="col col-12">
                        <hr>
                      </div>
                    </div>
                    <p class="card-text card-text-custom">
                      <?php echo $get_next_ad_record_result['ad_description']?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="row py-1 border-top border-1">
                <div class="col text-center">
                  <a href="tel:<?php echo get_phone_no_from_user_id($get_next_ad_record_result['ad_user_id'])?>" class="tel-link"><?php echo get_phone_no_from_user_id($get_next_ad_record_result['ad_user_id'])?></a>
                </div>
                <div class="col text-center fw-bold">
                  Rs&nbsp;<?php echo $get_next_ad_record_result['ad_price']?>
                </div>
                <div class="col text-center text-truncate">
                  <?php
                    $ad_date_created = new DateTime($get_next_ad_record_result['ad_created']);
                    $interval = get_time_diff($ad_date_created, $current_time_obj);
                    echo $interval . ' ago';
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col col-11">
            <div class="row gx-2 justify-content-end">
            <div class="col col-xl-1 col-md-2 col-sm-3 col-4">
            <div class="d-grid">
                  <a href="./index.php?action=updatead&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="btn btn-secondary">Update</a>
            </div>
            </div>
            <div class="col col-xl-1 col-md-2 col-sm-3 col-4">
              <div class="d-grid">
                <!-- Delete -->
                <a href="./index.php?action=deletead&adid=<?php echo $get_next_ad_record_result['ad_id']?>" class="btn btn-secondary">Delete</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
  <?php endif;?>
  <?php
  try {
    $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
  }
  catch(Exception $e) {
    //Error Handling
  }
  ?>
<?php endwhile;?>
<?php
  try {
    $get_next_ad_record_statement->closeCursor();
  }
  catch(Exception $e) {
    //Error handling
  }
?>
      </div>
    </div>