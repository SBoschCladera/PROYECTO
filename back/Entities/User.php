<?php

class User
{
    public int $id;
    public string $mail;
    public string $password;

    /**
     * @param int $id
     * @param string $mail
     * @param string $password
     */
    public function __construct(int $id, string $mail, string $password)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->password = $password;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string 
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}