<!DOCTYPE html>
<html lang="en">

<head>
  <title>home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container py-5">
    <br><br>
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-center font-weight-bold " style="color: #4fa528">
              <h3>Account</h3>
            </div>
          </div>
          <div class="card text-bg-info ">
            <span class="d-flex justify-content-end font-weight-bold"><a href="/home.php" alt=exit style="color: #FF0000;">X</a></span>
            <?php
            include("connect_db_User.php");
            $id_user = $_COOKIE['user_name'];
            $res = $db_1->query("SELECT AVATAR FROM CUSTOMERS WHERE ID = :value");
            $res->execute([':value' => $id_user]);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $value = $row['AVATAR'];
            ?>
            <div class="d-flex justify-content-center">
              <img src="<?php echo $value; ?>" class="card-img-top" alt="user-image" style="width: auto; height: 200px;" />
            </div>
            <div class="card-body">
              <div class="text-center">
                <h5 class="card-title">
                  <p class="d-flex justify-content-start">Username:
                    <?php
                    $id_user = $_COOKIE['user_name'];
                    $res = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE ID = :value");
                    $res->execute([':value' => $id_user]);
                    $row = $res->fetch(PDO::FETCH_ASSOC);
                    $value = $row['USERNAME'];
                    print($value);
                    ?>
                  </p>
                  <p class="d-flex justify-content-start">Email:
                    <?php
                    $id_user = $_COOKIE['user_name'];
                    $res = $db_1->query("SELECT EMAIL FROM CUSTOMERS WHERE ID = :value");
                    $res->execute([':value' => $id_user]);
                    $row = $res->fetch(PDO::FETCH_ASSOC);
                    $value = $row['EMAIL'];
                    print($value);
                    ?>
                  </p>
                  <p class="d-flex justify-content-start">Phone:
                    <?php
                    $id_user = $_COOKIE['user_name'];
                    $res = $db_1->query("SELECT PHONE FROM CUSTOMERS WHERE ID = :value");
                    $res->execute([':value' => $id_user]);
                    $row = $res->fetch(PDO::FETCH_ASSOC);
                    $value = $row['PHONE'];
                    print($value);
                    ?>
                  </p>
                </h5>

              </div>
              <div>
                <div class="d-flex justify-content-center">
                  <a href="form_edit.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Edit</a>
                </div>

                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                  <span>Money</span><span>
                    <?php
                    $id_user = $_COOKIE['user_name'];
                    $res = $db_1->query("SELECT MONEY FROM CUSTOMERS WHERE ID = :value");
                    $res->execute([':value' => $id_user]);
                    $row = $res->fetch(PDO::FETCH_ASSOC);
                    $value = $row['MONEY'];
                    print($value);
                    ?>$
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $res = null;
    $row = null;
    $db_1 = null;
    ?>
</body>

</html>