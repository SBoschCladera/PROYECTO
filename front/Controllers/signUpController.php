<?php
if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["password2"])) {
    if ($_POST["password"] == $_POST["password2"]) {
        $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/signUpController.php?mail=" . $_POST["mail"] . "&password=" . $_POST["password"]);
        $signup_obj = json_decode($file);
        if ($signup_obj->result) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                header("Location: ../Views/signUpSuccessView.phtml");
                exit();
            }
        } else {
            //die($signup_obj->error);
            header("Location: ../Views/errorSignUpView.phtml");
            exit();
        }
    }
} else {
    include_once "../Views/signUpView.phtml";
}