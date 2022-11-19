<?php
    function insert_new_ad($ad_category_id, $ad_title, $ad_description, $ad_image_path, $ad_price, $ad_status, $ad_city_id, $ad_created, $ad_last_modified, $ad_user_id, $ad_type_id, $ad_expired, $ad_expiration_offset) {
        global $db;
        $insert_ad_query = 'insert into ad_table (ad_category_id, ad_title, ad_description, ad_image_path, ad_price, ad_status, ad_city_id, ad_created, ad_last_modified, ad_user_id, ad_type_id, ad_expired, ad_expiration_offset) values (:ad_category_id, :ad_title, :ad_description, :ad_image_path, :ad_price, :ad_status, :ad_city_id, :ad_created, :ad_last_modified, :ad_user_id, :ad_type_id, :ad_expired, :ad_expiration_offset);';
        try {
            $insert_ad_statement = $db->prepare($insert_ad_query);
            $insert_ad_statement->bindValue(':ad_category_id', $ad_category_id);
            $insert_ad_statement->bindValue(':ad_title', $ad_title);
            $insert_ad_statement->bindValue(':ad_description', $ad_description);
            $insert_ad_statement->bindValue(':ad_image_path', $ad_image_path);
            $insert_ad_statement->bindValue(':ad_price', $ad_price);
            $insert_ad_statement->bindValue(':ad_status', $ad_status);
            $insert_ad_statement->bindValue(':ad_city_id', $ad_city_id);
            $insert_ad_statement->bindValue(':ad_created', $ad_created);
            $insert_ad_statement->bindValue(':ad_last_modified', $ad_last_modified);
            $insert_ad_statement->bindValue(':ad_user_id', $ad_user_id);
            $insert_ad_statement->bindValue(':ad_type_id', $ad_type_id);
            $insert_ad_statement->bindValue(':ad_expired', $ad_expired);
            $insert_ad_statement->bindValue(':ad_expiration_offset', $ad_expiration_offset);
            $insert_ad_statement->execute();
            $insert_ad_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling
            echo $e->getMessage();
        }
    }

    function get_next_ad_id() {
        global $db;
        $get_next_ad_id_query = 'select AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = \'gp_adsitedb\' AND TABLE_NAME = \'ad_table\';';
        try {
            $get_next_ad_id_statement = $db->prepare($get_next_ad_id_query);
            $get_next_ad_id_statement->execute();
            $get_next_ad_id_result = $get_next_ad_id_statement->fetch();
            $get_next_ad_id_statement->closeCursor();
            return $get_next_ad_id_result;
        }
        catch(Exception $e) {
            //Error Handling
        }
    }

    function get_ad_record($ad_id, $ad_user_id) {
        global $db;
        $get_ad_record_query = 'select * from ad_table where ad_id = :ad_id and ad_user_id = :ad_user_id;';
        try {
            $get_ad_record_statement = $db->prepare($get_ad_record_query);
            $get_ad_record_statement->bindValue(':ad_id', $ad_id);
            $get_ad_record_statement->bindValue(':ad_user_id', $ad_user_id);
            $get_ad_record_statement->execute();
            $get_ad_record_result = $get_ad_record_statement->fetch();
            $get_ad_record_statement->closeCursor();
            return $get_ad_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }
    function get_ad_status($ad_id) {
        global $db;
        $get_ad_status_query = 'select ad_status from ad_table where ad_id = :ad_id;';
        try {
            $get_ad_status_statement = $db->prepare($get_ad_status_query);
            $get_ad_status_statement->bindValue(':ad_id', $ad_id);
            $get_ad_status_statement->execute();
            $get_ad_status_result = $get_ad_status_statement->fetch();
            $get_ad_status_statement->closeCursor();
            return $get_ad_status_result['ad_status'];
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_expiration_date($ad_id) {
        global $db;
        $get_expiration_date_query = 'select ad_expired from ad_table where ad_id = :ad_id;';
        try {
            $get_expiration_date_statement = $db->prepare($get_expiration_date_query);
            $get_expiration_date_statement->bindValue(':ad_id', $ad_id);
            $get_expiration_date_statement->execute();
            $get_expiration_date_result = $get_expiration_date_statement->fetch();
            $get_expiration_date_statement->closeCursor();
            return $get_expiration_date_result['ad_expired']; 
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function update_ad($ad_id, $ad_user_id, $ad_category_id, $ad_title, $ad_description, $ad_image_path, $ad_price, $ad_status, $ad_city_id, $ad_last_modified, $ad_expiration_offset) {
        global $db;
        $update_ad_query = 'update ad_table set ad_category_id = :ad_category_id, ad_title = :ad_title, ad_description = :ad_description, ad_image_path = :ad_image_path, ad_price = :ad_price, ad_status = :ad_status, ad_city_id = :ad_city_id, ad_last_modified = :ad_last_modified, ad_expiration_offset = :ad_expiration_offset where ad_id = :ad_id and ad_user_id = :ad_user_id;';
        try {
            $update_ad_statement = $db->prepare($update_ad_query);
            $update_ad_statement->bindValue(':ad_id', $ad_id);
            $update_ad_statement->bindValue(':ad_user_id', $ad_user_id);
            $update_ad_statement->bindValue(':ad_category_id', $ad_category_id);
            $update_ad_statement->bindValue(':ad_title', $ad_title);
            $update_ad_statement->bindValue(':ad_description', $ad_description);
            $update_ad_statement->bindValue(':ad_image_path', $ad_image_path);
            $update_ad_statement->bindValue(':ad_price', $ad_price);
            $update_ad_statement->bindValue(':ad_status', $ad_status);
            $update_ad_statement->bindValue(':ad_city_id', $ad_city_id);
            $update_ad_statement->bindValue(':ad_last_modified', $ad_last_modified);
            $update_ad_statement->bindValue(':ad_expiration_offset', $ad_expiration_offset);
            $update_ad_statement->execute();
            $update_ad_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function update_ad_no_image($ad_id, $ad_user_id, $ad_category_id, $ad_title, $ad_description, $ad_price, $ad_status, $ad_city_id, $ad_last_modified, $ad_expiration_offset) {
        global $db;
        $update_ad_no_image_query = 'update ad_table set ad_category_id = :ad_category_id, ad_title = :ad_title, ad_description = :ad_description, ad_price = :ad_price, ad_status = :ad_status, ad_city_id = :ad_city_id, ad_last_modified = :ad_last_modified, ad_expiration_offset = :ad_expiration_offset where ad_id = :ad_id and ad_user_id = :ad_user_id;';
        try {
            $update_ad_no_image_statement = $db->prepare($update_ad_no_image_query);
            $update_ad_no_image_statement->bindValue(':ad_id', $ad_id);
            $update_ad_no_image_statement->bindValue(':ad_user_id', $ad_user_id);
            $update_ad_no_image_statement->bindValue(':ad_category_id', $ad_category_id);
            $update_ad_no_image_statement->bindValue(':ad_title', $ad_title);
            $update_ad_no_image_statement->bindValue(':ad_description', $ad_description);
            $update_ad_no_image_statement->bindValue(':ad_price', $ad_price);
            $update_ad_no_image_statement->bindValue(':ad_status', $ad_status);
            $update_ad_no_image_statement->bindValue(':ad_city_id', $ad_city_id);
            $update_ad_no_image_statement->bindValue(':ad_last_modified', $ad_last_modified);
            $update_ad_no_image_statement->bindValue(':ad_expiration_offset', $ad_expiration_offset);
            $update_ad_no_image_statement->execute();
            $update_ad_no_image_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function delete_ad_record($ad_id, $ad_user_id) {
        global $db;
        $delete_ad_record_query = 'delete from ad_table where ad_id = :ad_id and ad_user_id = :ad_user_id;';
        try {
            $delete_ad_record_statement = $db->prepare($delete_ad_record_query);
            $delete_ad_record_statement->bindValue(':ad_id', $ad_id);
            $delete_ad_record_statement->bindValue(':ad_user_id', $ad_user_id);
            $delete_ad_record_statement->execute();
            $delete_ad_record_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_ad_exp_offset($ad_id) {
        global $db;
        $get_ad_exp_offset_query = 'select ad_expiration_offset from ad_table where ad_id = :ad_id;';
        try {
            $get_ad_exp_offset_statement = $db->prepare($get_ad_exp_offset_query);
            $get_ad_exp_offset_statement->bindValue(':ad_id', $ad_id);
            $get_ad_exp_offset_statement->execute();
            $get_ad_exp_offset_result = $get_ad_exp_offset_statement->fetch();
            $get_ad_exp_offset_statement->closeCursor();
            return $get_ad_exp_offset_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }
    function get_ad_image_path($ad_id) {
        global $db;
        $get_ad_image_path_query = 'select ad_image_path from ad_table where ad_id = :ad_id;';
        try {
            $get_ad_image_path_statement = $db->prepare($get_ad_image_path_query);
            $get_ad_image_path_statement->bindValue(':ad_id', $ad_id);
            $get_ad_image_path_statement->execute();
            $get_ad_image_path_result = $get_ad_image_path_statement->fetch();
            $get_ad_image_path_statement->closeCursor();
            return $get_ad_image_path_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }
    function get_user_from_ad($ad_id) {
        global $db;
        $get_user_from_ad_query = 'select ad_user_id from ad_table where ad_id = :ad_id;';
        try {
            $get_user_from_ad_statement = $db->prepare($get_user_from_ad_query);
            $get_user_from_ad_statement->bindValue(':ad_id', $ad_id);
            $get_user_from_ad_statement->execute();
            $get_user_from_ad_result = $get_user_from_ad_statement->fetch();
            $get_user_from_ad_statement->closeCursor();
            return $get_user_from_ad_result;
        } 
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_user_from_norm_ad($ad_id) {
        global $db;
        $get_user_from_norm_ad_query = 'select ad_user_id from ad_table where ad_id = :ad_id and ad_type_id = 1;';
        try {
            $get_user_from_norm_ad_statement = $db->prepare($get_user_from_norm_ad_query);
            $get_user_from_norm_ad_statement->bindValue(':ad_id', $ad_id);
            $get_user_from_norm_ad_statement->execute();
            $get_user_from_norm_ad_result = $get_user_from_norm_ad_statement->fetch();
            $get_user_from_norm_ad_statement->closeCursor();
            return $get_user_from_norm_ad_result;
        } 
        catch(Exception $e) {
            //Error handling
        }
    }

    function update_to_top($ad_id, $ad_type_id, $ad_status, $ad_last_modified, $ad_user_id) {
        global $db;
        $update_to_top_ad_query = 'update ad_table set ad_type_id = :ad_type_id, ad_status = :ad_status, ad_last_modified = :ad_last_modified where ad_id = :ad_id and ad_user_id = :ad_user_id';
        try {
            $update_to_top_ad_statement = $db->prepare($update_to_top_ad_query);
            $update_to_top_ad_statement->bindValue(':ad_type_id', $ad_type_id);
            $update_to_top_ad_statement->bindValue(':ad_status', $ad_status);
            $update_to_top_ad_statement->bindValue(':ad_last_modified', $ad_last_modified);
            $update_to_top_ad_statement->bindValue(':ad_id', $ad_id);
            $update_to_top_ad_statement->bindValue(':ad_user_id', $ad_user_id);
            $update_to_top_ad_statement->execute();
            $update_to_top_ad_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_verified_ad_record($ad_id) {
        global $db;
        $get_ad_record_query = 'select * from ad_table where ad_id = :ad_id and ad_status = \'VERIFIED\';';
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
?>