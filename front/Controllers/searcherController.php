<?php

if (isset($_GET["param"])) {
    $selectedParameter = $_GET["param"];
    $file = file_get_contents("http://localhost/php/PROYECTO/back/Controllers/searcherController.php?param=" . $selectedParameter);
}

$obj = json_decode($file);
$advertisements = $obj->advertisements;

return $advertisements;
?>