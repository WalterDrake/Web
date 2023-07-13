<?php
session_start();
include("connect_db_User.php");
include("connect_db_Shopping_Cart.php");

//Get Username from User
$res = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE ID = :value");
$res->execute([':value' => $_COOKIE['user_name']]);
$row = $res->fetch(PDO::FETCH_ASSOC);
$user_name = $row['USERNAME'];

//Get money from Shopping Cart
$total = 0;
$res = $db_3->query("SELECT Prices FROM Shopping_Cart WHERE User_name ='$user_name' ");
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $value = $row["Prices"];
    $total += $value;
}

// Get money from user
$res = $db_1->query("SELECT MONEY FROM CUSTOMERS WHERE ID = :value");
$res->execute([':value' => $_COOKIE['user_name']]);
$row = $res->fetch(PDO::FETCH_ASSOC);
$money = $row['MONEY'];

//Get discount
$discount = 0;
$date = (int)((int)date('d') / 7);
switch ($date) {
    case 0:
        $discount = 0.05;
        break;
    case 1:
        $discount = 0.1;
        break;
    case 2:
        $discount = 0.15;
        break;
    case 3:
        $discount = 0.2;
        break;
    case 4:
        $discount = 0.25;
        break;
}

// Payment products
if (($money - $total * $discount) < 0) {
    $_SESSION['status'] = 'Fail';
    header("Location: /Shopping_Cart.php");
} else {

    $res = $db_1->prepare("UPDATE CUSTOMERS SET MONEY = :money WHERE ID = :id ");
    $data = [
        ':money' => $money - $total * $discount,
        ':id' => $_COOKIE['user_name']
    ];
    $res->execute($data);

    $res = $db_3->prepare("DELETE FROM Shopping_Cart WHERE User_name = '$user_name'");
    $res->execute();
    $_SESSION['status'] = 'successful';
    header("Location: /Shopping_Cart.php");
}
