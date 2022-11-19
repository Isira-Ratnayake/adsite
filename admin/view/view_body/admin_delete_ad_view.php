<?php
$current_time_obj  = new DateTime();
  $expired_ad_array = array();
  $declined_ad_array = array();
  $get_next_ad_record_query = 'select ad_id, ad_user_id, ad_title, ad_created, ad_status, ad_last_modified from ad_table order by ad_created desc;';
  $get_next_ad_record_statement;
  $get_next_ad_record_result = null;
  try {
      $get_next_ad_record_statement = $db->prepare($get_next_ad_record_query);
      $get_next_ad_record_statement->execute();
      $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
      while($get_next_ad_record_result != null) {
        //Check if ad is 30 days old
        $ad_created_str = $get_next_ad_record_result['ad_created'];
        $ad_created_obj = new DateTime($ad_created_str);
        $interval = date_diff($ad_created_obj, $current_time_obj);
        $months = $interval->format('%m');
        $days = $interval->format('%d');
        if($days >= 30 || $months > 0) {
            $expired_ad_array[] = $get_next_ad_record_result;
        }
        //Check if ad is declined    
        if($get_next_ad_record_result['ad_status'] == 'DECLINED') {
            $declined_ad_array[] = $get_next_ad_record_result;
        }    
        $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
      }
      $get_next_ad_record_statement->closeCursor();
  }
  catch(Exception $e) {
    //Error handling
    echo $e->getMessage();
  }
?>
<ul class="nav pt-2 px-2 justify-content-end">
        <li class="nav-item">
          <a class="rounded-pill btn btn-outline-dark" href="index.php?action=logout">&nbsp;&nbsp;Log-Out&nbsp;&nbsp;</a>
        </li>
    </ul>

    <div class="container-fluid main-body">
        <h1 class="ms-5">Delete&nbsp;Expired&nbsp;Ads</h1>
        <div class="row justify-content-center">
          <div class="col col-11">
            <hr>
          </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-11">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Ad ID</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Ad Title</th>
                            <th scope="col">Time Created</th>
                            <th scope="col" class="text-center">Delete Ad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($expired_ad_array as $expired_ad):?>
                        <tr>
                            <th scope="row"><?php echo $expired_ad['ad_id']?></th>
                            <td><?php echo get_phone_no_from_user_id($expired_ad['ad_user_id'])?></td>
                            <td class="text-nowrap"><?php echo $expired_ad['ad_title']?></td>
                            <td class="text-nowrap"><?php echo $expired_ad['ad_created']?></td>
                            <td class="px-2">
                                <form action="./index.php" method="POST">
                                    <div class="d-grid">
                                        <input type="hidden" name="action" value="deleteadrecord">
                                        <input type="hidden" name="adId" value="<?php echo $expired_ad['ad_id']?>">
                                        <input type="submit" class="btn btn-danger rounded-pill" value="&nbsp;&nbsp;Delete&nbsp;&nbsp;">
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                  </div>

            </div>
        </div>
        <div class="my-4"></div>
        <h1 class="ms-5">Delete&nbsp;Declined&nbsp;Ads</h1>
        <div class="row justify-content-center">
          <div class="col col-11">
            <hr>
          </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-11">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Ad ID</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Ad Title</th>
                            <th scope="col">Time Created</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col" class="text-center">Delete Ad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($declined_ad_array as $declined_ad):?>
                        <tr>
                            <th scope="row"><?php echo $declined_ad['ad_id']?></th>
                            <td><?php echo get_phone_no_from_user_id($declined_ad['ad_user_id'])?></td>
                            <td class="text-nowrap"><?php echo $declined_ad['ad_title']?></td>
                            <td class="text-nowrap"><?php echo $declined_ad['ad_created']?></td>
                            <td class="text-nowrap"><?php echo $declined_ad['ad_last_modified']?></td>
                            <td class="px-2">
                                <form action="./index.php" method="POST">
                                    <div class="d-grid">
                                        <input type="hidden" name="action" value="restoread">
                                        <input type="hidden" name="adId" value="<?php echo $declined_ad['ad_id']?>">
                                        <input type="submit" class="btn btn-secondary rounded-pill" value="&nbsp;&nbsp;Restore&nbsp;&nbsp;">
                                    </div>
                                </form>
                                <div class="my-2"></div>
                                <form action="./index.php" method="POST">
                                    <div class="d-grid">
                                        <input type="hidden" name="action" value="deleteadrecord">
                                        <input type="hidden" name="adId" value="<?php echo $declined_ad['ad_id']?>">
                                        <input type="submit" class="btn btn-danger rounded-pill" value="&nbsp;&nbsp;Delete&nbsp;&nbsp;">
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                  </div>

            </div>
        </div>
      </div>
