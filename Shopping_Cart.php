<?php
session_start();
include("connect_db_User.php");
$res = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE ID = :value");
$res->execute([':value' => $_COOKIE['user_name']]);
$row = $res->fetch(PDO::FETCH_ASSOC);
$user_name = $row['USERNAME'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container py-5">
        <br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center font-weight-bold " style="color: #4fa528">
                            <h3>Shopping Cart</h3>
                        </div>
                    </div>
                    <div class="card text-bg-info ">
                        <span class="d-flex justify-content-end font-weight-bold"><a href="/home.php" alt=exit style="color: #FF0000;">X</a></span>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center font-weight-bold">Good</div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center font-weight-bold">Amount</div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center font-weight-bold">Prices</div>
                            </div>
                            <!-- Show the names, amounts, and prices of all the products you have added -->
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center">
                                    <?php
                                    include("connect_db_Shopping_Cart.php");
                                    $res = $db_3->query("SELECT Goods_name FROM Shopping_Cart WHERE User_name ='$user_name' ");
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        $value = $row["Goods_name"];
                                        echo "$value <br>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center">
                                    <?php
                                    $res = $db_3->query("SELECT Amount FROM Shopping_Cart WHERE User_name ='$user_name' ");
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        $value = $row["Amount"];
                                        echo "$value <br>";
                                    }
                                    ?>
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <?php
                                        $res = $db_3->query("SELECT Prices FROM Shopping_Cart WHERE User_name ='$user_name' ");
                                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                            $value = $row["Prices"];
                                            echo "$value$ <br>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <pre class="tab"><div class = "d-flex justify-content-start font-weight-bold">        Total</div></pre>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <?php
                                        $total = 0;
                                        $res = $db_3->query("SELECT Prices FROM Shopping_Cart WHERE User_name ='$user_name' ");
                                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                            $value = $row["Prices"];
                                            $total += $value;
                                        }
                                        echo "$total$";
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <pre class="tab"><div class = "d-flex justify-content-start font-weight-bold">       Discount</div></pre>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <?php
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
                                        echo $discount * 100;
                                        echo "%";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <a href="payment.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">BUY</a>
                            </div>
                            <!-- Notice status about payment -->
                            <div class="d-flex justify-content-center"><?php
                                                                        if (isset($_SESSION['status']) && $_SESSION['status'] == 'successful') {
                                                                            echo '<p style="color: green;">Payment successful!</p>';
                                                                            unset($_SESSION['status']);
                                                                        } else if (isset($_SESSION['status']) && $_SESSION['status'] == 'Fail') { //fix it
                                                                            echo '<p style="color: red;">Payment Fail!</p>';
                                                                            unset($_SESSION['status']);
                                                                        }
                                                                        ?></div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>






    </div>
    <?php
    $res = null;
    $row = null;
    $db_3 = null;
    ?>

</body>

</html>