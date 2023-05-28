<?php
include('connect_db_Goods.php');

$db_2->exec("CREATE TABLE IF NOT EXISTS GOODS (
    ID INTEGER PRIMARY KEY AUTOINCREMENT, 
    Goods_name TEXT, 
    Prices INTERGER);");

$db_2->exec("INSERT INTO GOODS (Goods_name, Prices)

VALUES ('T-shirt',15),('Jeans',20),('Shoes',30);");

?>