<?php

include_once "EngineType.php";
include_once "Model.php";

class Motorization
{
    public int $id;
    public Model $model_id;
    public EngineType $engineType_id;
    public float $displacement;
    public int $power;

    /**
     * @param int $id
     * @param Model $modelo_id
     * @param EngineType $engineType_id
     * @param float $displacement
     * @param int $power
     */
    public function __construct(int $id, Model $model_id, EngineType $engineType_id, float $displacement, int $power)
    {
        $this->id = $id;
        $this->model_id = $model_id;
        $this->engineType_id = $engineType_id;
        $this->displacement = $displacement;
        $this->power = $power;
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
        return $this->model_id;
    }

    /**
     * @return EngineType
     */
    public function getEngineType(): EngineType
    {
        return $this->engineType_id;
    }

  /**
     * @return float
     */
    public function getDisplacement(): float
    {
        return $this->displacement;
    }

  /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }
}