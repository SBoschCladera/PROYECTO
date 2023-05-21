<?php
include_once "../Models/SearcherModel.php";

$buscador = new SearcherModel();
$parametro = $_GET["param"]; // Obtiene el parámetro de búsqueda desde el cliente

$advertisements = $buscador->getBuscador($parametro);

$return = array(
    "advertisements" => $advertisements,
    "selectedAdvertisementId" => "",
    "selectedAdvertisement" => "",
);

if (isset($_GET["id"])) {
    $selectedAdvertisement = null; // Variable para almacenar el anuncio seleccionado
    $selectedId = $_GET["id"];

    // Buscar el anuncio seleccionado en el conjunto de anuncios obtenidos
    foreach ($advertisements as $advertisement) {
        if ($advertisement->getId() == $selectedId) {
            $selectedAdvertisement = $advertisement;
            break;
        }
    }

    $return = array(
        "advertisements" => $advertisements,
        "selectedAdvertisementId" => $selectedId,
        "selectedAdvertisement" => $selectedAdvertisement
    );
}

echo json_encode($return);