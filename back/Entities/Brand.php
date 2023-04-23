<?php

include_once "country.php";
class Brand
{
    public int $id;
    public string $name;
    public Country $country;
    public string $logo;

    /**
     * @param int $id
     * @param string $name
     * @param Country $country
     * @param string $logo
     */
    public function __construct(int $id, string $name, Country $country, string $logo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->logo = $logo;
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
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }


     /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

}