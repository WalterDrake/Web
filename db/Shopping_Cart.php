<?php
// Create a table of database
include("connect_db_Shopping_Cart.php");

$db_3->exec("CREATE TABLE IF NOT EXISTS Shopping_Cart (
    ID INTEGER PRIMARY KEY AUTOINCREMENT, 
    Goods_name TEXT NULL, 
    Prices INTERGER NULL,
    Amount INTERGER NULL,
    User_name TEXT NULL);");

?>