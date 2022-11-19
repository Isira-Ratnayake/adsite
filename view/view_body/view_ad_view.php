    <div class="container-fluid">
    <div class="row">
        <div class="col text-end align-self-center">
          <a href="./index.php?action=home" class="btn btn-outline-dark mt-2" >&nbsp;&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;
          <a href="./index.php?action=adtype" class="btn btn-dark mt-2" >&nbsp;&nbsp;Post&nbsp;an&nbsp;Ad&nbsp;&nbsp;</a>
        </div>
    </div>
    </div>
    <div class="container-fluid main-body">
        <div class="row justify-content-center my-5">
          <div class="my-3"></div>
            <div class="col col-md-10 col-12">
                <div class="card border-dark mb-3">
                    <div class="row g-0">
                        <div class="col-md-6">
                        <img src="<?php echo $ad_record['ad_image_path']?>" class="ad-img-size rounded-start" alt="Ad Image">
                        </div>
                        <div class="col-md-6">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $ad_record['ad_title']?></h3>
                            <h6 class="card-subtitle text-muted"><?php echo $ad_category_name?>&nbsp;|&nbsp;<?php echo $ad_city_name?>&nbsp;|&nbsp;<span class="created-date"><?php echo $interval?></span></h6>
                            <div class="row">
                              <div class="col col-12">
                                <hr>
                              </div>
                            </div>
                            <h4 class="card-subtitle mt-1"><a href="tel:<?php echo $user_phone_no?>" class="tel-style"><?php echo $user_phone_no?></a></h4>
                            <div class="row my-1">
                              <div class="col col-12 d-grid">
                                <a href="https://wa.me/94<?php echo $user_phone_no?>?lang=en" target="_blank" class="rounded-pill btn btn-lg btn-outline-success">Chat on WhatsApp</a>
                              </div>
                            </div>
                            <h4 class="mt-3">Rs.<?php echo $ad_record['ad_price']?></h4>
                            <p class="card-text">
                              <?php
                                echo nl2br($ad_record['ad_description']);
                              ?>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>