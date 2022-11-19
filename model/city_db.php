<?php
    function get_all_city_records() {
        global $db;
        $get_all_city_records_query = 'select * from city_table order by city_name asc;';
        try {
            $get_all_city_records_statement = $db->prepare($get_all_city_records_query);
            $get_all_city_records_statement->execute();
            $get_all_city_records_result = $get_all_city_records_statement->fetchAll();
            $get_all_city_records_statement->closeCursor();
            return $get_all_city_records_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_city_name_from_id($city_id) {
        global $db;
        $get_city_name_from_id_query = 'select city_name from city_table where city_id = :city_id;';
        try {
            $get_city_name_from_id_statement = $db->prepare($get_city_name_from_id_query);
            $get_city_name_from_id_statement->bindValue(':city_id', $city_id);
            $get_city_name_from_id_statement->execute();
            $get_city_name_from_id_record = $get_city_name_from_id_statement->fetch();
            $get_city_name_from_id_statement->closeCursor();
            return $get_city_name_from_id_record['city_name'];
        }
        catch(Exception $e) {
            //Error Handling
        }
    }
?>