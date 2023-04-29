<?php

// Verifica el "id" para los anuncio ("advertisements")
if (isset($_GET["id"])) {
    $selectedAdvertisementId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/listController.php?id=" . $selectedAdvertisementId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/listController.php");
}

// Decodificar los datos obtenidos del controlador de anuncios
$obj = json_decode($file);
$advertisements = $obj->advertisements;

// Obtiene el anuncio seleccionado según su id
$selectedAdvertisementId = "";
if (isset($_GET["id"])) {
    $selectedAdvertisementId = $_GET["id"];
    $selectedAdvertisement = $obj->selectedAdvertisement;
}

// Verifica el "id" para las marcas ("brands")
if (isset($_GET["id"])) {
    $selectedBrandId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/brandController.php?id=" . $selectedBrandId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/brandController.php");
}

$obj = json_decode($file);
$brands = $obj->brands;

// Obtiene la marca seleccionada según su id
$selectedBrandId = "";
if (isset($_GET["id"])) {
    $selectedBrandId = $_GET["id"];
    $selectedBrand = $obj->selectedBrand;
}

// Verifica el "id" para los tipos de vehículos ("vehicleTypes")
if (isset($_GET["id"])) {
    $selectedvehicleTypeId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/vehicleTypeController.php?id=" . $selectedvehicleTypeId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/vehicleTypeController.php");
}

$obj = json_decode($file);
$vehicleTypes = $obj->vehicleTypes;

// Obtiene el tipo de vehículo seleccionado según su id
$selectedvehicleTypeId = "";
if (isset($_GET["id"])) {
    $selectedvehicleTypeId = $_GET["id"];
    $selectedvehicleType = $obj->selectedvehicleType;
}

// Total anuncios
$file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/totalAdvertisementsController.php");

$obj = json_decode($file);
$total = $obj->total;


// Incluye la vista
require_once "../Views/index.phtml";