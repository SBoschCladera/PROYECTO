<?php

if (isset($_GET["id"])) {
    $selectedBrandId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/brandController.php?id=" . $selectedBrandId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/brandController.php");
}

$obj = json_decode($file);
$brands = $obj->brands;
$selectedBrandId = "";

if (isset($_GET["id"])) {
    $selectedBrandId = $_GET["id"];
    $selectedBrand = $obj->selectedBrand;
}
session_start();

require_once "../Views/index.phtml"
    ?>