<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$advertisements = $model->getAdvertisements();

$return = array(
    "advertisements" => $model->getAdvertisements(),
    "selectedAdvertisementId" => "",
    "selectedAdvertisement" => "",
);
if (isset($_GET["id"])) {
    $selectedAdvertisement = $model->getAdvertisement($_GET["id"]);
    $return = array(
        "advertisements" => $model->getAdvertisements(),
        "selectedAdvertisementId" => $_GET["id"],
        "selectedAdvertisement" => $selectedAdvertisement,
    );
}

echo json_encode($return);

    ?>