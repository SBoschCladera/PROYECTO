<?php

class SellerUser
{
    public int $id;
    public string $name;
    public string $NIF;
    public string $mail;
    public string $phoneNumber;
    public User $user_app_id;


    /**
     * @param int $id
     * @param string $name
     * @param string $NIF
     * @param string $mail
     * @param string $phoneNumber
     * @param User $user_app_id
     */
    public function __construct(int $id, string $name, string $NIF, string $mail, string $phoneNumber, User $user_app_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->NIF = $NIF;
        $this->mail = $mail;
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
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return User
     */
    public function getUserApp(): User
    {
        return $this->user_app_id;
    }

    /**
     * @param User 
     */
    public function setUserApp(User $user_app_id): void
    {
        $this->user_app_id = $user_app_id;
    }
}