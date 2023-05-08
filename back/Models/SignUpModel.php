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

    public function checkUserExists($mail)
    {
        $sql = "SELECT id, mail, password FROM user_app WHERE mail = '" . $mail."';";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        if ($query->num_rows == 0) {
            return false;
        }
        return true;
    }

    public function saveUser($mail, $password)
    {
        $sql = "INSERT INTO user_app (mail, password) VALUES ('" . $mail."', '".$password."');";
        $this->db->default();
        $this->db->query($sql);
        if ($this->db->insert_id > 0) {
            $this->db->close();
            return true;
        }
        $this->db->close();
        return false;
    }

}