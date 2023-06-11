<?php
include_once "../Entities/Advertisement.php";
include_once "../Entities/Benefits.php";
include_once "../Entities/Brand.php";
include_once "../Entities/Country.php";
include_once "../Entities/EngineType.php";
include_once "../Entities/Model.php";
include_once "../Entities/Motorization.php";
include_once "../Entities/Multimedia.php";
include_once "../Entities/SellerUser.php";
include_once "../Entities/User.php";
include_once "../Entities/VehicleType.php";
include_once "../DB/Dbo.php";

class InsertAdvertisementModel
{
    private Dbo $db;

    public function __construct()
    {
        $this->db = new Dbo();
    }

    // Inserta un nuevo país
    public function insertNewCountry($countryTextField, $conn)
    {
        $queryCountry = "INSERT INTO country (name) VALUES (?)";
        $stmtCountry = mysqli_prepare($conn, $queryCountry);
        mysqli_stmt_bind_param($stmtCountry, "s", $countryTextField);
        $result = mysqli_stmt_execute($stmtCountry);
        mysqli_stmt_close($stmtCountry);
        return $result;
    }

    //Inserta una nueva marca
    public function insertNewBrand($brandTextField, $countryId, $brandLogo, $conn)
    {
        $queryBrand = "INSERT INTO brand (name, country_id, logo) VALUES (?, ?, ?)";
        $stmtBrand = mysqli_prepare($conn, $queryBrand);
        mysqli_stmt_bind_param($stmtBrand, "sis", $brandTextField, $countryId, $brandLogo);
        $result = mysqli_stmt_execute($stmtBrand);
        mysqli_stmt_close($stmtBrand);

        return $result;
    }

    // Inserta un nuevo modelo
    public function insertNewModel($modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType, $conn)
    {
        $queryModel = "INSERT INTO model (name, series, engine_type_id, release_year, brand_id, vehicle_type_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtModel = mysqli_prepare($conn, $queryModel);
        mysqli_stmt_bind_param($stmtModel, "ssisii", $modelTextField, $series, $selectEngineType, $releaseYear, $brandId, $selectVehicleType);
        $result = mysqli_stmt_execute($stmtModel);
        mysqli_stmt_close($stmtModel);

        return $result;
    }

    // Inserta una nueva motorization
    public function insertNewMotorization($modelId, $selectEngineType, $displacement, $power, $conn)
    {
        $queryMotorization = "INSERT INTO motorization (model_id, engine_type_id, displacement, power) VALUES (?, ?, ?, ?)";
        $stmtMotorization = mysqli_prepare($conn, $queryMotorization);
        mysqli_stmt_bind_param($stmtMotorization, "iidi", $modelId, $selectEngineType, $displacement, $power);
        $result = mysqli_stmt_execute($stmtMotorization);
        mysqli_stmt_close($stmtMotorization);

        return $result;
    }

    // Inserta un nuevo benefits
    public function insertNewBenefits($modelId, $maxVelocity, $acceleration, $consumption, $conn)
    {
        $queryBenefits = "INSERT INTO benefits (model_id, max_velocity, acceleration_0_100, consumption) VALUES (?, ?, ?, ?)";
        $stmtBenefits = mysqli_prepare($conn, $queryBenefits);
        mysqli_stmt_bind_param($stmtBenefits, "iidd", $modelId, $maxVelocity, $acceleration, $consumption);
        $result = mysqli_stmt_execute($stmtBenefits);
        mysqli_stmt_close($stmtBenefits);

        return $result;
    }

    // Inserta un nuevo multimedia
    public function insertNewMultimedia($modelId, $photo1, $photo2, $photo3, $photo4, $photo5, $conn)
    {
        $queryMultimedia = "INSERT INTO multimedia (model_id, photo1, photo2, photo3, photo4, photo5) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtMultimedia = mysqli_prepare($conn, $queryMultimedia);
        mysqli_stmt_bind_param($stmtMultimedia, "isssss", $modelId, $photo1, $photo2, $photo3, $photo4, $photo5);
        $result = mysqli_stmt_execute($stmtMultimedia);
        mysqli_stmt_close($stmtMultimedia);

        return $result;
    }

    // Inserta un nuevo anuncio
    public function insertNewAdvertisement($description, $price, $publication_date, $modelId, $userSeller, $color, $km, $multimediaId, $brandId, 
                                           $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility, $conn) {

        $queryAdvertisement = "INSERT INTO advertisement (description, price, publication_date, model_id, seller_user_id, color, km, multimedia_id, 
                                                          brand_id, motorization_id, benefits_id, engine_type_id, latitude, longitude, disponibility) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtAdvertisement = mysqli_prepare($conn, $queryAdvertisement);
        mysqli_stmt_bind_param($stmtAdvertisement, "sdsiisiiiiiisss", $description, $price, $publication_date, $modelId, $userSeller, $color, $km, 
                               $multimediaId, $brandId, $motorizationId, $benefitsId, $selectEngineType, $latitude, $longitude, $disponibility);
        $result = mysqli_stmt_execute($stmtAdvertisement);
        mysqli_stmt_close($stmtAdvertisement);

        return $result;
    }

    // Obtiene el id de un país según su nombre
    public function getCountryIdByName($countryName, $conn)
    {
        $query = "SELECT id FROM country WHERE name = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $countryName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $countryId);

        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            return $countryId;
        }

        mysqli_stmt_close($stmt);
        return "";
    }

    // Obtiene el nombre de un país según su id
    public function getCountryNameByid($countryId, $conn)
        {
            $query = "SELECT name FROM country WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $countryId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $countryName);

            if (mysqli_stmt_fetch($stmt)) {
                mysqli_stmt_close($stmt);
                return $countryName;
            }

            mysqli_stmt_close($stmt);
            return "";
        }

    // Obtiene el id de una marca según su nombre
    public function getBrandIdByName($brandName, $conn)
        {
            $query = "SELECT id FROM brand WHERE name = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $brandName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $brandId);

            if (mysqli_stmt_fetch($stmt)) {
                mysqli_stmt_close($stmt);
                return $brandId;
            }

            mysqli_stmt_close($stmt);
            return "";
        }

    // Obtiene el nombre de una marca según su id
    public function getBrandNameByid($brandId, $conn)
        {
            $query = "SELECT name FROM brand WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $brandId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $brandName);

            if (mysqli_stmt_fetch($stmt)) {
                mysqli_stmt_close($stmt);
                return $brandName;
            }

            mysqli_stmt_close($stmt);
            return false;
        }
 
    // Obtiene el id de un modelo según su nombre    
    public function getModelIdByName($modelName, $conn)
        {
            $query = "SELECT id FROM model WHERE name = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $modelName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $modelId);

            if (mysqli_stmt_fetch($stmt)) {
                mysqli_stmt_close($stmt);
                return $modelId;
            }

            mysqli_stmt_close($stmt);
            return "";
        }

    // Obtiene el nombre de un modelo según su id  
    public function getModelNameByid($modelId, $conn)
        {
            $query = "SELECT name FROM model WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $modelId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $modelName);

            if (mysqli_stmt_fetch($stmt)) {
                mysqli_stmt_close($stmt);
                return $modelName;
            }

            mysqli_stmt_close($stmt);
            return false;
        }
    }
