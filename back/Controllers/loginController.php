<?php

include_once "../Models/LoginModel.php";

if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $loginModel = new LoginModel();

    $mail = $_GET["mail"];
    $password = $_GET["password"];

    // Sanitiza las variables antes de pasarlas al modelo
    $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Verifica si el correo electrónico tiene un formato válido
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(new User(0, "-", "-"));
    } else {
        $user = $loginModel->getUser($mail, $password);
        echo json_encode($user);
    }
} else {
    echo json_encode(new User(0, "-", "-"));
}
