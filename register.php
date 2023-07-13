<?php
session_start();
include("connect_db_User.php");
if (isset($_POST["Register"])) {
    $user_name = test_input($_POST["username"]);
    $password_1 = test_input($_POST["pwd_1"]);
    $password_2 = test_input($_POST["pwd_2"]);

    if (!check($user_name)) {
        setcookie("register_error_name", "Register error", time() + 1, "/");
        header("Location:register.html");
    } else {

        if ($password_1 != $password_2) {

            setcookie("register_error", "Register fail", time() + 1, "/");

            header("Location:register.html");
        } elseif ($password_1 == $password_2) {
            $pass = md5($password_1);

            $data = [
                ':user_name' => $user_name,
                ':pass' => $pass
            ];
            $sql = "INSERT INTO CUSTOMERS (AVATAR,USERNAME,PASSWORD, MONEY) values ('/resources/images/icons8-user-16.png', :user_name, :pass, 0)";
            $res = $db_1->prepare($sql);

            $res->execute($data);

            setcookie("register_success", "Register successful", time() + 1, "/");

            header("Location:login.html");
        }
        $res = null;
        $db = null;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function check($user_name)
{
    include("connect_db_User.php");
    $row = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE USERNAME = :user");
    $row->execute([':user' => $user_name]);
    if ($row->fetchColumn())
        return false;
    return true;
}
