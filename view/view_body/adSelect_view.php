<ul class="nav pt-2 px-2 mb-3 justify-content-end">
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
            <div class="row justify-content-center">
              <div class="col col-md-8 col-10">
                <?php if(!empty($error_message)):?>
                      <div class="alert alert-danger mt-3">
                          <?php echo $error_message?>
                      </div>
                <?php endif?>
              </div>
            </div>
              <div class="row my-3">
                  <div class="col col-lg-4 col-sm-6 col-12">
                      <div class="row justify-content-center">
                          <div class="col-11 my-3">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title text-truncate">Post&nbsp;a&nbsp;Normal&nbsp;Ad</h5>
                                </div>
                                <img src="./images/default-placeholder.png" class="card-img-top" alt="">
                                <div class="card-body">
                                  <p class="lead">
                                      <strong class="fw-bold">Price: Rs.<?php echo get_payment_type_price(1)['payment_type_price']?></strong><br>
                                  </p>
                                  <div class="d-grid gap-2">
                                    <a href="./index.php?action=newad&adType=<?php echo $all_type_records[0]['type_name']?>" class="rounded-pill btn btn-outline-dark btn-lg">&nbsp;&nbsp;Post&nbsp;Normal&nbsp;Ad&nbsp;&nbsp;</a>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col col-lg-4 col-sm-6 col-12">
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
                                <h5 class="card-title text-truncate">Post&nbsp;a&nbsp;Top&nbsp;Ad&nbsp;-&nbsp;<?php echo $type_valid_days?></h5>
                              </div>
                              <img src="./images/default-placeholder.png" class="card-img-top" alt="">
                              <div class="card-body">
                                <p class="lead">
                                    <strong class="fw-bold">Price: Rs.<?php echo get_payment_type_price(2)['payment_type_price']?></strong><br>
                                </p>
                                <div class="d-grid gap-2">
                                  <a href="./index.php?action=newad&adType=<?php echo $all_type_records[1]['type_name']?>" class="rounded-pill btn btn-warning btn-lg">&nbsp;&nbsp;Post&nbsp;Top&nbsp;Ad&nbsp;&nbsp;</a>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 col-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 col-sm-6 col-11 my-3">
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
                                <h5 class="card-title text-truncate">Post&nbsp;a&nbsp;Top&nbsp;Ad&nbsp;-&nbsp;<?php echo $type_valid_days?></h5>
                              </div>
                              <img src="./images/default-placeholder.png" class="card-img-top" alt="">
                              <div class="card-body">
                                <p class="lead">
                                    <strong class="fw-bold">Price: Rs.<?php echo get_payment_type_price(3)['payment_type_price']?></strong><br>
                                </p>
                                <div class="d-grid gap-2">
                                  <a href="./index.php?action=newad&adType=<?php echo $all_type_records[2]['type_name']?>" class="rounded-pill btn btn-warning btn-lg">&nbsp;&nbsp;Post&nbsp;Top&nbsp;Ad&nbsp;&nbsp;</a>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>