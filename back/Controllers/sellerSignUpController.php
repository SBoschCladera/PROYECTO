<?php

include_once "../Models/SellerSignUpModel.php";

$return = array();
$result = false;
$error = "";

if (isset($_GET["mail"])) {
    $sellerSignupModel = new SellerSignUpModel();

    $mail = $_GET["mail"];
    $name = $_GET['name'];
    $NIF = $_GET["nif"];
    $phoneNumber = $_GET['phoneNumber'];
    $userAppId = $_GET['id'];

    $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $NIF = filter_var($NIF, FILTER_SANITIZE_STRING);
    $phoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_STRING);
    $userAppId = filter_var($userAppId, FILTER_SANITIZE_NUMBER_INT);

    $name = str_replace("&#34;", "", $name);
    $NIF = str_replace("&#34;", "", $NIF);
    $phoneNumber = str_replace("&#34;", "", $phoneNumber);

    if ($sellerSignupModel->checkUserExists($mail)) {
        $error = "El usuario ya existe";
    } else {

        $hashedNIF = password_hash($NIF, PASSWORD_DEFAULT);
        if ($sellerSignupModel->saveUser($name, $hashedNIF, $mail, $phoneNumber, $userAppId)) {           
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