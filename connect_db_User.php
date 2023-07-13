<?php
# Connect with database
try {
    $db_1 = new PDO('sqlite:db/Customer.db', '', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
));}
catch (PDOException $error){
    echo $error->getMessage();
    die();
}
