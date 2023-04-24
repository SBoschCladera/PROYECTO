<?php

if(isset($_GET["id"])){
    $selectedAdvertisementId = $_GET["id"];
    $file = file_get_contents("http://localhost:8012/php/PROYECTO/back/Controllers/listController.php?id=".$selectedAdvertisementId);
}else{
    $file = file_get_contents("http://localhost:8012/php/PROYECTO/back/Controllers/listController.php");
}

$obj = json_decode($file);

$advertisements = $obj->advertisements;
//var_dump($advertisements);

$selectedAdvertisementId = "";

if (isset($_GET["id"])) {
    $selectedAdvertisementId = $_GET["id"];
    $selectedAdvertisement = $obj->selectedAdvertisement;
   
}

require_once "../Views/index.phtml"

?>

