<?php
try {
    $db_3 = new PDO('sqlite:db/Shopping_Cart.db', '', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
));}
catch (PDOException $error){
    echo $error->getMessage();
    die();
}