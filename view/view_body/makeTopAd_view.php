<ul class="nav pt-2 px-2 justify-content-end">
      <li class="nav-item px-2">
        <a class="rounded-pill btn btn-dark" href="./index.php?action=dashboard">&nbsp;&nbsp;&nbsp;My&nbsp;Ads&nbsp;&nbsp;&nbsp;</a>
      </li>
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
      <div class="row justify-content-center">
          <div class="col col-11">
            <div class="row my-3 justify-content-center">
                <div class="col col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
                    <div class="row justify-content-center">
                        <div class="col-11 my-3">
                          <div class="card border border-4 border-warning">
                              <div class="card-body">
                              <?php
                                  $type_valid_days = $all_type_records[1]['type_valid_days'];
                                  if($type_valid_days == 1) {
                                    $type_valid_days .= '&nbsp;Day';
                                  }
                                  else {
                                    $type_valid_days .= '&nbsp;Days';
                                  } 
                                ?>
                                <h5 class="card-title text-truncate">Make&nbsp;a&nbsp;Top&nbsp;Ad&nbsp;(<?php echo $type_valid_days?>)</h5>
                              </div>
                              <img src="./images/default-placeholder.png" class="card-img-top" alt="">
                              <div class="card-body">
                                <p class="lead">
                                    <strong class="fw-bold">Price: Rs.<?php echo get_payment_type_price(4)['payment_type_price']?></strong><br>
                                </p>
                                <form action="./index.php" method="POST">
                                    <div class="d-grid gap-2">
                                        <input type="hidden" name="action" value="maketopad">
                                        <input type="hidden" name="ad_id" value="<?php echo $ad_id?>">
                                        <input type="hidden" name="ad_type_id" value="<?php echo $all_type_records[1]['type_id']?>">
                                        <input type="submit" class="rounded-pill btn btn-warning btn-lg" value="Make&nbsp;Top&nbsp;Ad">
                                    </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
                    <div class="row justify-content-center">
                        <div class="col-11 my-3">
                          <div class="card border border-4 border-warning">
                              <div class="card-body">
                              <?php
                                  $type_valid_days = $all_type_records[2]['type_valid_days'];
                                  if($type_valid_days == 1) {
                                    $type_valid_days .= '&nbsp;Day';
                                  }
                                  else {
                                    $type_valid_days .= '&nbsp;Days';
                                  } 
                                ?>
                                <h5 class="card-title text-truncate">Make&nbsp;a&nbsp;Top&nbsp;Ad&nbsp;(<?php echo $type_valid_days?>)</h5>
                              </div>
                              <img src="./images/default-placeholder.png" class="card-img-top" alt="">
                              <div class="card-body">
                                <p class="lead">
                                    <strong class="fw-bold">Price: Rs.<?php echo get_payment_type_price(5)['payment_type_price']?></strong><br>
                                </p>
                                <form action="./index.php" method="POST">
                                    <div class="d-grid gap-2">
                                    <input type="hidden" name="action" value="maketopad">
                                        <input type="hidden" name="ad_id" value="<?php echo $ad_id?>">
                                        <input type="hidden" name="ad_type_id" value="<?php echo $all_type_records[2]['type_id']?>">
                                        <input type="submit" class="rounded-pill btn btn-warning btn-lg" value="Make&nbsp;Top&nbsp;Ad">
                                    </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>