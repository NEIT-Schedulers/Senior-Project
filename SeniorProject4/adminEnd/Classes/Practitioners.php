<?php

    class Practitioners
    {
        private $conn;
        private $tableName = "practitioners";
        private $file = "errors.txt";
        
        
        
        
        
        
        public function __construct($db)
        {
            $this->conn = $db;
        }
        
        public function read()
        {
            $sql = "SELECT * FROM practitioners";
            $sql = $this->conn->prepare($sql);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        public function pullPractitioners($id)
        {
            $sql = "SELECT * FROM practitioners WHERE businessID = :id";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':id', $id);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        public function submitNewPractitioner($firstName, $lastName, $email, $phone, $id)
        {
            $sql = "INSERT INTO practitioners VALUES(NULL, :id, :firstName, :lastName, :email, :phone)";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':id', $id);
            $sql->bindParam(':firstName', $firstName);
            $sql->bindParam(':lastName', $lastName);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':phone', $phone);
            $sql->execute();
        }
        
        
        
        
        
        
    }




?>