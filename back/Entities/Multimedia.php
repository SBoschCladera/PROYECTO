<?php

include_once "Model.php";

class Multimedia
{
    public int $id;
    public Model $modelo_id;
    public string $foto1;
    public string $foto2;
    public string $foto3;
    public string $foto4;
    public string $foto5;

    /**
     * @param int $id
     * @param Model $modelo_id
     * @param string $foto1
     * @param string $foto2
     * @param string $foto3
     * @param string $foto4
     * @param string $foto4
     */
    public function __construct(int $id, Model $modelo_id, string $foto1, string $foto2, string $foto3, string $foto4, string $foto5)
    {
        $this->id = $id;
        $this->modelo_id = $modelo_id;
        $this->foto1 = $foto1;
        $this->foto2 = $foto2;
        $this->foto3 = $foto3;
        $this->foto4 = $foto4;
        $this->foto5 = $foto5;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->modelo_id;
    }
    /**
     * @return string
     */
    public function getFoto1(): string
    {
        return $this->foto1;
    }

    /**
     * @return string
     */
    public function getFoto2(): string
    {
        return $this->foto2;
    }
    /**
     * @return string
     */
    public function getFoto3(): string
    {
        return $this->foto3;
    }
    /**
     * @return string
     */
    public function getFoto4(): string
    {
        return $this->foto4;
    }
    /**
     * @return string
     */
    public function getFoto5(): string
    {
        return $this->foto5;
    }

}