<?php
session_start();
include("connect_db_Shopping_Cart.php");
include("connect_db_User.php");
include("connect_db_Goods.php");

$user_name = $price = "";

//Get user_name from database of User
$res = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE ID = :value");
$res->execute([':value' => $_COOKIE['user_name']]);
$row = $res->fetch(PDO::FETCH_ASSOC);
$user_name = $row['USERNAME'];

function check($name) //Check user have bought this good
{
    include("connect_db_Shopping_Cart.php");
    $res = $db_3->query("SELECT User_name FROM Shopping_Cart WHERE Goods_name = :name");
    $res->execute([':name' => $name]);
    if ($res->fetchColumn()) return true;
    else return false;
};

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Get price of good
    $res = $db_2->query("SELECT Prices FROM GOODS WHERE Goods_name = :name");
    $res->execute([':name' => $_POST['Good']]);
    $row = $res->fetch(PDO::FETCH_ASSOC);
    $price = $row['Prices'];

    if ($_POST["Good"] == "T-shirt") {

        if (check($_POST["Good"])) {

            $res = $db_3->query("SELECT Prices, Amount FROM Shopping_Cart WHERE User_name = '$user_name' ");
            $get = $res->fetch(PDO::FETCH_ASSOC);
            $old_price = $get['Prices'];
            $old_amount = $get['Amount'];


            $res = $db_3->prepare("UPDATE Shopping_Cart SET Prices = :prices, Amount = :amount WHERE User_name = '$user_name' ");
            $data_1 = [
                ':prices' => $old_price + $price * $_POST["quantity"],
                ':amount' => $old_amount + $_POST["quantity"]
            ];
            $res->execute($data_1);
        } else {
            $data_1 = [
                ':name' => $_POST["Good"],
                ':prices' => $price * $_POST["quantity"],
                ':amount' => $_POST["quantity"],
                ':owner' => $user_name
            ];

            $sql = "INSERT INTO Shopping_Cart (Goods_name,Prices,Amount,User_name) values (:name, :prices, :amount, :owner)";
            $add = $db_3->prepare($sql);
            $add->execute($data_1);
        }

        $_SESSION['status'] = 'success';
        header("Location: /home.php");
    }


    if ($_POST["Good"] == "Jeans") {

        if (check($_POST["Good"])) {

            $res = $db_3->query("SELECT Prices, Amount FROM Shopping_Cart WHERE User_name = '$user_name' ");
            $get = $res->fetch(PDO::FETCH_ASSOC);
            $old_price = $get['Prices'];
            $old_amount = $get['Amount'];


            $res = $db_3->prepare("UPDATE Shopping_Cart SET Prices = :prices, Amount = :amount WHERE User_name = '$user_name' ");
            $data_1 = [
                ':prices' => $old_price + $price * $_POST["quantity"],
                ':amount' => $old_amount + $_POST["quantity"]
            ];
            $res->execute($data_1);
        } else {
            $data_1 = [
                ':name' => $_POST["Good"],
                ':prices' => $price * $_POST["quantity"],
                ':amount' => $_POST["quantity"],
                ':owner' => $user_name
            ];

            $sql = "INSERT INTO Shopping_Cart (Goods_name,Prices,Amount,User_name) values (:name, :prices, :amount, :owner)";
            $add = $db_3->prepare($sql);
            $add->execute($data_1);
        }
        $_SESSION['status'] = 'success';
        header("Location: /home.php");
    }

    if ($_POST["Good"] == "Shoes") {

        if (check($_POST["Good"])) {

            $res = $db_3->query("SELECT Prices, Amount FROM Shopping_Cart WHERE User_name = '$user_name' ");
            $get = $res->fetch(PDO::FETCH_ASSOC);
            $old_price = $get['Prices'];
            $old_amount = $get['Amount'];


            $res = $db_3->prepare("UPDATE Shopping_Cart SET Prices = :prices, Amount = :amount WHERE User_name = '$user_name' ");
            $data_1 = [
                ':prices' => $old_price + $price * $_POST["quantity"],
                ':amount' => $old_amount + $_POST["quantity"]
            ];
            $res->execute($data_1);
        } else {
            $data_1 = [
                ':name' => $_POST["Good"],
                ':prices' => $price * $_POST["quantity"],
                ':amount' => $_POST["quantity"],
                ':owner' => $user_name
            ];

            $sql = "INSERT INTO Shopping_Cart (Goods_name,Prices,Amount,User_name) values (:name, :prices, :amount, :owner)";
            $add = $db_3->prepare($sql);
            $add->execute($data_1);
        }
        $_SESSION['status'] = 'success';
        header("Location: /home.php");
    }
    $res = null;
    $row = null;
    $db_1 = null;
    $db_2 = null;
    $db_3 = null;
}
