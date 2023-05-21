<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$models = $model->getModels();

$return = array(
    "models" => $model->getModels(),
    "selectedModelId" => "",
    "selectedModel" => "",
);
if (isset($_GET["id"])) {
    $selectedBrand = $model->getModel($_GET["id"]);
    $return = array(
        "models" => $model->getAdvertisements(),
        "selectedModelId" => $_GET["id"],
        "selectedModel" => $selectedBrand
    );
}

echo json_encode($return);

    ?>