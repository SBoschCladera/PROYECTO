<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$brands = $model->getBrands();

$return = array(
    "brands" => $model->getBrands(),
    "selectedBrandId" => "",
    "selectedBrand" => "",
);
if (isset($_GET["id"])) {
    $selectedBrand = $model->getBrand($_GET["id"]);
    $return = array(
        "brands" => $model->getAdvertisements(),
        "selectedBrandId" => $_GET["id"],
        "selectedBrand" => $selectedBrand
    );
}

echo json_encode($return);

?>