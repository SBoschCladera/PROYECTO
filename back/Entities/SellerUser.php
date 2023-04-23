<?php

class SellerUser
{
    public int $id;
    public string $name;
    public string $NIF;
    public string $email;
    public string $phoneNumber;
    public int $user_app_id;


    /**
     * @param int $id
     * @param string $name
     * @param string $NIF
     * @param string $email
     * @param string $phoneNumber
     * @param int $user_app_id
     */
    public function __construct(int $id, string $name, string $NIF, string $email, string $phoneNumber, int $user_app_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->NIF = $NIF;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->user_app_id = $user_app_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int 
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string 
     */
    public function setNIF(string $NIF): void
    {
        $this->NIF = $NIF;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getphoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string
     */
    public function setphoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int
     */
    public function getUserApp(): int
    {
        return $this->user_app_id;
    }

    /**
     * @param int 
     */
    public function setUserApp(int $user_app_id): void
    {
        $this->user_app_id = $user_app_id;
    }
}