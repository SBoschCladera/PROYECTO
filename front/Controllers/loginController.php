<?php

if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/loginController.php?mail=" . $_POST["mail"] . "&password=" . $_POST["password"]);
    $obj_user = json_decode($file);

    if ($obj_user->id > 0) {
        session_start();
        $_SESSION["id"] = $obj_user->id;
        $_SESSION["mail"] = $obj_user->mail;
        $_SESSION["userPlainPassword"] = $_POST["password"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header("Location: ../Views/loginSuccessView.phtml");
            exit();
        }
    } else {

        header("Location: ../Views/errorLoginView.phtml");
        exit();
    }
} else {
    include_once "../Views/logInView.phtml";
}