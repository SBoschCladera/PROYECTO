<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$totalAdvertisements = $model->getTotalAdvertisements();

$return = array(
    "total" => $totalAdvertisements 
);

echo json_encode($return);

?>