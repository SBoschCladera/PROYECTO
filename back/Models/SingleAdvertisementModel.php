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

class SingleAdvertisementModel
{
    private Dbo $db;

    public function __construct()
    {
        $this->db = new Dbo();
    }
    
    // Consigue un anuncio según su id
    public function getAdvertisement(int $advertisementId): Advertisement
    {

        // Realiza la consulta
        $sql = 'SELECT advertisement.id AS id, advertisement.description AS descriptionCar, advertisement.price AS price, 
                       advertisement.publication_date AS publicationDate, brand.id AS brandId, brand.name AS brandName, brand.logo AS logo, 
                       model.id AS modelId, model.name AS modelName, model.series AS series, model.release_year AS releaseYear, advertisement.color AS color, 
                       advertisement.km AS km, country.id AS countryId, country.name AS countryName, vehicle_type.id AS vehicleTypeId, 
                       vehicle_type.name as vehicleType, engine_type.id AS engineTypeId,engine_type.name AS engineTypeName, motorization.id AS motorizationId, 
                       motorization.displacement AS displacement, motorization.power AS power, benefits.id AS benefitsId, benefits.max_velocity AS maxVelocity, 
                       benefits.acceleration_0_100 AS acceleration, benefits.consumption AS consumption, multimedia.photo1 AS photo1, multimedia.photo2 AS photo2, 
                       multimedia.photo3 AS photo3, multimedia.photo4 AS photo4, multimedia.photo5 AS photo5, advertisement.seller_user_id AS advertisementSellerId, 
                       seller_user.id AS sellerUserId, seller_user.name AS sellerUserName, seller_user.NIF AS NIF, seller_user.mail AS mail, 
                       seller_user.phoneNumber AS phoneNumber, seller_user.user_app_id AS userSellerUserAppId, user_app.id AS userAppId,  user_app.mail AS userAppMail, 
                       user_app.password AS userAppPassword, multimedia.id AS multimediaId, advertisement.latitude AS latitude, advertisement.longitude AS longitude,
                       advertisement.disponibility AS disponibility
            FROM advertisement     
            INNER JOIN model ON advertisement.model_id = model.id
            INNER JOIN brand ON model.brand_id = brand.id
            INNER JOIN country ON country.id = brand.country_id
            INNER JOIN engine_type ON engine_type.id = model.engine_type_id
            INNER JOIN vehicle_type ON vehicle_type.id = model.vehicle_type_id
            INNER JOIN motorization ON motorization.model_id = model.id
            INNER JOIN benefits ON benefits.model_id = model.id
            INNER JOIN seller_user ON seller_user.id = advertisement.seller_user_id
            INNER JOIN multimedia ON multimedia.model_id = model.id
            INNER JOIN user_app ON user_app.id = seller_user.user_app_id
            WHERE advertisement.id = ?';

        // Se utiliza una consulta preparada con un marcador de posición "?" en lugar de concatenar directamente el valor $advertisementId en la consulta. 
        // Luego, se enlaza el valor real utilizando el método bind_param().
        $this->db->default();
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $advertisementId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $releaseYear = DateTime::createFromFormat('Y-m-d', $result['releaseYear']);

        $vehicleType = new VehicleType($result['vehicleTypeId'], $result['vehicleType']);
        $country = new Country($result["countryId"], $result["countryName"]);
        $brand = new Brand($result['brandId'], $result["brandName"], $country, $result['logo']);
        $engineType = new EngineType($result['engineTypeId'], $result['engineTypeName']);
        $model = new Model($result["modelId"], $result["modelName"], $result['series'], $engineType, $releaseYear, $brand, $vehicleType);
        $motorization = new Motorization($result["motorizationId"], $model, $engineType, $result["displacement"], $result['power']);
        $benefits = new Benefits($result["benefitsId"], $model, $result["maxVelocity"], $result["acceleration"], $result["consumption"]);

        if (!is_null($result["userAppId"])) {
            $user = new User($result["userAppId"], $result["userAppMail"], $result["userAppPassword"]);
        } else {
            $user = new User(0, "-", "-");
        }

        if (!is_null($result["sellerUserId"])) {
            $sellerUser = new SellerUser($result["sellerUserId"], $result["sellerUserName"], $result["NIF"], $result["mail"], $result["phoneNumber"], $user);
        } else {
            $sellerUser = new SellerUser(0, "-", "-", "-" . "-", "-", $user);
        }

        $multimedia = new Multimedia($result['multimediaId'], $model, $result['photo1'], $result['photo2'], $result['photo3'], $result['photo4'], $result['photo5']);

        $advertisement = new Advertisement(
            $result["id"], $result["descriptionCar"], $result["price"], DateTime::createFromFormat('Y-m-d', $result["publicationDate"]),
            $model, $sellerUser, $result['color'], $result["km"], $multimedia, $brand, $motorization, $benefits, $engineType, $result['latitude'],
            $result['longitude'], $result['disponibility']);

        return $advertisement;
    }  
}