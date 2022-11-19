<?php
    function get_admin_record($username) {
        global $db;
        $get_admin_record_query = 'select * from admin_table where admin_username = :username;';
        try {
            $get_admin_record_statement = $db->prepare($get_admin_record_query);
            $get_admin_record_statement->bindValue(':username', $username);
            $get_admin_record_statement->execute();
            $get_admin_record_result = $get_admin_record_statement->fetch();
            $get_admin_record_statement->closeCursor();
            return $get_admin_record_result;
        }
        catch(Exception $e) {
            //Error Handling
        }
    }
?>