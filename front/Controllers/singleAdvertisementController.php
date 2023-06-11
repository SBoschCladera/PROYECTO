<?php

session_start();

if (isset($_SESSION["id"])) {
    if (isset($_GET["id"])) {
        $selectedDvertisementId = $_GET["id"];
        $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/singleAdvertisementController.php?id=" . $selectedDvertisementId);
        $advertisement_obj = json_decode($file);
    } else {
        die("NO ID SELECTED");
    }
} else {
   header("Location: loginController.php");
}

require_once "../Views/singleAdvertisement.phtml";

?>