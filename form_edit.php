<?php
# Get database through "connect_db_User.php"
include("connect_db_User.php");
$name = $email = $pass = $phone = $upload = $upload_start = "";
$emailErr = $phoneErr = $uploadErr = $uploadErr_end = "";

# Change username, password, email, phone

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST["name"])) {
    $name = test_input($_POST["name"]);
    $res = $db_1->query("UPDATE CUSTOMERS SET USERNAME = :user WHERE ID = :value ");
    $res->execute([':user' => $name, ':value' => $id_user = $_COOKIE['user_name']]);
  }

  if (!empty($_POST["password"])) {
    $password = test_input($_POST["password"]);
    $res = $db_1->query("UPDATE CUSTOMERS SET PASSWORD = :pass WHERE ID = :value ");
    $res->execute([':pass' => $password, ':value' => $id_user = $_COOKIE['user_name']]);
  }

  if (!empty($_POST["email"])) {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    } else {
      $res = $db_1->query("UPDATE CUSTOMERS SET EMAIL = :email WHERE ID = :value ");
      $res->execute([':email' => $email, ':value' => $id_user = $_COOKIE['user_name']]);
    }
  }

  if (!empty($_POST["phone"])) {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("/^[0-9']*$/", $phone)) {
      $phoneErr = "Only number allowed";
    } else {
      $res = $db_1->query("UPDATE CUSTOMERS SET PHONE = :phone WHERE ID = :value ");
      $res->execute([':phone' => $phone, ':value' => $id_user = $_COOKIE['user_name']]);
    }
  }
}

// Sanatize input user
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Uploads avatar
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $res = $db_1->query("SELECT USERNAME FROM CUSTOMERS WHERE ID = :value");
  $res->execute([':value' => $_COOKIE['user_name']]);
  $row = $res->fetch(PDO::FETCH_ASSOC);
  $value = $row['USERNAME'];

  // Create folder if it is not exist
  if (!file_exists("resources/uploads/$value")) {
    mkdir("resources/uploads/$value", 0777, true);
  }

  $target_dir = "resources/uploads/$value/";

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));



  if (isset($_POST["submit"])) {

    if ($_FILES["fileToUpload"]["error"] != UPLOAD_ERR_OK) {
      return header("Location:form_edit.php");
    }

    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array(($imageFileType), $allowedExtensions)) {
      $upload_start = "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else{
      $uploadErr = "File is not an image.";
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      $uploadErr = "Sorry, file already exists.";
      $uploadOk = 0;
    }
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      $uploadErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
  }

  if ($uploadOk == 0) {
    $uploadErr_end = "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $previousAvatar = $db_1->query("SELECT AVATAR FROM CUSTOMERS WHERE ID = :value ");
      $previousAvatar->execute([':value' => $id_user = $_COOKIE['user_name']]);
      $row = $previousAvatar->fetch(PDO::FETCH_ASSOC);
      $previousFile = $row['AVATAR'];
      
      // Replace old image
      if (!empty($previousFile) && file_exists($previousFile)) {
        unlink($previousFile);
      }

      $res = $db_1->query("UPDATE CUSTOMERS SET AVATAR = :avatar WHERE ID = :value ");
      $res->execute([':avatar' => $target_file, ':value' => $id_user = $_COOKIE['user_name']]);

      $upload =  "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
      $uploadErr = "Sorry, there was an error uploading your file.";
    }
  }
}
$db_1 = null; //Disconnect database
?>
<!DOCTYPE html>
<html>

<head>
  <title>Edit</title>
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
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-5">
        <div class="card text-black ">
          <span class="d-flex justify-content-end font-weight-bold"><a href="../account.php" alt=exit style="color: #FF0000;">X</a></span>
          <h4 class="d-flex justify-content-center font-weight-bold">EDIT PROFILE </h4>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <pre class="tab"> Name: <input type="text" name="name" value="<?php echo $name; ?>"></pre>

            <pre class="tab"> Password: <input type="password" name="password" value="<?php echo $pass; ?>"></pre>

            <pre class="tab"> E-mail: <input type="text" name="email" value="<?php echo $email; ?>"> <span class="error"><?php echo $emailErr; ?></span></pre>


            <pre class="tab"> Phone: <input type="text" name="phone" value="<?php echo $phone; ?>"> <span class="error"><?php echo $phoneErr; ?></span></pre>

            <pre class="tab"> Select image to upload: <br> <input type="file" name="fileToUpload" id="fileToUpload"><input type="submit" value="Upload Image" name="submit"></pre>
            <span style="color: green;"> <?php echo $upload_start;
                                          echo "\n";
                                          echo $upload; ?> </span>
            <span class="error"><?php echo $uploadErr;
                                echo "\n";
                                echo $uploadErr_end;  ?></span>
            <br>

            <p class="d-flex justify-content-center"><button type="submit" name="submit" value="Submit">Save</button></p>
          </form>
        </div>
      </div>
    </div>
</body>