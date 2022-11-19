<?php
  $current_time_obj = new DateTime();
  $current_time_str = $current_time_obj->format('Y-m-d H:i:s');

  $get_next_ad_record_query = 'select ad_id, ad_user_id, ad_title, ad_expired from ad_table where ad_status = \'VERIFIED\' and (ad_type_id = 2 or ad_type_id = 3) and ad_expired <= :current_time_str order by ad_last_modified desc;';
  $get_next_ad_record_statement;
  $get_next_ad_record_result = null;
  try {
      $get_next_ad_record_statement = $db->prepare($get_next_ad_record_query);
      $get_next_ad_record_statement->bindValue(':current_time_str', $current_time_str);
      $get_next_ad_record_statement->execute();
      $get_next_ad_record_result = $get_next_ad_record_statement->fetch();
  }
  catch(Exception $e) {
      //Error handling
      echo $e->getMessage();
  }
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
                            <th scope="col">Expiration Time</th>
                            <th scope="col" class="text-center">Expire Top Ad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($get_next_ad_record_result != null):?>   
                        <tr>
                            <th scope="row"><?php echo $get_next_ad_record_result['ad_id']?></th>
                            <td><?php echo get_phone_no_from_user_id($get_next_ad_record_result['ad_user_id'])?></td>
                            <td class="text-nowrap"><?php echo $get_next_ad_record_result['ad_title']?></td>
                            <td class="text-nowrap"><?php echo $get_next_ad_record_result['ad_expired']?></td>
                            <td class="px-2">
                                <form action="./index.php" method="POST">
                                    <div class="d-grid">
                                        <input type="hidden" name="adId" value="<?php echo $get_next_ad_record_result['ad_id']?>">
                                        <input type="hidden" name="action" value="expireTopAd">
                                        <input type="submit" class="btn btn-danger rounded-pill" value="&nbsp;&nbsp;Expire&nbsp;&nbsp;">
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