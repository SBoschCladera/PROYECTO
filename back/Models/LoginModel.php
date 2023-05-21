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
        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        $sql = "SELECT id, mail, password FROM user_app WHERE mail = ?";

        $this->db->default();
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $query = $stmt->get_result();
        $this->db->close();

        if ($result = $query->fetch_assoc()) {
            $hashedPassword = $result["password"];
            if (password_verify($password, $hashedPassword)) {
             
                return new User($result["id"], $result["mail"], $result["password"]);
            }
        }

        return new User(0, "-", "-");
    }
}