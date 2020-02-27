<?php

    class Appointments {
        
        private $conn;
        private $tableName = "appointments";
        private $file = "errors.txt";
        private $sqlInnerJoin = "SELECT appointments.appointmentID, DATE(appointments.appointmentTime) AS date, TIME(appointments.appointmentTime) AS time, appointments.clientFirstName, appointments.clientLastName, appointments.clientEmail, appointments.clientPhone, 
                            o.businessName AS business,
                            p.practitionerFirstName, p.practitionerLastName, p.practitionerEmail, p.practitionerPhone, 
                            s.serviceName, s.description, s.price AS servicePrice, s.lengthOfTime AS duration
            FROM appointments
            INNER JOIN practitioners AS p ON (
                appointments.practitionerID = p.practitionerID   
            )
            INNER JOIN services AS s ON (
                appointments.serviceID = s.serviceID    
            )
            INNER JOIN owners AS o ON (
                appointments.businessID = o.ownerID
            ) ";
        private $sqlInnerJoinEnd = " ORDER BY appointments.appointmentID ";
        
        //class properties
        public $id;
        public $time;
        public $serviceID;
        public $practitionerID;
        public $clientFirstName;
        public $clientLastName;
        public $clientEmail;
        public $clientPhone;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }
        
        //grabs all appointments without any inner joins
        public function read()
        {
            $sql = $this->sqlInnerJoin . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        
        //default query performed on rest visit, grabs entire appointments table
        public function readInnerJoin()
        {
            $sql = $this->sqlInnerJoin;
            $sql .= $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        
        
        
        
        // Function for searching by business ID
        public function readInnerJoinBusiness($businessID)
        {
            $sql = $this->sqlInnerJoin . "WHERE appointments.businessID = :businessID" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':businessID', $businessID);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        // Function for searching by client full name
        public function readInnerJoinClientFullName($cfn, $cln)
        {
            $sql = $this->sqlInnerJoin . "WHERE appointments.clientFirstName = :clientFirstName AND appointments.clientLastName = :clientLastName" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':clientFirstName', $cfn);
            $sql->bindParam(':clientLastName', $cln);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        //Function for searching by client first name
        public function readInnerJoinClientFirstName($cfn)
        {
            $sql = $this->sqlInnerJoin . "WHERE appointments.clientFirstName = :clientFirstName" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':clientFirstName', $cfn);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        //Function for searching by client last name
        public function readInnerJoinClientLastName($cln)
        {
            $sql = $this->sqlInnerJoin . "WHERE appointments.clientLastName = :clientLastName" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':clientLastName', $cln);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        //Function for searching by business name and date
        public function readInnerJoinBusinessNameDate($bs, $date)
        {
            $sql = $this->sqlInnerJoin . "WHERE o.businessName = :businessName AND DATE(appointments.appointmentTime) = :date" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':businessName', $bs);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        //Function for searching by business ID and date
        public function readInnerJoinBusinessIDDate($bs, $date)
        {
            $sql = $this->sqlInnerJoin . "WHERE appointments.businessID = :businessID AND DATE(appointments.appointmentTime) = :date" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':businessID', $bs);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        }
        
        //Function for searching by date
        public function readInnerJoinDate($date)
        {
            $sql = $this->sqlInnerJoin . "WHERE DATE(appointments.appointmentTime) = :date" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        // Function for searching by time
        public function readInnerJoinTime($time)
        {
            $sql = $this->sqlInnerJoin . "WHERE TIME(appointments.appointmentTime) = :time" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':time', $time);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        // Function for searching by date and time
        public function readInnerJoinDateTime($date, $time)
        {
            $sql = $this->sqlInnerJoin . "WHERE DATE(appointments.appointmentTime) = :date AND TIME(appointments.appointmentTime) = :time" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':date', $date);
            $sql->bindParam(':time', $time);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        // Function for searching by client last name and date
        public function readInnerJoinLastNameDate($cln, $date)
        {
            $sql = $this->sqlInnerJoin . "WHERE appointments.clientLastName = :cln AND DATE(appointments.appointmentTime) = :date" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':cln', $cln);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        public function readInnerJoinBusinessIDWithPracID($bs, $date)
        {
            $sql = "SELECT appointments.appointmentID, DATE(appointments.appointmentTime) AS date, TIME(appointments.appointmentTime) AS time, appointments.clientFirstName, appointments.clientLastName, appointments.clientEmail, appointments.clientPhone, 
                            o.businessName AS business,
                            p.practitionerID, p.practitionerFirstName, p.practitionerLastName, p.practitionerEmail, p.practitionerPhone, 
                            s.serviceName, s.description, s.price AS servicePrice, s.lengthOfTime AS duration
            FROM appointments
            INNER JOIN practitioners AS p ON (
                appointments.practitionerID = p.practitionerID   
            )
            INNER JOIN services AS s ON (
                appointments.serviceID = s.serviceID    
            )
            INNER JOIN owners AS o ON (
                appointments.businessID = o.ownerID
            ) 
            WHERE appointments.businessID = :businessID AND DATE(appointments.appointmentTime) = :date" . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':businessID', $bs);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;        }
        
        
        
        
        
        // Function for inserting appointment into database
        public function submitAppointment($clientFirstName, $clientLastName, $clientEmail, $clientPhone, $appointmentDateTime, $businessID, $serviceID, $practitionerID)
        {
            $sql = "INSERT INTO appointments VALUES(NULL, :appointmentDateTime, :businessID, :serviceID, :practitionerID, :clientFirstName, :clientLastName, :clientEmail, :clientPhone)";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':appointmentDateTime', $appointmentDateTime);
            $sql->bindParam(':businessID', $businessID);
            $sql->bindParam(':serviceID', $serviceID);
            $sql->bindParam(':practitionerID', $practitionerID);
            $sql->bindParam(':clientFirstName', $clientFirstName);
            $sql->bindParam(':clientLastName', $clientLastName);
            $sql->bindParam(':clientEmail', $clientEmail);
            $sql->bindParam(':clientPhone', $clientPhone);
            $sql->execute();
        }

        
        
        
        
    }













?>