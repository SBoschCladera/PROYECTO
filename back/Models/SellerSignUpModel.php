<?php

include_once "../DB/Dbo.php";
include_once "../Entities/User.php";

class SellerSignUpModel
{
    private Dbo $db;

    public function __construct()
    {
        $this->db = new Dbo();
    }

    // Verifica si un usuario con el correo electrónico proporcionado ya existe en la base de datos
    public function checkUserExists($mail)
    {
        $sql = "SELECT id, name, NIF, mail, phoneNumber, user_app_id FROM seller_user WHERE mail = ?";
        $this->db->default();
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $query = $stmt->get_result();
        // $this->db->close();

        if ($query->num_rows == 0) {
            return false;
        }
        return true;
    }

    // Almacena un nuevo usuario en la base de datos
    public function saveUser($name, $NIF, $mail, $phoneNumber, $user_app_id)
    {
        $sql = "INSERT INTO seller_user (name, NIF, mail, phoneNumber, user_app_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {            
            echo "Error en la preparación de la consulta: " . $this->db->error;
            return false;
        }

        $stmt->bind_param("sssss", $name, $NIF, $mail, $phoneNumber, $user_app_id);
        $stmt->execute();

        if ($stmt->insert_id > 0) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }
}
