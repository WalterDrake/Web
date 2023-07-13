<?php
# Connect with database

try {
    $db_2 = new PDO('sqlite:db/Goods.db', '', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
));}
catch (PDOException $error){
    echo $error->getMessage();
    die();
}
