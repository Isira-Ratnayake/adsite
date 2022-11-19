<?php
    $dsn = 'mysql:host=localhost;dbname=gp_adsitedb';
    $username = 'root';
    $password = '';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $db = new PDO($dsn, $username, $password, $options);
    }
    catch(PDOException $e) {
        //Error handling
    }
?>
