<?php
  $get_next_ad_record_query = 'select ad_id, ad_user_id, ad_title, ad_type_id, ad_created, ad_last_modified from ad_table where ad_status = \'PENDING\' order by ad_last_modified desc;';
  $get_next_ad_record_statement;
  $get_next_ad_record_result = null;
  try {
      $get_next_ad_record_statement = $db->prepare($get_next_ad_record_query);
      $get_next_ad_record_statement->execute();
      $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
  }
  catch(Exception $e) {
      //Error handling
      echo $e->getMessage();
  }
  $all_type_records = get_all_type_records();
?>
<ul class="nav pt-2 px-2 justify-content-end">
        <li class="nav-item">
          <a class="rounded-pill btn btn-outline-dark" href="./index.php?action=logout">&nbsp;&nbsp;Log-Out&nbsp;&nbsp;</a>
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
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Ad ID</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Ad Title</th>
                            <th scope="col">Ad Type</th>
                            <th scope="col">Time Created</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col" class="text-center">Verification</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php while($get_next_ad_record_result != null):?>
                        <tr>
                            <th scope="row"><?php echo $get_next_ad_record_result['ad_id']?></th>
                            <td><?php echo get_phone_no_from_user_id($get_next_ad_record_result['ad_user_id'])?></td>
                            <td class="text-nowrap"><?php echo $get_next_ad_record_result['ad_title']?></td>
                            <?php
                                $ad_type_id = $get_next_ad_record_result['ad_type_id'];
                                $ad_type = '';
                                switch($ad_type_id) {
                                    case 1:
                                        $ad_type = 'Normal Ad';
                                        break;
                                    case 2:
                                        $ad_type = 'Top Ad (' . $all_type_records[1]['type_valid_days'] .  ' day)';
                                        break;
                                    case 3:
                                        $ad_type = 'Top Ad (' . $all_type_records[2]['type_valid_days'] . ' days)';
                                        break;
                                }
                            ?>
                            <td class="text-nowrap"><?php echo $ad_type?></td>
                            <td class="text-nowrap"><?php echo $get_next_ad_record_result['ad_created']?></td>
                            <td class="text-nowrap"><?php echo $get_next_ad_record_result['ad_last_modified']?></td>
                            <td class="px-2">
                                <div class="d-grid">
                                    <a href="./index.php?action=adminDisplayAd&adId=<?php echo $get_next_ad_record_result['ad_id']?>" class="btn btn-dark rounded-pill">View&nbsp;Ad</a>
                                </div>
                                <div class="my-2"></div>
                                <form action="./index.php" method="POST">
                                    <div class="d-grid">
                                        <input type="hidden" name="action" value="verifyAd">
                                        <input type="hidden" name="adId" value="<?php echo $get_next_ad_record_result['ad_id']?>">
                                        <input type="submit" class="btn btn-success rounded-pill" value="&nbsp;Verify&nbsp;">
                                    </div>
                                </form>
                                <div class="my-2"></div>
                                <form action="./index.php" method="POST">
                                    <div class="d-grid">
                                        <input type="hidden" name="action" value="declineAd">
                                        <input type="hidden" name="adId" value="<?php echo $get_next_ad_record_result['ad_id']?>">
                                        <input type="submit" class="btn btn-danger rounded-pill" value="Decline">
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php
                            $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
                        ?>
                        <?php endwhile?>
                        <?php
                            $get_next_ad_record_statement->closeCursor();
                        ?>
                        </tbody>
                    </table>
                  </div>

            </div>
        </div>
      </div>