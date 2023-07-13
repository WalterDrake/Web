<?php
session_start();

include("connect_db_User.php");


if (isset($_POST["Login"])) {
    $user = test_input($_POST["username"]);
    $pass = md5(test_input(($_POST["pwd"])));

    // Get user's data from database
    $row = $db_1->query("SELECT * FROM CUSTOMERS WHERE USERNAME = :user AND PASSWORD = :pass");
    $row->execute([':user' => $user, ':pass' => $pass]);

    if ($row->fetchColumn()) {

        // Check "remember me" function
        if (isset($_POST["remember"])) {
            setcookie("remember_me", "on", time() + 3600 * 24 * 30, "/");
        }
        $sql = "SELECT ID FROM CUSTOMERS WHERE USERNAME = '$user'";
        $res = $db_1->prepare($sql);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $value = $row['ID'];

        // Set cookie for user
        setcookie("login_success", "true", time() + 3600 * 24 * 30, "/");
        setcookie("user_name", "$value", time() + 3600 * 24 * 30, "/");
        header("Location:/home.php");
    } else {
        // If login fail, redirect to login.html
        setcookie("login_error", "Login fail", time() + 1, "/");

        header("Location:/login.html");
    }
    // Cancel query
    $res = null;
    $row = null;
    $db = null;
}
// Sanitize input
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
