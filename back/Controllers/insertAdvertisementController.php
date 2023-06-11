<?php
include_once "../Models/InsertAdvertisementModel.php";

$insertModel = new InsertAdvertisementModel();

// Obtiene los datos enviados por AJAX
// Diferencia entre el tipo de valor que introduzca el usuario (si es un nuevo país o si el país ya existe)
if ($_POST["selectCountry"] != -1) {
    $countryTextField = $_POST["selectCountry"];
} else {
    $countryTextField = $_POST["newCountryName"];
}

// Idem par la marca
if ($_POST["selectBrand"] != -1) {
    $brandTextField = $_POST["selectBrand"];
} else {
    $brandTextField = $_POST["newBrandName"];
}

// Idem par el logo
if ($_POST["selectBrand"] != -1) {
    $brandLogo = $_POST["selectBrand"];
} else {
    $brandLogo = $_POST["newLogoName"];
}

$selectEngineType = $_POST["selectEngineType"];

// Idem para el modelo de una marca
if ($_POST["modelSelect"] != -1) {
    $modelTextField = $_POST["modelSelect"];
} else {
    $modelTextField = $_POST["newModelName"];
}

$series = $_POST["seriesName"];
$releaseYear = $_POST["releaseYearName"];
$selectVehicleType = $_POST['vehicleTypeName'];
$displacement = $_POST["displacementName"];
$power = $_POST["powerName"];
$maxVelocity = $_POST["maxVelocityName"];
$acceleration = $_POST["accelerationName"];
$consumption = $_POST["consumptionName"];
$photo1 = $_POST["newImage1"];
$photo2 = $_POST["newImage2"];
$photo3 = $_POST["newImage3"];
$photo4 = $_POST["newImage4"];
$photo5 = $_POST["newImage5"];
$description = $_POST["descriptionName"];
$price = $_POST["priceName"];
$publication_date = date("Y-m-d");
$userSeller = 5;//$_POST["userSellerId"];
$color = $_POST["colorName"];
$km = $_POST["kmName"];
$latitude = $_POST["latitudeName"];
$longitude = $_POST["longitudeName"];
$disponibility = true;


// Valida y sanitiza los datos
// Sanitiza el país dependiendo del tipo de valor introducido por el usuario (int o string)
if ($_POST["selectCountry"] != -1) {
    $countryTextField = filter_var($countryTextField, FILTER_SANITIZE_NUMBER_INT);
} else {
    $countryTextField =  ucfirst(strtolower(filter_var($countryTextField, FILTER_SANITIZE_STRING)));  // Primera letr amayúscula y el ressto minúscula
}

// Idem para la marca
if ($_POST["selectBrand"] != -1) {
    $brandTextField = filter_var($brandTextField, FILTER_SANITIZE_NUMBER_INT);
} else {
    $brandTextField = ucwords(strtolower(filter_var($brandTextField, FILTER_SANITIZE_STRING)));
}

// Idem para el logo de la marca
if ($_POST["selectBrand"] != -1) {
    $brandLogo = '../images/logosImages/' . filter_var($brandLogo, FILTER_SANITIZE_NUMBER_INT);
} else {
    $brandLogo = '../images/logosImages/' . strtolower(filter_var($brandLogo, FILTER_SANITIZE_STRING));
}

// Idem para el modelo de una marca
if ($_POST["modelSelect"] != -1) {
    $modelTextField = filter_var($modelTextField, FILTER_SANITIZE_NUMBER_INT);
} else {
    $modelTextField =  ucfirst(strtolower(filter_var($modelTextField, FILTER_SANITIZE_STRING)));  
}

$series = filter_var($series, FILTER_SANITIZE_STRING);
$selectEngineType = filter_var($selectEngineType, FILTER_SANITIZE_STRING);
$releaseYear = filter_var($releaseYear, FILTER_SANITIZE_NUMBER_INT);
$selectVehicleType = filter_var($selectVehicleType, FILTER_SANITIZE_STRING);
$displacement = filter_var($displacement, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$power = filter_var($power, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$maxVelocity = filter_var($maxVelocity, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$acceleration = filter_var($acceleration, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$consumption = filter_var($consumption, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$photo1 = '../images/advertisementImages/' . filter_var($photo1, FILTER_SANITIZE_STRING);
$photo2 = '../images/advertisementImages/' . filter_var($photo2, FILTER_SANITIZE_STRING);
$photo3 = '../images/advertisementImages/' . filter_var($photo3, FILTER_SANITIZE_STRING);
$photo4 = '../images/advertisementImages/' . filter_var($photo4, FILTER_SANITIZE_STRING);
$photo5 = '../images/advertisementImages/' . filter_var($photo5, FILTER_SANITIZE_STRING);
$description = filter_var($description, FILTER_SANITIZE_STRING);
$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$publication_date = filter_var($publication_date, FILTER_SANITIZE_STRING);
$userSeller = filter_var($userSeller, FILTER_SANITIZE_NUMBER_INT);
$color = filter_var($color, FILTER_SANITIZE_STRING);
$km = filter_var($km, FILTER_SANITIZE_NUMBER_INT);
$latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$conn = mysqli_connect('localhost', 'root', '', 'cars_db');

// id y nombre de las tablas (country, brand, model) donde se crean nuevos campos 
$selectBrandId = $insertModel->getBrandIdByName($brandTextField, $conn); // int
$selectBrandName = $insertModel->getBrandNameByid($selectBrandId, $conn); // string      

$selectCountryId = $insertModel->getCountryIdByName($countryTextField, $conn); // int
$selectCountryName = $insertModel->getCountryNameByid($selectCountryId, $conn); // string

$selectModelId = $insertModel->getCountryIdByName($modelTextField, $conn); // int
$selectModelName = $insertModel->getCountryNameByid($selectModelId, $conn); // string

// INSERTS EN TABLAS
// IF para country (inicio)
if ($_POST["selectCountry"] === '-1') {
 
    if($countryTextField !== $selectCountryName){
  
    $insertModel->insertNewCountry($countryTextField, $conn);

        //IF para brand (inicio)
        if ($_POST["selectBrand"] === '-1' ) {

            if($brandTextField !== $selectBrandName){           

            // Obtiene el ID del país añadido       
            $countryId = mysqli_insert_id($conn);
            $insertModel->insertNewBrand($brandTextField, $countryId, $brandLogo, $conn);

                //IF para model (inicio)
                if ($_POST["modelSelect"] === '-1') {

                    if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){

                        // Obtiene el ID de la marca añadida
                        $brandId = mysqli_insert_id($conn);
                        $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 

                        // Obtener el ID del modelo añadido
                        $modelId = mysqli_insert_id($conn);
                        $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                        // Obtiene el ID de la motorización añadida
                        $motorizationId = mysqli_insert_id($conn);
                        $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);
                                

                        // Obtiene el ID de las prestaciones añadidas
                        $benefitsId = mysqli_insert_id($conn);
                        $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                        // Obtiene el ID del multimedia añadido
                        $multimediaId = mysqli_insert_id($conn);
                        $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                            $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                            $conn);

                        // echo "Registro completado con éxito";
                        header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");

                    } else{

                        // Id del modelo en base de datos
                        $modelId = $selectModelId;
                        $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                        // Obtiene el ID de la motorización añadida
                        $motorizationId = mysqli_insert_id($conn);
                        $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                

                        // Obtiene el ID de las prestaciones añadidas
                        $benefitsId = mysqli_insert_id($conn);
                        $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                        // Obtiene el ID del multimedia añadido
                        $multimediaId = mysqli_insert_id($conn);
                        $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                            $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                            $conn);

                        header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   

                    }

                } else{

                    // Id del modelo en base de datos
                    $modelId = $selectModelId;
                    $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                    // Obtiene el ID de la motorización añadida
                    $motorizationId = mysqli_insert_id($conn);
                    $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                

                    // Obtiene el ID de las prestaciones añadidas
                    $benefitsId = mysqli_insert_id($conn);
                    $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                    // Obtiene el ID del multimedia añadido
                    $multimediaId = mysqli_insert_id($conn);
                    $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                        $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                        $conn);

                    // echo "Registro completado con éxito";
                    header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 

                }                      
            } else{
                
                $brandId = $selectBrandId;            

                if ($_POST["modelSelect"] ==='-1') {

                    if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){
                       
                        $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 

                        // Obtener el ID del modelo añadido
                        $modelId = mysqli_insert_id($conn);
                        $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                        // Obtiene el ID de la motorización añadida
                        $motorizationId = mysqli_insert_id($conn);
                        $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                

                        // Obtiene el ID de las prestaciones añadidas
                        $benefitsId = mysqli_insert_id($conn);
                        $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                        // Obtiene el ID del multimedia añadido
                        $multimediaId = mysqli_insert_id($conn);
                        $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                            $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                            $conn);

                        // echo "Registro completado con éxito";
                        header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");

                    } else{

                    // Id del modelo en base de datos
                        $modelId = $selectModelId;
                        $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                        // Obtiene el ID de la motorización añadida
                        $motorizationId = mysqli_insert_id($conn);
                        $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);
                                

                        // Obtiene el ID de las prestaciones añadidas
                        $benefitsId = mysqli_insert_id($conn);
                        $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                        // Obtiene el ID del multimedia añadido
                        $multimediaId = mysqli_insert_id($conn);
                        $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                            $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                            $conn);

                        // echo "Registro completado con éxito";
                        header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   

                    }

                } else{

                    // Id del modelo en base de datos
                    $modelId = $modelTextField;
                    $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                    // Obtiene el ID de la motorización añadida
                    $motorizationId = mysqli_insert_id($conn);
                    $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);
                                

                    // Obtiene el ID de las prestaciones añadidas
                    $benefitsId = mysqli_insert_id($conn);
                    $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                    // Obtiene el ID del multimedia añadido
                    $multimediaId = mysqli_insert_id($conn);
                    $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                        $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                        $conn);

                    // echo "Registro completado con éxito";
                    header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 

                }
            } 
         // BRAND != -1
         } else {

            $brandId = $_POST["selectBrand"];

            if ($_POST["modelSelect"] ==='-1') {

                if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){

                    $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 

                    // Obtener el ID del modelo añadido
                    $modelId = mysqli_insert_id($conn);
                    $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                    // Obtiene el ID de la motorización añadida
                    $motorizationId = mysqli_insert_id($conn);
                    $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);
                            

                    // Obtiene el ID de las prestaciones añadidas
                    $benefitsId = mysqli_insert_id($conn);
                    $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                    // Obtiene el ID del multimedia añadido
                    $multimediaId = mysqli_insert_id($conn);
                    $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                        $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                        $conn);

                    header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");

                } else{

                    // Id del modelo en base de datos
                    $modelId = $selectModelId;
                    $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                    // Obtiene el ID de la motorización añadida
                    $motorizationId = mysqli_insert_id($conn);
                    $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                            

                    // Obtiene el ID de las prestaciones añadidas
                    $benefitsId = mysqli_insert_id($conn);
                    $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                    // Obtiene el ID del multimedia añadido
                    $multimediaId = mysqli_insert_id($conn);
                    $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                        $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                        $conn);

                    header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   

                }

            } else{

                // Id del modelo en base de datos
                $modelId = $modelTextField;
                $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                // Obtiene el ID de la motorización añadida
                $motorizationId = mysqli_insert_id($conn);
                $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                            

                // Obtiene el ID de las prestaciones añadidas
                $benefitsId = mysqli_insert_id($conn);
                $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                // Obtiene el ID del multimedia añadido
                $multimediaId = mysqli_insert_id($conn);
                $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                    $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                    $conn);

                // echo "Registro completado con éxito";
                header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 

            }            
        }

    } else{       

        $countryId = $selectCountryId;  

        if ($_POST["selectBrand"] === '-1' ) {

             if($brandTextField !== $selectBrandName){           
 
             // Obtiene el ID del país añadido       
             $countryId = mysqli_insert_id($conn);
             $insertModel->insertNewBrand($brandTextField, $countryId, $brandLogo, $conn);
 
                 //IF para model (inicio)
                 if ($_POST["modelSelect"] === '-1') {              
 
                     if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){
 
                         // Obtiene el ID de la marca añadida
                         $brandId = mysqli_insert_id($conn);
                         $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 
 
                         // Obtener el ID del modelo añadido
                         $modelId = mysqli_insert_id($conn);
                         $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                         // Obtiene el ID de la motorización añadida
                         $motorizationId = mysqli_insert_id($conn);
                         $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                 
 
                         // Obtiene el ID de las prestaciones añadidas
                         $benefitsId = mysqli_insert_id($conn);
                         $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                         // Obtiene el ID del multimedia añadido
                         $multimediaId = mysqli_insert_id($conn);
                         $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                             $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                             $conn);

                         header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");
 
                     } else{
 
                         // Id del modelo en base de datos
                         $modelId = $selectModelId;
                         $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                         // Obtiene el ID de la motorización añadida
                         $motorizationId = mysqli_insert_id($conn);
                         $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                
 
                         // Obtiene el ID de las prestaciones añadidas
                         $benefitsId = mysqli_insert_id($conn);
                         $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                         // Obtiene el ID del multimedia añadido
                         $multimediaId = mysqli_insert_id($conn);
                         $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                             $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                             $conn);

                         header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   
 
                     }
 
                 } else{
 
                     // Id del modelo en base de datos
                     $modelId = $selectModelId;
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                 
 
                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);
 
                     // echo "Registro completado con éxito";
                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 
 
                 }                      
             } else{
                 
                 $brandId = $selectBrandId;            

                 if ($_POST["modelSelect"] ==='-1') {
 
                     if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){
                        
                         $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 
 
                         // Obtener el ID del modelo añadido
                         $modelId = mysqli_insert_id($conn);
                         $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                         // Obtiene el ID de la motorización añadida
                         $motorizationId = mysqli_insert_id($conn);
                         $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                 
 
                         // Obtiene el ID de las prestaciones añadidas
                         $benefitsId = mysqli_insert_id($conn);
                         $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                         // Obtiene el ID del multimedia añadido
                         $multimediaId = mysqli_insert_id($conn);
                         $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                             $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                             $conn);

                         header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");
 
                     } else{
 
                     // Id del modelo en base de datos
                         $modelId = $selectModelId;
                         $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                         // Obtiene el ID de la motorización añadida
                         $motorizationId = mysqli_insert_id($conn);
                         $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                 
 
                         // Obtiene el ID de las prestaciones añadidas
                         $benefitsId = mysqli_insert_id($conn);
                         $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                         // Obtiene el ID del multimedia añadido
                         $multimediaId = mysqli_insert_id($conn);
                         $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                             $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                             $conn);
 
                         // echo "Registro completado con éxito";
                         header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   
 
                 }
 
                 } else{
 
                     // Id del modelo en base de datos
                     $modelId = $modelTextField;
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                                 
 
                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);
 
                     // echo "Registro completado con éxito";
                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 
 
                 }
             } 

          } else {
 
             $brandId = $_POST["selectBrand"];
 
             if ($_POST["modelSelect"] ==='-1') {
 
                 if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){
 
                     $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 
 
                     // Obtener el ID del modelo añadido
                     $modelId = mysqli_insert_id($conn);
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             
 
                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);

                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");
 
                 } else{
 
                     // Id del modelo en base de datos
                     $modelId = $selectModelId;
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                            
 
                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);

                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");    

                 }
 
             } else{
 
                 // Id del modelo en base de datos
                 $modelId = $modelTextField;
                 $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       
 
                 // Obtiene el ID de la motorización añadida
                 $motorizationId = mysqli_insert_id($conn);
                 $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             
 
                 // Obtiene el ID de las prestaciones añadidas
                 $benefitsId = mysqli_insert_id($conn);
                 $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                
 
                 // Obtiene el ID del multimedia añadido
                 $multimediaId = mysqli_insert_id($conn);
                 $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                     $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                     $conn);
 
                 // echo "Registro completado con éxito";
                 header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 
 
             }            
         }
    }
} else {
    $countryId = $_POST['selectCountry'];
   
    //IF para brand (inicio)
    if ($_POST["selectBrand"] === '-1' ) {

         if($brandTextField !== $selectBrandName){           

         $insertModel->insertNewBrand($brandTextField, $countryId, $brandLogo, $conn);

             //IF para model (inicio)
             if ($_POST["modelSelect"] === '-1') {

                 if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){

                     // Obtiene el ID de la marca añadida
                     $brandId = mysqli_insert_id($conn);
                     $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 

                     // Obtener el ID del modelo añadido
                     $modelId = mysqli_insert_id($conn);
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             

                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);

                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");

                 } else{

                     // Id del modelo en base de datos
                     $modelId = $selectModelId;
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             

                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);

                     // echo "Registro completado con éxito";
                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   

                 }

             } else{

                 // Id del modelo en base de datos
                 $modelId = $modelTextField;
                 $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                 // Obtiene el ID de la motorización añadida
                 $motorizationId = mysqli_insert_id($conn);
                 $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             

                 // Obtiene el ID de las prestaciones añadidas
                 $benefitsId = mysqli_insert_id($conn);
                 $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                 // Obtiene el ID del multimedia añadido
                 $multimediaId = mysqli_insert_id($conn);
                 $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                     $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                     $conn);

                 header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 

             }                      
         } else{
             
            $brandId = $selectBrandId;            

            if ($_POST["modelSelect"] ==='-1') {

                if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){
                     
                     $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 

                     // Obtener el ID del modelo añadido
                     $modelId = mysqli_insert_id($conn);
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             

                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);

                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");

                } else{

                     // Id del modelo en base de datos
                     $modelId = $selectModelId;
                     $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                     // Obtiene el ID de la motorización añadida
                     $motorizationId = mysqli_insert_id($conn);
                     $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             

                     // Obtiene el ID de las prestaciones añadidas
                     $benefitsId = mysqli_insert_id($conn);
                     $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                     // Obtiene el ID del multimedia añadido
                     $multimediaId = mysqli_insert_id($conn);
                     $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                         $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                         $conn);

                     header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   

                }

            } else{

                 // Id del modelo en base de datos
                 $modelId = $selectModelId;
                 $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                 // Obtiene el ID de la motorización añadida
                 $motorizationId = mysqli_insert_id($conn);
                 $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                             

                 // Obtiene el ID de las prestaciones añadidas
                 $benefitsId = mysqli_insert_id($conn);
                 $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                 // Obtiene el ID del multimedia añadido
                 $multimediaId = mysqli_insert_id($conn);
                 $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                     $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                     $conn);

                 header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 

             }
         } 

      } else {

         $brandId = $_POST["selectBrand"];

         if ($_POST["modelSelect"] ==='-1') {

            if($modelTextField !== $selectModelName  || strtolower($modelTextField) !== $selectModelName){

                 $insertModel->insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn); 

                 // Obtener el ID del modelo añadido
                 $modelId = mysqli_insert_id($conn);
                 $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                 // Obtiene el ID de la motorización añadida
                 $motorizationId = mysqli_insert_id($conn);
                 $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                         

                 // Obtiene el ID de las prestaciones añadidas
                 $benefitsId = mysqli_insert_id($conn);
                 $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                 // Obtiene el ID del multimedia añadido
                 $multimediaId = mysqli_insert_id($conn);
                 $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                     $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                     $conn);

                 header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");

            } else{

                 // Id del modelo en base de datos
                 $modelId = $selectModelId;
                 $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

                 // Obtiene el ID de la motorización añadida
                 $motorizationId = mysqli_insert_id($conn);
                 $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);                         

                 // Obtiene el ID de las prestaciones añadidas
                 $benefitsId = mysqli_insert_id($conn);
                 $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

                 // Obtiene el ID del multimedia añadido
                 $multimediaId = mysqli_insert_id($conn);
                 $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                     $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                     $conn);

                 header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml");   

            }

         } else{

             // Id del modelo en base de datos
             $modelId = $selectModelId;
             $insertModel->insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn);                       

             // Obtiene el ID de la motorización añadida
             $motorizationId = mysqli_insert_id($conn);
             $insertModel->insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn);
                         

             // Obtiene el ID de las prestaciones añadidas
             $benefitsId = mysqli_insert_id($conn);
             $insertModel->insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn);                                

             // Obtiene el ID del multimedia añadido
             $multimediaId = mysqli_insert_id($conn);
             $insertModel->insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, 
                                                 $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, 
                                                 $conn);

             header("Location: http://localhost/php/PROYECTO/front/Views/insertSuccessView.phtml"); 

         }            
     }   
}

mysqli_close($conn);