<?php
    function get_all_category_records() {
        global $db;
        $get_all_category_records_query = 'select * from category_table order by category_id asc';
        try {
            $get_all_category_records_statement = $db->prepare($get_all_category_records_query);
            $get_all_category_records_statement->execute();
            $get_all_category_records_result = $get_all_category_records_statement->fetchAll();
            $get_all_category_records_statement->closeCursor();
            return $get_all_category_records_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }

    function get_category_name_from_id($category_id) {
        global $db;
        $get_category_name_from_id_query = 'select category_name from category_table where category_id = :category_id;';
        try {
            $get_category_name_from_id_statement = $db->prepare($get_category_name_from_id_query);
            $get_category_name_from_id_statement->bindValue(':category_id', $category_id);
            $get_category_name_from_id_statement->execute();
            $get_category_name_from_id_result = $get_category_name_from_id_statement->fetch();
            $get_category_name_from_id_statement->closeCursor();
            return $get_category_name_from_id_result['category_name'];
        }
        catch(Exception $e) {
            //Error handling
        }
    }
?>