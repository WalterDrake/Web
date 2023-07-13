<?php
include("connect_db_User.php");
$money = $transfer_money = $transfer_money_user = "";
$moneyErr = $transfer_moneyErr = $transfer_money_userErr = "";
define("max_money", 2147483647);

// Charge money into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST["money"])) {
    $money = test_input($_POST["money"]);
    if (!preg_match("/^[0-9']*$/", $money)) {
      $moneyErr = "Only number allowed";
    } else {

      $update_money = $db_1->query("SELECT MONEY FROM CUSTOMERS WHERE ID = :value");
      $update_money->execute([':value' => $_COOKIE['user_name']]);
      $row = $update_money->fetch(PDO::FETCH_ASSOC);
      $balance = $row['MONEY'];
      if ((int)$money >= max_money) {
        $moneyErr = "This money is so big";
      } elseif ($balance + (int)$money >= max_money) {
        $moneyErr = "You are so rich";
      } else {
        $res = $db_1->query("UPDATE CUSTOMERS SET MONEY = :money WHERE ID = :value ");
        $res->execute([':money' => $balance + (int)$money, ':value' => $id_user = $_COOKIE['user_name']]);
        $moneyErr = "Charge succesful";
      }
    }
  }
}

// Transfer money between two users
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["transfer_money"]) && !empty($_POST["transfer_money_user"])) {
    $transfer_money = test_input($_POST["transfer_money"]);
    $transfer_money_user = test_input($_POST["transfer_money_user"]);
    if (!preg_match("/^[0-9']*$/", $transfer_money)) {
      $transfer_moneyErr = "Only number allowed";
    } else if (!preg_match("/^[a-zA-Z']*$/", $transfer_money_user)) {
      $transfer_money_userErr = "Only alphabets allowed";
    } else {

      $check = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE USERNAME = :value");
      $check->execute([':value' => $transfer_money_user]);

      if ($check->fetchColumn()) {

        $money = $db_1->query("SELECT MONEY FROM CUSTOMERS WHERE ID = :value");
        $money->execute([':value' =>  $_COOKIE['user_name']]);
        $row = $money->fetch(PDO::FETCH_ASSOC);
        $balance_current = $row['MONEY'];

        $money_next = $db_1->query("SELECT MONEY FROM CUSTOMERS WHERE USERNAME = :value");
        $money_next->execute([':value' =>  $transfer_money_user]);
        $row = $money_next->fetch(PDO::FETCH_ASSOC);
        $balance_next = $row['MONEY'];

        if ($balance_current - (int)$transfer_money >= 0) {

          $transfer = $db_1->query("UPDATE CUSTOMERS SET MONEY = :money WHERE USERNAME = :value ");
          $transfer->execute([':money' => $balance_next + (int)$transfer_money, ':value' => $transfer_money_user]);

          $user_current = $db_1->query("UPDATE CUSTOMERS SET MONEY = :money WHERE ID = :value ");
          $user_current->execute([':money' => $balance_current - (int)$transfer_money, ':value' => $_COOKIE['user_name']]);

          $transfer_money_userErr = "Transfer succesful";
        } else $transfer_moneyErr = "You don't have enough money";
      } else $transfer_money_userErr = "User isn't exist";
    }
  } elseif (empty($_POST["transfer_money"]) && !empty($_POST["transfer_money_user"])) {
    $transfer_moneyErr = "Missing money to transfer";
  } elseif (empty($_POST["transfer_money_user"]) && !empty($_POST["transfer_money"])) {
    $transfer_money_userErr = "Missing username ";
  }
}

// Sanitize input user
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$db_1 = null; // Disconnect database
?>

<!DOCTYPE html>
<html>

<head>
  <title>BALANCE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .error {
      color: #FF0000;
    }

    .tab {
      tab-size: 1;
    }
  </style>

<body>
  <div class="container py-5">
    <br><br><br>
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-center font-weight-bold " style="color: #4fa528">
              <h3>BALANCE</h3>
            </div>
          </div>
          <div class="card text-black ">
            <span class="d-flex justify-content-end font-weight-bold"><a href="/home.php" alt=exit style="color: #FF0000;">X</a></span>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <pre class="tab"> Charge: <input type="text" name="money"> <span class="error"><?php echo $moneyErr; ?></span></pre>
              <p class="d-flex justify-content-center"><button type="submit" name="submit" value="Submit">Charge</button></p>
              <pre class="tab"> Transfer: <input type="text" name="transfer_money"> <span class="error"><?php echo $transfer_moneyErr; ?></span></pre>
              <pre class="tab"> To: <input type="text" name="transfer_money_user"> <span class="error"><?php echo $transfer_money_userErr; ?></span></pre>
              <p class="d-flex justify-content-center"><button type="submit" name="submit" value="Submit">Send</button></p>
              </pre>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>