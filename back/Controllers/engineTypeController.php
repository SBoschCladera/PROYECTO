<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$engineType = $model->getEngineTypes();

$return = array(
    "engineTypes" => $model->getEngineTypes(),
    "selectedEngineTypeId" => "",
    "selectedEngineType" => "",
);
if (isset($_GET["id"])) {
    $selectedEngineType = $model->getEngineType($_GET["id"]);
    $return = array(
        "engineTypes" => $model->getEngineTypes(),
        "selectedEngineTypeId" => $_GET["id"],
        "selectedEngineType" => $selectedEngineType
    );
}

echo json_encode($return);

?>