<?php

include_once "../DB/Dbo.php";
include_once "../Entities/User.php";

class LoginModel
{
    private Dbo $db;

    public function __construct()
    {
        $this->db = new Dbo();
    }

    public function getUser($mail, $password): User
    {
        $sql = "SELECT id, mail, password FROM user_app WHERE mail = '" . $mail."';";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
      
        if ($result = $query->fetch_assoc()) {
            if (crypt($password, $result["password"]) == $result["password"]) {
                return new User($result["id"], $result["mail"], $result["password"]);
            }
        }
        return new User(0, "-", "-");
    }
}