<?php

include_once "../Models/SignUpModel.php";

$return = array();
$result = false;
$error = "";

if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $signupModel = new SignUpModel();

    $mail = filter_var($_GET["mail"], FILTER_SANITIZE_EMAIL);
    $password = $_GET["password"];

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato de correo electrónico es inválido";
    } elseif ($signupModel->checkUserExists($mail)) {
        $error = "El usuario ya existe";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($signupModel->saveUser($mail, $hashedPassword)) {
            $result = true;
        } else {
            $error = "Algo ha ido mal";
        }
    }
} else {
    $error = "Faltan datos de entrada";
}

$return["result"] = $result;
$return["error"] = $error;

echo json_encode($return);