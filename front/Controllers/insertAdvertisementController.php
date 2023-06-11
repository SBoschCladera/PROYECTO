<?php

// Verifica el "id" para los anuncio ("advertisements")
if (isset($_GET["id"])) {
    $selectedAdvertisementId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/listController.php?id=" . $selectedAdvertisementId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/listController.php");
}

// Decodifica los datos obtenidos del controlador de anuncios
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
    $selectedVehicleTypeId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/vehicleTypeController.php?id=" . $selectedVehicleTypeId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/vehicleTypeController.php");
}

$obj = json_decode($file);
$vehicleTypes = $obj->vehicleTypes;

// Obtiene el tipo de vehículo seleccionado según su id
$selectedVehicleTypeId = "";
if (isset($_GET["id"])) {
    $selectedVehicleTypeId = $_GET["id"];
    $selectedVehicleType = $obj->selectedVehicleType;
}


// Verifica el "id" para los tipos de motores ("engineTypes")
if (isset($_GET["id"])) {
    $selectedEngineTypeId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/engineTypeController.php?id=" . $selectedEngineTypeId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/engineTypeController.php");
}

$obj = json_decode($file);
$engineTypes = $obj->engineTypes;

// Obtiene el tipo de motor seleccionado según su id
$selectedEngineTypeId = "";
if (isset($_GET["id"])) {
    $selectedEngineTypeId = $_GET["id"];
    $selectedEngineType = $obj->selectedEngineType;
}

// Verifica el "id" para los países ("countries")
if (isset($_GET["id"])) {
    $selectedCountryId = $_GET["id"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/countryController.php?id=" . $selectedCountryId);
} else {
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/countryController.php");
}

$obj = json_decode($file);
$countries = $obj->countries;

// Obtiene el país seleccionado según su id
$selectedCountryId = "";
if (isset($_GET["id"])) {
    $selectedCountryId = $_GET["id"];
    $selectedCountryType = $obj->selectedCountry;
}

require_once "../Views/insertAdvertisementView.phtml";