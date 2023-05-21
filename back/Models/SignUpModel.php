<?php

include_once "../DB/Dbo.php";
include_once "../Entities/User.php";

class SignUpModel
{
    private Dbo $db;

    public function __construct()
    {
        $this->db = new Dbo();
    }
    // Verifica si un usuario con el correo electrónico proporcionado ya existe en la base de datos
    public function checkUserExists($mail)
    {
        $sql = "SELECT id, mail, password FROM user_app WHERE mail = ?";
        $this->db->default();
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $query = $stmt->get_result();
        $this->db->close();

        if ($query->num_rows == 0) {
            return false;
        }
        return true;
    }

    // Almacena un nuevo usuario en la base de datos
    public function saveUser($mail, $password)
    {
        $sql = "INSERT INTO user_app (mail, password) VALUES (?, ?)";
        $this->db->default();
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $mail, $password);
        $stmt->execute();

        if ($stmt->insert_id > 0) {
            $this->db->close();
            return true;
        }

        $this->db->close();
        return false;
    }

}