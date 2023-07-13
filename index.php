<!DOCTYPE html>
<html lang="en">

<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  <!-- Get cookie from the website, if cookie "remember me" exists, log in to "home.php" -->
  <script>
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

    function checkCookie() {
      let check = getCookie("remember_me");
      if (check != "") {
        window.location.replace('/home.php');
      }
    }
  </script>

</head>

<body onload="checkCookie()">

  <header>
    <div class="p-3 mb-sm-2 bg-success text-white">
      <h1 class="text-center">SHOPPING WEBSITE</h1>
    </div>
    <nav>
      <ul>
        <!-- Show the function of the website. -->
        <div class="container-fluid"> 
          <div class="row">
            <div class="col-md-4 text-center">
              <a href="login.html" target="_parent"><img src="../resources/images/icons8-user-16.png" alt="My Account" style="width: 50px;"></a>
            </div>
            <div class="col-md-4 text-center">

              <a href="login.html" target="_self"><img src="../resources/images/transfermoney.png" alt="Member" style="width: 50px;"></a>
            </div>
            <div class="col-md-4 text-center">
              <a href="login.html" target="_self"><img src="../resources/images/icons8-fast-cart-16.png" alt="logout" style="width: 50px;">
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
          <!-- Show the image of the products. -->
          <div class="row">
            <div class="col-md-4">
              <br>
              <div class="img-fluid">
                <a href="../resources/images/Black T Shirt.png">
                  <img src="../resources/images/Black T Shirt.png" alt="T-shirt" style="width:100%">
                  <div class="caption">
                    <h6 class="text-center">
                      <p class="text-dark">Shirt</p>
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
            <!-- Get the price of products from the database. -->
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
                                        $db = null; ?>$</p>
              </div>
            </div>
            <!-- The button fuction -->
            <div class="col-md-4">
              <a href="login.html" class="btn btn-primary" role="button">ADD</a>
            </div>
            <div class="col-md-4">
              <a href="login.html" class="btn btn-primary" role="button">ADD</a>
            </div>
            <div class="col-md-4">
              <a href="login.html" class="btn btn-primary" role="button">ADD</a>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>