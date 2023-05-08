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


class AdvertisementListModel
{
    private Dbo $db;

    public function __construct()
    {
        $this->db = new Dbo();
    }
    public function getVehicleType($id): VehicleType
    {
        $sql = "SELECT id, name FROM vehicle_type WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new VehicleType($result["id"], $result["name"]);
        return $return;
    }
    public function getCountry($id): Country
    {
        $sql = "SELECT id, name FROM country WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new Country($result["id"], $result["name"]);
        return $return;
    }
    public function getBrand($id): Brand
    {
        $sql = "SELECT id, name, country_id, logo FROM brand WHERE " . $id;

        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new Brand($result["id"], $result["name"], $result['country_id'], $result['logo']);
        return $return;
    }
    public function getEngineType($id): EngineType
    {
        $sql = "SELECT id, name FROM engine_type WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new EngineType($result["id"], $result["name"]);
        return $return;
    }
    public function getModel($id): Model
    {
        $sql = "SELECT id, name, series, engine_type_id, release_year, brand_id, vehcle_type_id FROM model WHERE " . $id;

        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new Model(
            $result["id"], $result["name"], $result['series'], $result['engine_type_id'], $result['release_year'],
            $result['brand_id'], $result['vehcle_type_id']
        );
        return $return;
    }

    public function getMotorization($id): Motorization
    {
        $sql = "SELECT id, name, model_id, engine_type_id, displacement, power  FROM motorization  WHERE " . $id;

        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new Motorization($result["id"], $result["modelName"], $result['engineType'], $result['displacement'], $result['power']);
        return $return;
    }
    public function getBenefits($id): Benefits
    {
        $sql = "SELECT id, model_id, max_velocity, acceleration_0_100, consumption FROM benefits  WHERE " . $id;

        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new Benefits($result["id"], $result["model_id"], $result['max_velocity'], $result['acceleration_0_100'], $result['consumption']);
        return $return;
    }

    public function getUser($id): User
    {
        if (!is_null($id)) {
            $sql = "SELECT id, mail, password FROM user_app WHERE id = " . $id;
            $this->db->default();
            $query = $this->db->query($sql);
            $this->db->close();
            $result = $query->fetch_assoc();
            return new User($result["id"], $result["mail"], $result["password"]);
        }
        return new User(0, "-", "-");
    }
    public function getSellerUser($id): SellerUser
    {
        if (!is_null($id)) {
            $sql = "SELECT id, name, NIF, mail, phoneNumber, user_app_id FROM seller_user WHERE id = " . $id;
            $this->db->default();
            $query = $this->db->query($sql);
            $this->db->close();
            $result = $query->fetch_assoc();

            return new SellerUser($result["id"], $result["name"], $result["NIF"], $result["mail"], $result["phoneNumber"], $result["user_app_id"]);
        }
        $user = new User(0, "-", "-");
        return new SellerUser(0, "-", "-", "-", "-", 0);
    }


    public function getAdvertisements(): array
    {

        // Realiza la consulta
        $sql = 'SELECT advertisement.id AS id, advertisement.description AS descriptionCar, /*FORMAT(*/advertisement.price/*, 2, ",")*/ AS price, 
                       advertisement.publication_date AS publicationDate, brand.id AS brandId, brand.name AS brandName, brand.logo AS logo, 
                       model.id AS modelId, model.name AS modelName, model.series AS series, model.release_year AS releaseYear, advertisement.color AS color, 
                       /*FORMAT(*/advertisement.km/*, 0)*/ AS km, country.id AS countryId, country.name AS countryName, vehicle_type.id AS vehicleTypeId, 
                       vehicle_type.name as vehicleTypeName, engine_type.id AS engineTypeId,engine_type.name AS engineTypeName, motorization.id AS motorizationId, 
                       motorization.displacement AS displacement, motorization.power AS power, benefits.id AS benefitsId, benefits.max_velocity AS maxVelocity, 
                       benefits.acceleration_0_100 AS acceleration, benefits.consumption AS consumption, multimedia.photo1 AS photo1, multimedia.photo2 AS photo2, 
                       multimedia.photo3 AS photo3, multimedia.photo4 AS photo4, multimedia.photo5 AS photo5, advertisement.seller_user_id AS advertisementSellerId, 
                       seller_user.id AS sellerUserId, seller_user.name AS sellerUserName, seller_user.NIF AS NIF, seller_user.mail AS mail, 
                       seller_user.phoneNumber AS phoneNumber, seller_user.user_app_id AS userSellerUserAppId, user_app.id AS userAppId,  user_app.mail AS userAppMail, 
                       user_app.password AS userAppPassword, multimedia.id AS multimediaId
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
                ORDER BY id/*RAND()*/
                /*LIMIT 12*/';


        $advertisements = array();
        $this->db->default();
        $query = $this->db->query($sql);
        while ($result = $query->fetch_assoc()) {
            $releaseYear = DateTime::createFromFormat('Y', $result["releaseYear"]);

            $vehicleType = new VehicleType($result['vehicleTypeId'], $result['vehicleTypeName']);
            $country = new Country($result["countryId"], $result["countryName"]);
            $brand = new Brand($result['brandId'], $result["brandName"], $country, $result['logo']);
            $engineType = new EngineType($result['engineTypeId'], $result['engineTypeName']);
            $model = new Model($result["modelId"], $result["modelName"], $result['series'], $engineType, $releaseYear, $brand, $vehicleType);
            $motorization = new Motorization($result["motorizationId"], $model, $engineType, $result["displacement"], $result['power']);
            $benefits = new Benefits($result["benefitsId"], $model, $result["maxVelocity"], $result["acceleration"], $result["consumption"]);
            $multimedia = new Multimedia($result['multimediaId'], $model, $result['photo1'], $result['photo2'], $result['photo3'], $result['photo4'], $result['photo5']);

            if (!is_null($result["userAppId"])) {
                $user = new User($result["userAppId"], $result["userAppMail"], $result["userAppPassword"]);
            } else {
                $user = new User(0, "-", "-");
            }


            if (!is_null($result["sellerUserId"])) {
                $sellerUser = new SellerUser($result["sellerUserId"], $result["sellerUserName"], $result["NIF"], $result["mail"], $result["phoneNumber"], $result["userSellerUserAppId"]);
            } else {
                //$sellerUser = new SellerUser(0, "-", "-" . "-", "-", 0);
            }



            $advertisement = new Advertisement(
                $result["id"], $result["descriptionCar"], $result["price"], DateTime::createFromFormat('Y-m-d', $result["publicationDate"]),
                $model,
                $sellerUser, $result['color'], $result["km"],
                $multimedia,
                $brand,
                $motorization,
                $benefits,
                $engineType
            );


            $advertisements[] = $advertisement;
        }

        return $advertisements;
    }

    public function getMultimedia($id): Multimedia
    {
        $sql = "SELECT id, model_id, photo1, photo2, photo3, photo4, photo5 FROM multimedia  WHERE " . $id;

        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new Multimedia($result["id"], $result["model_id"], $result['photo1'], $result['photo2'], $result['photo3'], $result['photo4'], $result['photo5']);
        return $return;
    }




    public function getAdvertisement(int $advertisementId): Advertisement
    {

        // Realiza la consulta
        $sql = 'SELECT advertisement.id AS id, advertisement.description AS descriptionCar, /*FORMAT(*/advertisement.price/*, 2, ",")*/ AS price, 
                       advertisement.publication_date AS publicationDate, brand.id AS brandId, brand.name AS brandName, brand.logo AS logo, 
                       model.id AS modelId, model.name AS modelName, model.series AS series, model.release_year AS releaseYear, advertisement.color AS color, 
                       /*FORMAT(*/advertisement.km/*, 0)*/ AS km, country.id AS countryId, country.name AS countryName, vehicle_type.id AS vehicleTypeId, 
                       vehicle_type.name as vehicleType, engine_type.id AS engineTypeId,engine_type.name AS engineTypeName, motorization.id AS motorizationId, 
                       motorization.displacement AS displacement, motorization.power AS power, benefits.id AS benefitsId, benefits.max_velocity AS maxVelocity, 
                       benefits.acceleration_0_100 AS acceleration, benefits.consumption AS consumption, multimedia.photo1 AS photo1, multimedia.photo2 AS photo2, 
                       multimedia.photo3 AS photo3, multimedia.photo4 AS photo4, multimedia.photo5 AS photo5, advertisement.seller_user_id AS advertisementSellerId, 
                       seller_user.id AS sellerUserId, seller_user.name AS sellerUserName, seller_user.NIF AS NIF, seller_user.mail AS mail, 
                       seller_user.phoneNumber AS phoneNumber, seller_user.user_app_id AS userSellerUserAppId, user_app.id AS userAppId,  user_app.mail AS userAppMail, 
                       user_app.password AS userAppPassword, multimedia.id AS multimediaId
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
            WHERE advertisement.id = " . $advertisementId . " ';

        $this->db->default();
        $query = $this->db->query($sql);
        $result = $query->fetch_assoc();
        $releaseYear = DateTime::createFromFormat('Y', $result["releaseYear"]);

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
            $sellerUser = new SellerUser($result["sellerUserId"], $result["sellerUserName"], $result["NIF"], $result["mail"], $result["phoneNumber"], $result["userSellerUserAppId"]);
        } else {
            //$sellerUser = new SellerUser(0, "-", "-" . "-", "-", 0);
        }

        $multimedia = new Multimedia($result['multimediaId'], $model, $result['photo1'], $result['photo2'], $result['photo3'], $result['photo4'], $result['photo5']);

        $advertisement = new Advertisement(
            $result["id"], $result["descriptionCar"], $result["price"], DateTime::createFromFormat('Y-m-d', $result["publicationDate"]),
            $model,
            $sellerUser,
            $result['color'], $result["km"],
            $multimedia,
            $brand,
            $motorization,
            $benefits,
            $engineType
        );

        return $advertisement;
    }

    public function getBrands(): array
    {
        $sql = "SELECT brand.id AS brandId, brand.name AS brandName, brand.country_id AS countryBrandId, brand.logo AS brandLogo, 
        country.id AS countryId, country.name AS countryName 
        FROM brand 
        INNER JOIN country ON country.id = brand.country_id
        ORDER BY brand.name";

        $brands = array();
        $this->db->default();
        $query = $this->db->query($sql);
        while ($result = $query->fetch_assoc()) {

            $country = new Country($result["countryId"], $result["countryName"]);
            $brand = new Brand($result["brandId"], $result["brandName"], $country, $result['brandLogo']);
            $brands[] = $brand;
        }
        return $brands;
    }
    public function getVehicleTypes(): array
    {
        $sql = "SELECT vehicle_type.id AS vehicleTypeId, vehicle_type.name AS vehicleTypeName
        FROM vehicle_type";

        $vehicleTypes = array();
        $this->db->default();
        $query = $this->db->query($sql);
        while ($result = $query->fetch_assoc()) {

            $vehicleType = new VehicleType($result["vehicleTypeId"], $result["vehicleTypeName"]);
            $vehicleTypes[] = $vehicleType;
        }
        return $vehicleTypes;
    }
    public function getTotalAdvertisements(): int
    {
        $sql = "SELECT count(id) AS numAnuncios FROM advertisement";
        $this->db->default();
        $query = $this->db->query($sql);
        $result = $query->fetch_assoc();

        return $result["numAnuncios"];
    }
}