<?php

include_once "../Models/SingleAdvertisementModel.php";

$model = new SingleAdvertisementModel();

$error = "";
$return = array();

if (isset($_GET["id"])) {
    // Obtiene el ID del anuncio de manera segura
    $advertisementId = $_GET["id"];

    // Realiza la consulta utilizando una consulta preparada
    $advertisement = $model->getAdvertisement($advertisementId);

    if ($advertisement) {
        $return['advertisement'] = $advertisement;
    } else {
        $return["error"] = "No se ha encontrado ningún anuncio";
    }
} else {
    $return["error"] = "NO ID SELECTED";
}

echo json_encode($return);