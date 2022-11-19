<?php
    function get_pending_ad_record($ad_id) {
        global $db;
        $get_ad_record_query = 'select * from ad_table where ad_id = :ad_id and ad_status = \'PENDING\';';
        try {
            $get_ad_record_statement = $db->prepare($get_ad_record_query);
            $get_ad_record_statement->bindValue(':ad_id', $ad_id);
            $get_ad_record_statement->execute();
            $get_ad_record_result = $get_ad_record_statement->fetch();
            $get_ad_record_statement->closeCursor();
            return $get_ad_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_verified_top_ad_created($ad_id) {
        global $db;
        $get_ad_record_query = 'select ad_created from ad_table where ad_id = :ad_id and ad_status = \'VERIFIED\' and (ad_type_id = 2 or ad_type_id = 3);';
        try {
            $get_ad_record_statement = $db->prepare($get_ad_record_query);
            $get_ad_record_statement->bindValue(':ad_id', $ad_id);
            $get_ad_record_statement->execute();
            $get_ad_record_result = $get_ad_record_statement->fetch();
            $get_ad_record_statement->closeCursor();
            return $get_ad_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_verification_ad_record($ad_id) {
        global $db;
        $get_ad_record_query = 'select ad_status, ad_last_modified, ad_type_id, ad_expired, ad_expiration_offset  from ad_table where ad_id = :ad_id and ad_status = \'PENDING\';';
        try {
            $get_ad_record_statement = $db->prepare($get_ad_record_query);
            $get_ad_record_statement->bindValue(':ad_id', $ad_id);
            $get_ad_record_statement->execute();
            $get_ad_record_result = $get_ad_record_statement->fetch();
            $get_ad_record_statement->closeCursor();
            return $get_ad_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_restoration_ad_record($ad_id) {
        global $db;
        $get_ad_record_query = 'select ad_status, ad_last_modified, ad_type_id, ad_expired, ad_expiration_offset  from ad_table where ad_id = :ad_id and ad_status = \'DECLINED\';';
        try {
            $get_ad_record_statement = $db->prepare($get_ad_record_query);
            $get_ad_record_statement->bindValue(':ad_id', $ad_id);
            $get_ad_record_statement->execute();
            $get_ad_record_result = $get_ad_record_statement->fetch();
            $get_ad_record_statement->closeCursor();
            return $get_ad_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function update_ad_status($ad_status, $ad_id) {
        global $db;
        $update_ad_status_query = 'update ad_table set ad_status = :ad_status where ad_id = :ad_id;';
        try {
            $update_ad_status_statement = $db->prepare($update_ad_status_query);
            $update_ad_status_statement->bindValue(':ad_status', $ad_status);
            $update_ad_status_statement->bindValue(':ad_id', $ad_id);
            $update_ad_status_statement->execute();
            $update_ad_status_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling

        }
    }

    function update_ad_status_expiration_date($ad_status, $ad_expired, $ad_id) {
        global $db;
        $update_ad_status_query = 'update ad_table set ad_status = :ad_status, ad_expired = :ad_expired where ad_id = :ad_id;';
        try {
            $update_ad_status_statement = $db->prepare($update_ad_status_query);
            $update_ad_status_statement->bindValue(':ad_status', $ad_status);
            $update_ad_status_statement->bindValue(':ad_expired', $ad_expired);
            $update_ad_status_statement->bindValue(':ad_id', $ad_id);
            $update_ad_status_statement->execute();
            $update_ad_status_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling

        }
    }

    function update_ad_status_expiration_date_offset($ad_status, $ad_expired, $ad_expiration_offset, $ad_id) {
        global $db;
        $update_ad_status_query = 'update ad_table set ad_status = :ad_status, ad_expired = :ad_expired, ad_expiration_offset = :ad_expiration_offset  where ad_id = :ad_id;';
        try {
            $update_ad_status_statement = $db->prepare($update_ad_status_query);
            $update_ad_status_statement->bindValue(':ad_status', $ad_status);
            $update_ad_status_statement->bindValue(':ad_expired', $ad_expired);
            $update_ad_status_statement->bindValue(':ad_expiration_offset', $ad_expiration_offset);
            $update_ad_status_statement->bindValue(':ad_id', $ad_id);
            $update_ad_status_statement->execute();
            $update_ad_status_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling

        }
    }

    function update_to_normal($ad_type_id, $ad_expired, $ad_id) {
        global $db;
        $update_ad_status_query = 'update ad_table set ad_type_id = :ad_type_id, ad_expired = :ad_expired where ad_id = :ad_id;';
        try {
            $update_ad_status_statement = $db->prepare($update_ad_status_query);
            $update_ad_status_statement->bindValue(':ad_expired', $ad_expired);
            $update_ad_status_statement->bindValue(':ad_type_id', $ad_type_id);
            $update_ad_status_statement->bindValue(':ad_id', $ad_id);
            $update_ad_status_statement->execute();
            $update_ad_status_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling

        }
    }

    function delete_ad_record_admin($ad_id) {
        global $db;
        $query = 'delete from ad_table where ad_id = :ad_id;';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':ad_id', $ad_id);
            $statement->execute();
            $statement->closeCursor();
        }
        catch(Exception $e) {
            //Handle errors
        }
    }

    function get_delete_ad_record_admin($ad_id) {
        global $db;
        $get_ad_record_query = 'select ad_id, ad_user_id, ad_image_path from ad_table where ad_id = :ad_id;';
        try {
            $get_ad_record_statement = $db->prepare($get_ad_record_query);
            $get_ad_record_statement->bindValue(':ad_id', $ad_id);
            $get_ad_record_statement->execute();
            $get_ad_record_result = $get_ad_record_statement->fetch();
            $get_ad_record_statement->closeCursor();
            return $get_ad_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function update_date_modified($ad_id) {
        $current_time_obj = new DateTime();
        $current_time_str = $current_time_obj->format('Y-m-d H:i:s');
        global $db;
        $query = 'update ad_table set ad_last_modified = :last_modified where ad_id = :ad_id;';
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':ad_id', $ad_id);
            $statement->bindValue(':last_modified', $current_time_str);
            $statement->execute();
            $statement->closeCursor();
        }
        catch(Exception $e) {
            //Error Handling
        }
    }
?>