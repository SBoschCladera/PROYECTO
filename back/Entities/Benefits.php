<?php

include_once "Model.php";

class Benefits
{
    public int $id;
    public Model $model_id;
    public int $max_velocity;
    public float $acceleration_0_100;
    public float $consumption;   

    /**
     * @param int $id
     * @param Model $modelo_id
     * @param int $max_velocity
     * @param float $acceleration_0_100
     * @param float $consumption
     */
    public function __construct(int $id, Model $model_id, int $max_velocity, float $acceleration_0_100, float $consumption)
    {
        $this->id = $id;
        $this->model_id = $model_id;
        $this->max_velocity = $max_velocity;
        $this->acceleration_0_100 = $acceleration_0_100;
        $this->consumption = $consumption;
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
     * @return int
     */
    public function getmax_velocity(): int
    {
        return $this->max_velocity;
    }

    /**
     * @return int
     */
    public function getAcceleration(): float
    {
        return $this->acceleration_0_100;
    }

    /**
     * @return float
     */
    public function getConsumption(): float
    {
        return $this->consumption;
    }
}