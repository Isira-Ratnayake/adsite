<?php
    function get_payment_type_price($payment_type_id) {
        global $db;
        $get_payment_type_price_query = 'select payment_type_price from payment_type_table where payment_type_id = :payment_type_id;';
        try {
            $get_payment_type_price_statement = $db->prepare($get_payment_type_price_query);
            $get_payment_type_price_statement->bindValue(':payment_type_id', $payment_type_id);
            $get_payment_type_price_statement->execute();
            $get_payment_type_price_result = $get_payment_type_price_statement->fetch();
            $get_payment_type_price_statement->closeCursor();
            return $get_payment_type_price_result;
        }
        catch(Exception $e) {
            //Error handling
        }
    }
?>