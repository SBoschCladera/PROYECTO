<?php

include_once "../Models/SingleAdvertisementModel.php";

$model = new SingleAdvertisementModel();

$error = "";
$return = array();


if (isset($_GET["id"])) {
    $return['advertisement'] = $model->getAdvertisement($_GET["id"]);
   
} else {
    $return["error"] = "NO ID SELECTED";
}

echo json_encode($return);

?>