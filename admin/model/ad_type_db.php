<?php
    function get_type_record($type_id) {
        global $db;
        $get_type_record_query = 'select * from type_table where type_id = :type_id;';
        try {
            $get_type_record_statement = $db->prepare($get_type_record_query);
            $get_type_record_statement->bindValue(':type_id', $type_id);
            $get_type_record_statement->execute();
            $get_type_record_result = $get_type_record_statement->fetch();
            $get_type_record_statement->closeCursor();
            return $get_type_record_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }
?>