<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$countries = $model->getCountries();

$return = array(
    "countries" => $model->getCountries(),
    "selectedCountryId" => "",
    "selectedCountry" => "",
);
if (isset($_GET["id"])) {
    $selectedCountry = $model->getCountry($_GET["id"]);
    $return = array(
        "countries" => $model->getAdvertisements(),
        "selectedCountryId" => $_GET["id"],
        "selectedCountry" => $selectedCountry
    );
}

echo json_encode($return);

    ?>