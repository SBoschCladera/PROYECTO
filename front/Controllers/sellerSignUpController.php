<?php

if (isset($_POST["mail"])) {
    $mail = urlencode($_POST["mail"]);
    $nif = urlencode($_POST["nif"]);
    $name = urlencode($_POST["nameSurname"]);
    $id = urlencode($_POST["id"]);
    $phoneNumber = urlencode($_POST["phoneNumber"]);

    $url = "http://localhost/php/PROYECTO/back/Controllers/sellerSignUpController.php?mail=$mail&nif=$nif&name=$name&id=$id&phoneNumber=$phoneNumber";

    $file = file_get_contents($url);
    $signup_obj = json_decode($file);

    if ($signup_obj !== null && $signup_obj->result) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header("Location: ../Views/signUpSuccessView.phtml");
            exit();
        }
    } else {
        header("Location: ../Views/errorSignUpView.phtml");
        exit();
    }
} else {
    include_once "../Views/signUpSellerView.phtml";
}