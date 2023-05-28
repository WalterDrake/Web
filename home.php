<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script>
    function onLoadFunction() {
      const inputs = document.querySelectorAll('form input[type="number"][min="1"]');
      inputs.forEach(input => {
        input.value = 0;
      });

      let user = getCookie("login_success");
      if (user != "") {
        alert("Login successful");
        document.cookie = "login_success=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      }

      function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }
    }
  </script>
</head>

<body onload="onLoadFunction()">
  <header>

    <div class="p-3 mb-sm-2 bg-success text-white">
      <h1 class="text-center">SHOPPING</h1>
    </div>
    <nav>
      <ul>

        <div class="container-fluid">
          <div class="row ">
            <div class="col-md-3 text-center">
              <a href="../account.php" target="_parent"><img src="../resources/images/icons8-user-16.png" alt="My Account" style="width: 50px;"></a>
            </div>
            <div class="col-md-3 text-center">

              <a href="../money.php" target="_self"><img src="../resources/images/transfermoney.png" alt="Member" style="width: 50px;"></a>
            </div>
            <div class="col-md-3 text-center">
              <a href="../Shopping_Cart.php" target="_self"><img src="../resources/images/icons8-fast-cart-16.png" alt="Shopping Cart" style="width: 50px;">
              </a>
            </div>
            <div class="col-md-3 text-center">
              <a href="../logout.php" target="_self"><img src="../resources/images/icons8-logout-rounded-16.png" alt="logout" style="width: 50px;">
              </a>
            </div>
          </div>
        </div>

      </ul>
    </nav>
  </header>
  <br>
  <main>
    <section>
      <div class="p-3 mb-sm-2 bg-light">
        <div class="container text-center">
          <div class="row">
            <div class="col-md-4">
              <br>
              <div class="img-fluid">
                <a href="../resources/images/Black T Shirt.png">
                  <img src="../resources/images/Black T Shirt.png" alt="T-shirt" style="width:100%">
                  <div class="caption">
                    <h6 class="text-center">
                      <p class="text-dark">T-Shirt</p>
                    </h6>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="img-fluid">
                <a href="../resources/images/pngwing.com.png">
                  <img src="../resources/images/pngwing.com.png" alt="Jeans" style="width:78%">
                  <div class="caption">
                    <h6 class="text-center">
                      <p class="text-dark">Jeans</p>
                    </h6>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <br><br><br><br><br>
              <div class="img-fluid">
                <a href="../resources/images/pngwing.com (1).png">
                  <img src="../resources/images/pngwing.com (1).png" alt="Shoes" style="width:100%">
                  <div class="caption">
                    <h6 class="text-center">
                      <p class="text-dark">Shoes</p>
                    </h6>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-md-4">
              <div class="caption">
                <p class="text-danger"><?php include("connect_db_Goods.php");
                                        $res = $db_2->query("SELECT Prices FROM GOODS WHERE Goods_name ='T-shirt'");
                                        $row = $res->fetch(PDO::FETCH_ASSOC);
                                        $value = $row['Prices'];
                                        print($value) ?>$</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="caption">
                <p class="text-danger"><?php include("connect_db_Goods.php");
                                        $res = $db_2->query("SELECT Prices FROM GOODS WHERE Goods_name ='Jeans'");
                                        $row = $res->fetch(PDO::FETCH_ASSOC);
                                        $value = $row['Prices'];
                                        print($value) ?>$</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="caption">
                <p class="text-danger"><?php include("connect_db_Goods.php");
                                        $res = $db_2->query("SELECT Prices FROM GOODS WHERE Goods_name ='Shoes'");
                                        $row = $res->fetch(PDO::FETCH_ASSOC);
                                        $value = $row['Prices'];
                                        print($value);
                                        $db_2 = null; ?>$</p>
              </div>
            </div>

            <div class="col-md-4">
              <form action="/Buy.php" method="post" method="post">
                <input type="number" id="quantity1" name="quantity" min="1">
                </script>
                <button type="submit" class="btn btn-primary" name="Good" value="T-shirt">ADD</button>
              </form>
            </div>
            <div class="col-md-4">
              <form action="/Buy.php" method="post">
                <input type="number" id="quantity2" name="quantity" min="1">
                <button type="submit" class="btn btn-primary" name="Good" value="Jeans">ADD</button>
              </form>
            </div>
            <div class="col-md-4">
              <form action="/Buy.php" method="post">
                <input type="number" id="quantity3" name="quantity" min="1">
                <button type="submit" class="btn btn-primary" name="Good" value="Shoes">ADD</button>
              </form>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center"><?php
                                                    if (isset($_SESSION['status']) && $_SESSION['status'] == 'success') {
                                                      echo '<p style="color: green;">Purchase successful!</p>';
                                                      unset($_SESSION['status']);
                                                    }
                                                    ?></div>
      </div>
    </section>
  </main>
</body>

</html>