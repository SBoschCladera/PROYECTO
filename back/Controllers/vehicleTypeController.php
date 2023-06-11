<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$vehicleType = $model->getVehicleTypes();

$return = array(
    "vehicleTypes" => $model->getVehicleTypes(),
    "selectedVehicleTypeId" => "",
    "selectedVehicleType" => "",
);
if (isset($_GET["id"])) {
    $selectedBrand = $model->getVehicleType($_GET["id"]);
    $return = array(
        "vehicleTypes" => $model->getVehicleTypes(),
        "selectedVehicleTypeId" => $_GET["id"],
        "selectedVehicleType" => $selectedVehicleType
    );
}

echo json_encode($return);

?>