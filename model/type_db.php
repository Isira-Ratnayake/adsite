<?php
    function get_all_type_records() {
        global $db;
        $get_all_type_records_query = 'select * from type_table order by type_id;';
        try {
            $get_all_type_records_statement = $db->prepare($get_all_type_records_query);
            $get_all_type_records_statement->execute();
            $get_all_type_records_result = $get_all_type_records_statement->fetchAll();
            $get_all_type_records_statement->closeCursor();
            return $get_all_type_records_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_type_id_from_name($type_name) {
        global $db;
        $get_type_id_from_name_query = 'select type_id from type_table where type_name = :type_name;';
        try {
            $get_type_id_from_name_statement = $db->prepare($get_type_id_from_name_query);
            $get_type_id_from_name_statement->bindValue(':type_name', $type_name);
            $get_type_id_from_name_statement->execute();
            $get_type_id_from_name_result = $get_type_id_from_name_statement->fetch();
            $get_type_id_from_name_statement->closeCursor();
            return $get_type_id_from_name_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }
?>