<?php
session_start();

include("connect_db_User.php");
include("infor_log.php");

if (isset($_POST["Login"])) {
    $user = test_input($_POST["username"]);
    $pass = md5(test_input(($_POST["pwd"])));


    $row = $db_1->query("SELECT * FROM CUSTOMERS WHERE USERNAME = :user AND PASSWORD = :pass");
    $row->execute([':user' => $user, ':pass' => $pass]);

    if ($row->fetchColumn()) {

        if (isset($_POST["remember"])) {
            setcookie("remember_me", "on", time() + 3600 * 24 * 30, "/");
        }
        $sql = "SELECT ID FROM CUSTOMERS WHERE USERNAME = '$user'";
        $res = $db_1->prepare($sql);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $value = $row['ID'];
        setcookie("login_success", "true", time() + 3600 * 24 * 30, "/");
        setcookie("user_name", "$value", time() + 3600 * 24 * 30, "/");
        header("Location:/home.php");
    } else {
        setcookie("login_error", "Login fail", time() + 1, "/");

        header("Location:login.html");
    }
    $res = null;
    $row = null;
    $db = null;
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
