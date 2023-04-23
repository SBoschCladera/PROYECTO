<?php

include_once "EngineType.php";
include_once "Brand.php";
include_once "VehicleType.php";

class Model
{
    public int $id;
    public string $name;
    public string $series;
    public EngineType $engineType_id;
    public DateTime $releaseYear;
    public Brand $brand_id;
    public VehicleType $vehicleType_id;

    /**
     * @param int $id
     * @param string $name
     * @param string $series
     * @param EngineType $engineType_id;
     * @param DateTime $releaseYear
     * @param Brand $brand_id
     * @param VehicleType $vehicleType_id
     */
    public function __construct(
        int $id, string $name, string $series, EngineType $engineType_id, DateTime $releaseYear,
        Brand $brand_id, VehicleType $vehicleType_id
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->series = $series;
        $this->engineType_id = $engineType_id;
        $this->releaseYear = $releaseYear;
        $this->brand_id = $brand_id;
        $this->vehicleType_id = $vehicleType_id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSeries(): string
    {
        return $this->name;
    }
    /**
     * @return EngineType
     */
    public function getEngineType(): EngineType
    {
        return $this->engineType_id;
    }
    /**
     * @return DateTime
     */
    public function getYear(): DateTime
    {
        return $this->releaseYear;
    }
    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand_id;
    }

    /**
     * @return VehicleType
     */
    public function getCountry(): VehicleType
    {
        return $this->vehicleType_id;
    }


}