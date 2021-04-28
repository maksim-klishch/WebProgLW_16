<?php
session_start();
    //демонстраційна версія функції перевірки користувача
    function checkUser($login, $pass)
    {
        if($login == "admin" && $pass == "admin") return true;
        return false;
    }

    $login = $_POST["login"];
    $pass = $_POST["pass"];

    if(checkUser($login, $pass))
    {
        setcookie("login", $login);
        echo file_get_contents("form.html");
    }
    else
    {
        echo "<p>You can't be identificated.</p>";
    }
session_destroy();    
?>    