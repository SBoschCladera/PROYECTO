<?php

include_once "Country.php";
include_once "Model.php";
include_once "User.php";
include_once "SellerUser.php";
include_once "Multimedia.php";
include_once "Brand.php";
include_once "Motorization.php";
include_once "Benefits.php";
include_once "EngineType.php";


class Advertisement
{
    public int $id;
    public string $description;
    public float $price;
    public DateTime $publication_date;
    public Model $model_id;
    public SellerUser $sellerUser_id;
    public string $color;
    public float $km;
    public Multimedia $images;
    public Brand $brand_id;
    public Motorization $motorization_id;
    public Benefits $benefits_id;
    public EngineType $engine_type_id;
    public string $latitude;
    public string $longitude;
    public bool $disponibility;

    /**
     * @param int $id
     * @param string $description
     * @param float $price
     * @param DateTime $publication_date
     * @param Model $model_id
     * @param SellerUser $sellerUser_id
     * @param string $color
     * @param float $km
     * @param Multimedia $images
     * @param Brand $brand_id
     * @param Motorization $motorization_id
     * @param Benefits $benefits_id
     * @param EngineType $engine_type_id
     * @param string $latitude
     * @param string $longitude
     * @param bool $disponibility
     */
    public function __construct(
        int $id, string $description, float $price, Datetime $publication_date, Model $model_id, SellerUser $sellerUser_id,
        string $color, float $km, Multimedia $images, Brand $brand_id, Motorization $motorization_id, Benefits $benefits_id,
        EngineType $engine_type_id, string $latitude, string $longitude, bool $disponibility
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
        $this->publication_date = $publication_date;
        $this->model_id = $model_id;
        $this->sellerUser_id = $sellerUser_id;
        $this->color = $color;
        $this->km = $km;
        $this->images = $images;
        $this->brand_id = $brand_id;
        $this->motorization_id = $motorization_id;
        $this->benefits_id = $benefits_id;
        $this->engine_type_id = $engine_type_id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->disponibility = $disponibility;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publication_date;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model_id;
    }

    /**
     * @return SellerUser
     */
    public function getSellerUser(): SellerUser
    {
        return $this->sellerUser_id;
    }

    /**
     * @param SellerUser $sellerUser_id
     */
    public function setSellerUser(SellerUser $sellerUser_id): void
    {
        $this->sellerUser_id = $sellerUser_id;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return Multimedia
     */
    public function getimages(): Multimedia
    {
        return $this->images;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand_id;
    }

    /**
     * @return Motorization
     */
    public function getMotorization(): Motorization
    {
        return $this->motorization_id;
    }

    /**
     * @return Benefits
     */
    public function getBenefits(): Benefits
    {
        return $this->benefits_id;
    }

    /**
     * @return EngineType
     */
    public function getEngineType(): EngineType
    {
        return $this->engine_type_id;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }


    /**
     * @return bool
     */
    public function getDisponibility(): bool
    {
        return $this->disponibility;
    }

    /**
     * @param bool $disponibility
     */
    public function setDisponibility(bool $disponibility): void
    {
        $this->disponibility = $disponibility;
    }
}