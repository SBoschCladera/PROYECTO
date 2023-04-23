<?php

include_once "Model.php";

class benefits
{
    public int $id;
    public Model $model_id;
    public int $max_velocity;
    public int $acceleration_0_100;
    public float $consumption;   

    /**
     * @param int $id
     * @param Model $modelo_id
     * @param int $max_velocity
     * @param int $acceleration_0_100
     * @param float $consumption
     */
    public function __construct(int $id, MOdel $model_id, int $max_velocity, int $acceleration_0_100, float $consumption)
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
    public function getModel(): model
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
    public function getAcceleration(): int
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