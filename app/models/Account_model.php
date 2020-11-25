<?php

class Account_model extends Database {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    function createAccount($data, $password){
        $q = "INSERT INTO users (username, nama, email, password, roll) VALUES (:username, :nama, :email, :password, :roll)";
        $this->db->query($q);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $password);
        $this->db->bind(':roll', $data['roll']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    function getIDUser($username){
        $this->db->query("SELECT id_user FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->singleOBJ();
    }


   function login($username, $password){
       $this->db->query("SELECT * FROM users WHERE username = :username");
       $this->db->bind(':username', $username);
       $row = $this->db->singleOBJ();
       $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
       
   }

   public function checkUsername($username){
       $q = "SELECT username FROM users WHERE username = '$username'";
       $this->db->query($q);
       return $this->db->single();

   }

}