<?php

    class Services
    {
        private $conn;
        private $tableName = "services";
        private $file = "errors.txt";
        
        
        
        
        
        public function __construct($db)
        {
            $this->conn = $db;
        }
        
        public function read()
        {
            $sql = "SELECT * FROM services";
            $sql = $this->conn->prepare($sql);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        public function pullServices($id)
        {
            $sql = "SELECT * FROM services WHERE businessID = :id";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':id', $id);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        public function submitNewService($serviceName, $description, $price, $lengthOfTime, $businessID)
        {
            $sql = "INSERT INTO services VALUES (NULL, :businessID, :serviceName, :description, :price, :lengthOfTime)";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':businessID', $businessID);
            $sql->bindParam(':serviceName', $serviceName);
            $sql->bindParam(':description', $description);
            $sql->bindParam(':price', $price);
            $sql->bindParam(':lengthOfTime', $lengthOfTime);
            $sql->execute();
        }
        
        public function deleteByID($sID)
        {
            $sql = "DELETE FROM services WHERE serviceID = :id";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':id', $sID);
            $sql->execute();
        }
        
        public function update($sID, $serviceName, $description, $price, $lengthOfTime)
        {
            $sql = "UPDATE services SET serviceName = :serviceName, description = :desc, price = :price, lengthOfTime = :lengthOfTime WHERE serviceID = :serviceID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':serviceName', $serviceName);
            $sql->bindParam(':desc', $description);
            $sql->bindParam(':price', $price);
            $sql->bindParam(':lengthOfTime', $lengthOfTime);
            $sql->bindParam(':serviceID', $sID);
            $sql->execute();
        }
 
    }





?>