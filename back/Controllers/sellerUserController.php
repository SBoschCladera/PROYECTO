<?php
include_once "../Models/AdvertisementListModel.php";

$model = new AdvertisementListModel();
$sellerUsers = $model->getSellerUsers();

$return = array(
    "sellerUsers" => $model->getSellerUsers(),
    "selectedSellerUserId" => "",
    "selectedSellerUser" => "",
);

echo json_encode($return);

?>