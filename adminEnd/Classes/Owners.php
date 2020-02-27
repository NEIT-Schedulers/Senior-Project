<?php

    class Owners {
        
        //table name and connection
        private $conn;
        private $tableName = "owners";
        private $file = "errors.txt";
        
        //object properties
        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $phone;
        
        //constructor setting connection variable
        public function __construct($db)
        {
            $this->conn = $db;
        }
        
        
        
        //reads entire client table
        public function read()
        {
            //try to pull entire table
            try{
                
                $sql = "SELECT * FROM owners";
                $sql = $this->conn->prepare($sql);
                $sql->execute();
                $results = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $results;
                
            } catch(PDOException $e) {
                
                //writes the error to the error file.
                file_put_contents($file, file_get_contents . $e, FILE_APPEND);
                
            }
        }
        
        //reads from client table, using first and last name.
        public function readName($firstName, $lastName)
        {
            //try to grab from clients using client name
            try{
                
                $sql = "SELECT * FROM owners WHERE ownerFirstName = :firstName AND ownerLastName = :lastName";
                $sql = $this->conn->prepare($sql);
                $sql->bindParam(':firstName', $firstName);
                $sql->bindParam(':lastName', $lastName);
                $sql->execute();
                $results = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $results;
                
            } catch(PDOException $e)
            {
                //writes the error to the error file.
                file_put_contents($file, file_get_contents . $e, FILE_APPEND);
            }
        }
        
        //reads from table using email
        public function readEmail($email)
        {
            //try to grab from clients using client name
            try{
                
                $sql = "SELECT * FROM owners WHERE ownerEmail = :email";
                $sql = $this->conn->prepare($sql);
                $sql->bindParam(':email', $email);
                $sql->execute();
                $results = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $results;
                
            } catch(PDOException $e)
            {
                //writes the error to the error file.
                file_put_contents($file, file_get_contents . $e, FILE_APPEND);
            }
        }
        
        //reads from table using phone number
        public function readPhoneNumber($phoneNumber)
        {
            //try to grab from clients using client name
            try{
                
                $sql = "SELECT * FROM owners WHERE ownerPhone = :phoneNumber";
                $sql = $this->conn->prepare($sql);
                $sql->bindParam(':phoneNumber', $phoneNumber);
                $sql->execute();
                $results = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $results;
                
            } catch(PDOException $e)
            {
                //writes the error to the error file.
                file_put_contents($file, file_get_contents . $e, FILE_APPEND);
            }
        }
        
        //logs in owner
        public function loginOwner($email, $password)
        {
            // echo $email . " " . $password;
            try{
                $sql = "SELECT * FROM owners WHERE ownerEmail = :email AND password = :pword";
                $sql = $this->conn->prepare($sql);
                $sql->bindParam(':email', $email);
                $sql->bindParam(':pword', $password);
                $sql->execute();
                $results = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $results;  
            }
            catch(PDOException $e)
            {
                //writes error to file
                file_put_contents($file, file_get_contents . $e, FILE_APPEND);
            }

        }
        
        
        
        //inserts new owner into db
        public function createOwner($ownerFirstName, $ownerLastName, $ownerEmail, $ownerPhone, $openingHour, $closingHour, $password)
        {
            try
            {
                $sql = "INSERT INTO owners VALUES (NULL, :ownerFirstName, :ownerLastName, :ownerEmail, :ownerPhone, :openingHour, :closingHour, :password)";
                $sql = $this->conn->prepare($sql);
                $sql->bindParam(':ownerFirstName', $ownerFirstName);
                $sql->bindParam(':ownerLastName', $ownerLastName);
                $sql->bindParam(':ownerEmail', $ownerEmail);
                $sql->bindParam(':ownerPhone', $ownerPhone);
                $sql->bindParam(':openingHour', $openingHour);
                $sql->bindParam(':closingHour', $closingHour);
                $sql->bindParam(':password', $password);
                $sql->execute();                
            }
            catch(PDOException $e)
            {
                file_put_contents($file, file_get_contents . $e, FILE_APPEND);
            }

        }



        //updates owner business operating hours
        public function updateHours($openingHours, $closingHours, $id)
        {
            $sql = "UPDATE owners SET openingHour = :opening, closingHour = :closing WHERE ownerID = :ownerID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':opening', $openingHours);
            $sql->bindParam(':closing', $closingHours);
            $sql->bindParam(':ownerID', $id);
            $sql->execute();
        }
        
        // updates owner name
        public function updateOwnerName($fName, $lName, $id)
        {
            $sql = "UPDATE owners SET ownerFirstName = :firstName, ownerLastName = :lastName WHERE ownerID = :ownerID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':firstName', $fName);
            $sql->bindParam(':lastName', $lName);
            $sql->bindParam(':ownerID', $id);
            $sql->execute();
        }
        
        // pulls the owners name again
        public function pullName($id)
        {
            $sql = "SELECT ownerFirstName, ownerLastName FROM owners WHERE ownerID = :id";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        
        
    }








?>