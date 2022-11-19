<?php
    $cat_table = get_all_category_records();
?>
<div class="container-fluid main-body">
      <div class="row justify-content-center ribbon-height">
          <div class="col col-lg-3 col-bg-color col-12">
            
            <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasResponsiveLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body mt-lg-2">

                <div class="list-group list-group-flush text-center list-width">
                <?php if($cat_id == -1):?>
                  <a href="./index.php?action=home&cat=-1" class="list-group-item list-group-item-action active bg-dark" aria-current="true">
                    All Categories
                  </a>
                <?php else:?>
                    <a href="./index.php?action=home&cat=-1" class="list-group-item list-group-item-action">
                    All Categories
                  </a>
                <?php endif?>
                <?php foreach($cat_table as $cat_record):?>
                    <?php if($cat_id == $cat_record['category_id']):?>
                        <a href="./index.php?action=home&cat=<?php echo $cat_record['category_id']?>" class="list-group-item list-group-item-action active bg-dark" aria-current="true"><?php echo $cat_record['category_name']?></a>
                    <?php else:?>
                        <a href="./index.php?action=home&cat=<?php echo $cat_record['category_id']?>" class="list-group-item list-group-item-action"><?php echo $cat_record['category_name']?></a>
                    <?php endif?>
                <?php endforeach?>
                </div>
            </div>
            </div>
          </div>
          <div class="col col-lg-9 col-12">
            <div class="row">
              <div class="col">
                <button class="btn btn-lg rounded-circle btn-dark d-lg-none mt-2 button-bg-img" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">&nbsp;&nbsp;&nbsp;</button>
              </div>
              <div class="col text-end align-self-center">
                <a href="./index.php?action=adtype" class="btn btn-dark mt-2" >&nbsp;&nbsp;Post&nbsp;an&nbsp;Ad&nbsp;&nbsp;</a>
              </div>
            </div>
            <!-- Ads -->
            <div class="row">
              <div class="col mt-3">
                <?php foreach($top_ad_array as $top_ad_record):?>
                <div class="card mb-3 overflow-x-hidden border border-5 border-warning">
                  <div class="row py-1 pe-2 border-bottom border-1 text-end">
                    <div class="pb-1">
                      <span><a href="./index.php?action=viewAd&adid=<?php echo $top_ad_record['ad_id']?>" class="stretched-link hide-link">Go to Ad</a></span>
                      <span class="badge rounded-pill bg-warning text-dark">&nbsp;&nbsp;Top&nbsp;Ad&nbsp;&nbsp;</span>
                    </div>
                  </div>
                  <div class="row g-0">
                    <div class="col col-xl-2 col-lg-3 col-md-4 col-sm-5 col-12 overflow-x-hidden">
                      <img src="<?php echo $top_ad_record['ad_image_path']?>" class="img-fluid rounded-start ad-img-size" alt="Ad Image">
                    </div>
                    <div class="col">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $top_ad_record['ad_title']?></h5>
                          <h6 class="card-subtitle text-muted"><?php echo get_category_name_from_id($top_ad_record['ad_category_id'])?>&nbsp;|&nbsp;<?php echo get_city_name_from_id($top_ad_record['ad_city_id'])?></h6>
                        <div class="row">
                          <div class="col col-12">
                            <hr>
                          </div>
                        </div>
                        <p class="card-text card-text-custom">
                          <?php echo $top_ad_record['ad_description']?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="row py-1 border-top border-1">
                    <div class="col text-center">
                    <a href="tel:<?php echo get_phone_no_from_user_id($top_ad_record['ad_user_id'])?>" class="tel-link"><?php echo get_phone_no_from_user_id($top_ad_record['ad_user_id'])?></a>
                    </div>
                    <div class="col text-center fw-bold">
                      Rs&nbsp;<?php echo $top_ad_record['ad_price']?>
                    </div>
                    <div class="col text-center text-truncate">
                        <?php
                            $ad_date_created = new DateTime($top_ad_record['ad_created']);
                            $interval = get_time_diff($ad_date_created, $current_time_obj);
                            echo $interval . ' ago';
                        ?>
                    </div>
                  </div>
                </div>
                <?php endforeach?>
                <?php foreach($normal_ad_array as $normal_ad_record):?>    
                <div class="card border-dark mb-3 overflow-x-hidden">
                  <div class="row py-1 pe-2 border-bottom text-end">
                    <div class="my-1 height-fix"><span><a href="./index.php?action=viewAd&adid=<?php echo $normal_ad_record['ad_id']?>" class="stretched-link hide-link" >Go to Ad</a></span></div>
                  </div>
                  <div class="row g-0">
                    <div class="col col-xl-2 col-lg-3 col-md-4 col-sm-5 col-12 overflow-x-hidden">
                      <img src="<?php echo $normal_ad_record['ad_image_path']?>" class="img-fluid rounded-start ad-img-size" alt="Ad Image">
                    </div>
                    <div class="col">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $normal_ad_record['ad_title']?></h5>
                          <h6 class="card-subtitle text-muted"><?php echo get_category_name_from_id($normal_ad_record['ad_category_id'])?>&nbsp;|&nbsp;<?php echo get_city_name_from_id($normal_ad_record['ad_city_id'])?></h6>
                        <div class="row">
                          <div class="col col-12">
                            <hr>
                          </div>
                        </div>
                        <p class="card-text card-text-custom">
                          <?php echo $normal_ad_record['ad_description']?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="row py-1 border-top">
                    <div class="col text-center">
                    <a href="tel:<?php echo get_phone_no_from_user_id($normal_ad_record['ad_user_id'])?>" class="tel-link"><?php echo get_phone_no_from_user_id($normal_ad_record['ad_user_id'])?></a>
                    </div>
                    <div class="col text-center fw-bold">
                      Rs&nbsp;<?php echo $normal_ad_record['ad_price']?>
                    </div>
                    <div class="col text-center text-truncate">
                        <?php
                            $ad_date_created = new DateTime($normal_ad_record['ad_created']);
                            $interval = get_time_diff($ad_date_created, $current_time_obj);
                            echo $interval . ' ago';
                        ?>
                    </div>
                  </div>
                </div>
                <?php endforeach?>
              </div>
            </div>
          </div>
      </div>
    </div>