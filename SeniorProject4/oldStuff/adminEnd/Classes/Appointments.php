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
                            s.serviceID, s.serviceName, s.description, s.price AS servicePrice, s.lengthOfTime AS duration
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
            WHERE appointments.businessID = :businessID AND DATE(appointments.appointmentTime) = :date" . " ORDER BY appointments.appointmentTime";
            // . $this->sqlInnerJoinEnd;
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':businessID', $bs);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;        }
        
        
        
        
        
        // Function for inserting appointment into database
        public function submitAppointment($clientFirstName, $clientLastName, $clientEmail, $clientPhone, $date, $time, $businessID, $serviceID, $practitionerID)
        {
            $sql = "SELECT TIME(openingHour) AS openingHour, TIME(closingHour) AS closingHour FROM owners WHERE ownerID = :ownerID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':ownerID', $businessID);
            $sql->execute();
            $results = $sql->fetch(PDO::FETCH_ASSOC);
            // echo $results['openingHour'] . "<br>";
            // echo $results['closingHour'] . "<br>";
            print_r($results);
            echo "<br>";
            
            
            
            echo "<hr>";
            
            
            
            $sql = "SELECT lengthOfTime FROM services WHERE serviceID = :serviceID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':serviceID', $serviceID);
            $sql->execute();
            $lengthOfTime = $sql->fetch(PDO::FETCH_ASSOC);
            $lengthOfTime = $lengthOfTime['lengthOfTime'];
            $lengthOfTime -= 1;
            echo "LENGTH OF TIME: " . $lengthOfTime . " minutes<br>";
            
            
            
            // The year, month, and day
            // $year = date("Y", strtotime($date));
            // $month = date("m", strtotime($date));
            // $day = date("d", strtotime($date));
            // $date = date('Y-m-d', strtotime($yea . "-" . $month . "-" . $day));
            
            $date = date('Y-m-d', strtotime($date));
            echo $date;
            
            
            
            // The hour and minute
            // $hour = date("H", strtotime($time));
            // $minutes = date("i", strtotime($time));
            // $time = $hour . ":" . $minutes;
            // $time = date('H:i', strtotime($time));
            
            $time = date('H:i', strtotime($time));
            echo "<br>" . $time;
            echo "<br>";

            
            
            // Grabbing most recent appointment made
            $sql = "SELECT appointmentTime AS time FROM appointments WHERE practitionerID = :pracID ORDER BY appointmentTime ASC LIMIT 1";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':pracID', $practitionerID);
            $sql->execute();
            $resultRecentTime = $sql->fetch(PDO::FETCH_ASSOC);
            echo "<br>Most recent appointment time: " . $resultRecentTime['time'];
            
            
            
            // Grabbing the length of the most recent appointment made
            $sql = "SELECT lengthOfTime FROM services WHERE serviceID = :serviceID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':serviceID', $resultRecentTime['serviceID']);
            $sql->execute();
            $resultServiceID = $sql->fetch(PDO::FETCH_ASSOC);
            $resultServiceID = $resultServiceID['lengthOfTime'];
            echo "<br>Duration of that appointment: " . $resultServiceID;
            echo "<br>";
            
            
            
            
            
            


            $lastTime = date('H:i',strtotime('-' . $lengthOfTime . " minutes",strtotime($time)));
            $nextTime = date('H:i', strtotime('+' . $lengthOfTime . " minutes", strtotime($time)));
            echo $lastTime . " " . $nextTime;
            echo "<br>";
            
            
            
            
            

            $appointmentDateTime = $date . " " . $time;
            
            $sql = "SELECT * FROM appointments WHERE DATE(appointmentTime) = :appointmentDate AND TIME(appointmentTime) BETWEEN :lastTime AND :nextTime AND practitionerID = :pracID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':appointmentDate', $date);
            $sql->bindParam(':lastTime', $lastTime);
            $sql->bindParam(':nextTime', $nextTime);
            $sql->bindParam(':pracID', $practitionerID);
            $sql->execute();
            $resultsApp = $sql->fetch(PDO::FETCH_ASSOC);
            print_r($resultsApp);
            
            echo $time;
            echo "<br>";
            $results['openingHour'] = date('H:i', strtotime($results['openingHour']));
            echo "<br>";
            $results['closingHour'] = date('H:i', strtotime($results['closingHour']));
            

            // Checks that the appointment was being set during business operating hours
            if($time >= $results['openingHour'] && $time <= $results['closingHour'])
            {
                // Checks that the appointment does not collide with other appointments
                if($resultsApp == null)
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
                    echo "<br>PASSED!";
                }
                else
                {
                    echo "<br>ALSO DIDN'T PASS";
                }
            }
            else
            {
                echo "<br>DIDN'T PASS";
            }

        }

        
        
        
        
    }













?>