<?php
    // Delete all cookie of user, redirect to "index.php"
    if($_COOKIE["remember_me"])
        {
            setcookie("remember_me","", time() - 3600);
            setcookie("user_name","",time() - 3600);
            header("Location:/index.php");
        }
    else  {
        setcookie("user_name","",time() - 3600);
        header("Location:/index.php");
    }
?>