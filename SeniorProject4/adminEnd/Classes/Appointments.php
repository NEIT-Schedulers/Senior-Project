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
            // The following is where the majority of the SQL is performed in this function.
            // Grabs the operating hours of the store, so the user can't set an appointment outside these hours.
            $sql = "SELECT TIME(openingHour) AS openingHour, TIME(closingHour) AS closingHour FROM owners WHERE ownerID = :ownerID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':ownerID', $businessID);
            $sql->execute();
            $results = $sql->fetch(PDO::FETCH_ASSOC);
            
            
            // Grabs the length of time of the appointment the user selected.
            $sql = "SELECT lengthOfTime FROM services WHERE serviceID = :serviceID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':serviceID', $serviceID);
            $sql->execute();
            $lengthOfTimeArr = $sql->fetch(PDO::FETCH_ASSOC);       
            
            
            // Grabs list of appointments for the day, along with duration of each appointment.
            $sql = "SELECT TIME(appointments.appointmentTime) AS time, s.lengthOfTime 
            FROM appointments
            INNER JOIN services AS s ON(
                appointments.serviceID = s.serviceID
            )
            WHERE appointments.PractitionerID = :pracID AND DATE(appointments.appointmentTime) = :date 
            ORDER BY appointments.appointmentTime";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':pracID', $practitionerID);
            $sql->bindParam(':date', $date);
            $sql->execute();
            $resultsAppointmentsForTheDay = $sql->fetchAll(PDO::FETCH_ASSOC);
            // print_r($resultsAppointmentsForTheDay);           
            
            
            
            // Grabs the opening hour and closing hour and turns them into datetime variables for PHP.
            $openingHour = date('H:i', strtotime($results['openingHour']));
            $closingHour = date('H:i', strtotime($results['$closingHour']));

            // Formats the date and time into datetime variables.
            $date = date('Y-m-d', strtotime($date));
            $time = date('H:i', strtotime($time));

            // Sets a bool variable to false, used to check if the appointment being made has any collisions.            
            $boolThing = false;
            
            // Grabs the length of time for the appointment.
            // $lengthOfTime = $lengthOfTimeArr['lengthOfTime'];
            // $lengthOfTime -= 1;     
            
            // Sets the time when the appointment will end.
            $timeEnding = date('H:i', strtotime('+' . $lengthOfTimeArr['lengthOfTime'] . " minutes", strtotime($time)));
            // echo "TIME ENDING $timeEnding";
            
            // echo $openingHour . "<br>";
            // echo $closingHour . "<br>";
            // echo "time: " . $time . ", opening hour: " . $openingHour . "<br>";

            
            
            // Checks if the appointment being made has any collisions.
            foreach($resultsAppointmentsForTheDay AS $re)
            {
                // Grabs the length of time of the appointment being checked against.
                $lengthTime = $re['lengthOfTime'];
                
                // Grabs the time when the appointment starts and turns it into a datetime variable
                $appointmentTimeBeginning = $re['time'];
                $appointmentTimeBeginning = date('H:i', strtotime($appointmentTimeBeginning));
                // echo "APT " . $appointmentTimeBeginning . "<br>";
                
                // Grabs the time when the appointment ends and turns it into  a datetime variable
                $appointmentTimeEnding = $appointmentTimeBeginning;
                $appointmentTimeEnding = date('H:i', strtotime('+' . $lengthTime . " minutes", strtotime($appointmentTimeBeginning)));
                // echo "APT " . $appointmentTimeEnding . "<br>";
                


                // Checks if the time when the appointment being set occurs after the appointment being checked against...
                if($time >= $appointmentTimeBeginning)
                {
                    // echo "<br>$time occurs after $appointmentTimeBeginning... ";
                    
                    // Checks if the appointment being checked against ends before the appointment being set starts.
                    // If true, the appointments do not collide and it keeps checking today's appointments with this practitioner to see if there are any collisions.
                    if($appointmentTimeEnding <= $time)
                    {
                        // echo " but that appointment ends before your appointment starts. You're good!";
                    }
                    
                    // Checks if the appointment being checked against ends after the appointment being set starts.
                    // If true, the appointments collide and won't be set.
                    elseif($appointmentTimeEnding > $time)
                    {
                        // echo " and the appointment continues past when yours would've started. Try again!";
                        // echo "<br>$time is bigger than $appointmentTimeBeginning and $timeEnding is bigger than $appointmentTimeEnding<br>";
                        $boolThing = true;
                        break;
                    }
                }
                
                // Checks if the appointment being set will run into other appointments in the future
                if($appointmentTimeBeginning >= $time && $appointmentTimeBeginning <= $timeEnding)
                {
                    $boolThing = true;
                    break;
                }
            }
            
            
            // Some random time variable checks
            // echo "appointment begins at $time<br>";
            // echo "appointment ends at $timeEnding<br>";
            // echo "Opens at $openingHour<br>";
            // echo "Closes at $closingHour";
    
            // Checks that the appointment was being set during business operating hours...
            if($time >= $openingHour && $timeEnding <= $closingHour)
            {
                // Checks that the appointment does not collide with other appointments
                if($boolThing == false)
                {
                    // Sets the date and time variables into a datetime variable for insertion into the database.
                    $appointmentDateTime = $date . " " . $time;
                    
                    // Inserts the appointment into the database.
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
                    // echo "<br>PASSED!";
                    return "Appointment set!";
                }
                else
                {
                    // echo "<br>ALSO DIDN'T PASS";
                    return "ERROR: Appointment collision!";
                }
            }
            // ... if appointment doesn't occur during operating hours, fails
            else
            {
                // echo "<br>DIDN'T PASS";
                return "ERROR: Appointment collision!";
            }
            
            
            

        }
        
        
        // Function for deleting rows by appointment ID
        public function deleteByAptID($id)
        {
            $sql = "DELETE FROM appointments WHERE appointmentID = :aptID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':aptID', $id);
            $sql->execute();
        }
        
        
        // Function for deleting rows by service ID
        public function deleteByServiceID($sID)
        {
            $sql = "DELETE FROM appointments WHERE serviceID = :serviceID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':serviceID', $sID);
            $sql->execute();
            
        }
        
        // Function for deleting rows by practitoner ID
        public function deleteByPractitionerID($pracID)
        {
            $sql = "DELETE FROM appointments WHERE practitionerID = :pracID";
            $sql = $this->conn->prepare($sql);
            $sql->bindParam(':pracID', $pracID);
            $sql->execute();
        }

        
        
        
        
    }













?>