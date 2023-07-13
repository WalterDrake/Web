<?php
// Create a table of database
include('connect_db_User.php');

$db_1->exec("CREATE TABLE IF NOT EXISTS CUSTOMERS (
    ID INTEGER PRIMARY KEY AUTOINCREMENT, 
    USERNAME TEXT, 
    PASSWORD CHAR(50),
    EMAIL TEXT NULL,
    PHONE INTERGER NULL,
    AVATAR CHAR NULL,
    MONEY INTEGER);");
// Add user to database
$db_1->exec("INSERT INTO CUSTOMERS (ID, USERNAME, PASSWORD, EMAIL, PHONE, AVATAR, MONEY) 

VALUES (1,'ADMIN','202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '123456789', '/resources/images/icons8-user-16.png', 0);");

?>