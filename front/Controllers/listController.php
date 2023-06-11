<?php

if (isset($_GET["id"])) {
    $selectedAdvertisementId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/listController.php?id=" . $selectedAdvertisementId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/listController.php");
}

$obj = json_decode($file);
$advertisements = $obj->advertisements;

$selectedAdvertisementId = "";

if (isset($_GET["id"])) {
    $selectedAdvertisementId = $_GET["id"];
    $selectedAdvertisement = $obj->selectedAdvertisement;
}

session_start();

return $advertisements;
?>