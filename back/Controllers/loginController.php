<?php

include_once "../Models/LoginModel.php";

if (isset($_GET["mail"]) && isset($_GET["password"])) {
    $loginModel = new LoginModel();
    $user = $loginModel->getUser($_GET["mail"], $_GET["password"]);
    echo json_encode($user);
} else {
    echo json_encode(new User(0, "-", "-"));
}