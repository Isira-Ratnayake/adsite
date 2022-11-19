<?php
    function check_user_exist($phone_number) {
        global $db;
        $user_check_query = 'select user_id from user_table where user_phone_no = :phone_number;';
        try {
            $user_check_statement = $db->prepare($user_check_query);
            $user_check_statement->bindValue(':phone_number', $phone_number);
            $user_check_statement->execute();
            $user_check_result = $user_check_statement->fetch();
            $user_check_statement->closeCursor();
            if($user_check_result != NULL) {
                return true;
            }
            return false;
        }
        catch(Exception $e) {
            //Error Handling
            echo $e->getMessage();
        }
    }

    function insert_user($user_phone_number) {
        global $db;
        $insert_user_query = 'insert into user_table (user_phone_no) values (:user_phone_number);';

        try {
            $insert_user_statement = $db->prepare($insert_user_query);
            $insert_user_statement->bindValue(':user_phone_number', $user_phone_number);
            $insert_user_statement->execute();
            $insert_user_statement->closeCursor();
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_user_id_from_phone_no($user_phone_number) {
        global $db;
        $get_user_id_query = 'select user_id from user_table where user_phone_no = :user_phone_number;';
        try {
            $get_user_id_statement = $db->prepare($get_user_id_query);
            $get_user_id_statement->bindValue(':user_phone_number', $user_phone_number);
            $get_user_id_statement->execute();
            $get_user_id_result = $get_user_id_statement->fetch();
            $get_user_id_statement->closeCursor();
            return $get_user_id_result['user_id'];
        }
        catch(Exception $e) {
            //Error handling
        }

    }

    function get_phone_no_from_user_id($user_id) {
        global $db;
        $get_phone_no_query = 'select user_phone_no from user_table where user_id = :user_id;';
        try {
            $get_phone_no_statement = $db->prepare($get_phone_no_query);
            $get_phone_no_statement->bindValue(':user_id', $user_id);
            $get_phone_no_statement->execute();
            $get_phone_no_result = $get_phone_no_statement->fetch();
            $get_phone_no_statement->closeCursor();
            return $get_phone_no_result['user_phone_no'];
        }
        catch(Exception $e) {
            //Error Handling
        }
    }
?>