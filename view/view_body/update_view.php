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
  <div class="col col-md-8 col-10">
    <?php if(!empty($error_message)):?>
          <div class="alert alert-danger mt-3">
              <?php echo $error_message?>
          </div>
    <?php endif?>
  </div>
</div>
<div class="row justify-content-center h-75 mt-4">
    <div class="col col-10">
        <!-- form -->
        <form class="border rounded border-dark p-4 mb-5" action="./index.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col align-self-center text-end">
              <input type="submit" class="rounded-pill btn btn-lg btn-dark" value="&nbsp;&nbsp;Update&nbsp;&nbsp;">
            </div>
          </div>
          <div class="row mb-4 mt-3">
            <div class="col">
              <div class="row">
                <div class="col col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                  <h3><?php echo $user_phone_no?></h3>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row mb-4">
            <div class="col col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
              <div class="row">
                <label class="col col-4 col-form-label fw-bold" for="adCategory">Category&nbsp;&ast;</label>
                <div class="col col-8">
                  <select class="form-select" id="adCategory" name="ad_category_id" required>
                    <option value="" selected disabled></option>
                    <?php foreach($all_category_records as $category_record):?>
                      <?php if($category_record['category_id'] == $ad_record['ad_category_id']):?>
                        <option value="<?php echo $category_record['category_id']?>" selected><?php echo $category_record['category_name']?></option>
                      <?php else:?>
                        <option value="<?php echo $category_record['category_id']?>"><?php echo $category_record['category_name']?></option>
                      <?php endif;?>
                    <?php endforeach;?>
                  </select>
              </div>  
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
              <div class="row">
                <label class="col col-4 col-form-label fw-bold" for="adCity">City&nbsp;&ast;</label>
                <div class="col col-8">
                  <select class="form-select" id="adCity" name="ad_city_id" required>
                    <option value="" selected disabled></option>
                    <?php foreach($all_city_records as $city_record):?>
                      <?php if($city_record['city_id'] == $ad_record['ad_city_id']):?>
                        <option value="<?php echo $city_record['city_id']?>" selected><?php echo $city_record['city_name']?></option>
                      <?php else:?>
                        <option value="<?php echo $city_record['city_id']?>"><?php echo $city_record['city_name']?></option>
                      <?php endif;?>
                    <?php endforeach;?>
                  </select>
              </div>  
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
              <div class="row">
                <label class="col col-4 col-form-label fw-bold" for="adPrice">Ad&nbsp;Price&nbsp;&ast;</label>
                <div class="col col-8">
                  <div class="input-group">
                    <span class="input-group-text">Rs</span>
                    <input type="number" id="adPrice" class="form-control text-end" name="ad_price" step="0.01" value="<?php echo $ad_record['ad_price']?>" min="0.00" max="9999999999999.99" required>
                  </div>
                </div>  
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col">
                <label for="adHeading" class="form-label fw-bold">Ad&nbsp;Title&nbsp;&ast;</label>
                <input type="text" class="form-control" id="adHeading" name="ad_heading" maxlength="250" placeholder="Ad Heading" value="<?php echo $ad_record['ad_title']?>" required>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col">
              <label for="formFile" class="form-label fw-bold">Update&nbsp;Ad&nbsp;Image&nbsp;<br><span class="text-secondary fw-normal fs-6">( .jpeg / .jpg / .png / .gif / .webp / .bmp )</span></label>
              <input class="form-control" type="file" id="formFile" name="ad_image">
            </div>
          </div>

          <div class="row mb-4">
            <div class="col">
              <label for="adDescription" class="form-label fw-bold">Ad&nbsp;Description</label>
              <textarea class="form-control ad-description-height" placeholder="Ad Description" id="adDescription" name="ad_description" style="height: 20rem;"><?php echo $ad_record['ad_description']?></textarea>
            </div>
          </div>
          <input type="hidden" name="ad_id" value="<?php echo $ad_record['ad_id']?>">
          <input type="hidden" name="ad_type_id" value="<?php echo $ad_record['ad_type_id']?>">
          <input type="hidden" name="action" value="updateadrecord">
        </form>
    </div>
</div>
</div>