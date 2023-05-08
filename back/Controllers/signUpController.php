<?php

include_once "../Models/SignUpModel.php";

$return = array();
$result = false;
$error = "";

if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $signupModel = new SignUpModel();
    if ($signupModel->checkUserExists($_GET["mail"])) {
        $error = "El usuario ya existe";
    } else {
        try {
            $password = crypt($_GET["password"], bin2hex(random_bytes(10)));
        } catch (Exception $e) {
            $password = crypt($_GET["password"], "salt");
        }
        if ($signupModel->saveUser($_GET["mail"], $password)) {
            $result = true;
        } else {
            $error = "Algo ha ido mal";
        }
    }
} else {
    $error = "Algo ha ido mal";
}

$return["result"] = $result;
$return["error"] = $error;

echo json_encode($return);