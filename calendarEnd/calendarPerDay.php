<!--the back button-->
<br><br>
<a href="?businessID=<?php echo $businessID; ?>&setMonth=<?php echo $month; ?>&setYear=<?php echo $year; ?>" style="border:1px solid turquoise;background-color:turquoise;padding:5px;text-decoration:none;color:white;">Return to Calendar</a>
<br><br>

<?php 

    $dayOfCurrentMonth = date("l", strtotime($year . "-" . $month . "-" . $day));

    $dateThing = $year . "-" . $month . "-" . $day;
    
    
    // Pulls services for the business
    include_once('adminEnd/db.php');
    include_once('adminEnd/Classes/Services.php');
    $service = new Services($db);
    $results = $service->pullServices($businessID);
    // print_r($results);
    
    
    // Pulls practitioners for the business
    include_once('adminEnd/Classes/Practitioners.php');
    $practitioner = new Practitioners($db);
    $resultsPractitioners = $practitioner->pullPractitioners($businessID);
    
    // Pulls appointments thing
    include_once('adminEnd/db.php');
    include_once('adminEnd/Classes/Appointments.php');
    $appointment = new Appointments($db);
    
    $allAppointmentsToday = $appointment->readInnerJoinBusinessIDDate($_GET['businessID'], $dateThing);
    // print_r($allAppointmentsToday);
?>




<?php

    // If the pracititioner was provided...
    if(isset($_GET['practitionerName']))
    {
        ?>
        <h2><?php echo $month . "/" . $day . "/" . $year . " - " . $dayOfCurrentMonth;?></h2>
        <br>
        
        <!--Lists all the different service types-->
        <select id="servicesListing" onchange="serviceChange(this.value)">
        
          <?php
          
            foreach($results as $re)
            {
                ?>
                
                    <option value="<?php echo $re['serviceName']; ?>"><?php echo $re['serviceName']; ?></option>
                
                <?php
            }
          
          ?>
          
          
          
        </select>
        
        <br>
        
        <!--Practitioner selecter-->
        <select id="practitionersListing" onchange="practitionerChange(this.value)">
            
            <?php
          
            foreach($resultsPractitioners as $re)
            {
                ?>
                
                    <option value="<?php echo $re['practitionerFirstName'] . " " . $re['practitionerLastName']; ?>"><?php echo $re['practitionerFirstName'] . " " . $re['practitionerLastName']; ?></option>
                
                <?php
            }
          
          ?>
            
        </select>
        
        <br>
        
        <div id="appointmentSchedulerDiv">
            
            <p id='appointmentSchedulerP'>
            <?php
            foreach($allAppointmentsToday as $ap) {
                
                // print_r($ap);
                $timeThing = date("g:i a", strtotime($ap['time']));
                $dateAppointmentThing = date("m/d/Y", strtotime($ap['date']));
                
                echo "<b>" . $ap['clientFirstName'] . " " . $ap['clientLastName'] . "</b> has a <b>" . $ap['serviceName'] . "</b> appointment at <b>" . $timeThing . "</b> on <b>" . $dateAppointmentThing . "</b> with employee <b>" . $ap['practitionerFirstName'] . " " . $ap['practitionerLastName'] . "</b>.";
                echo "<br>";
            }
            ?>
            </p>
            <?php
            // foreach($appointment->readInnerJoinBusinessIDDate($_GET['businessID'], $dateThing) as $ap)
            // {
            //     print_r($ap);
            //     echo "<br>";
            //     echo "<br>";
            // }
            ?>
            
        </div>
        
        
        
        <?php
        
        
    }
    
    // If the practitioner wasn't provided...
    else
    {
        ?>
        <!--Practitioner selecter-->
        <select id="practitionersListing" onchange="practitionerChange(this.value)">
            
            <?php
          
            foreach($resultsPractitioners as $re)
            {
                ?>
                
                    <option value="<?php echo $re['practitionerFirstName'] . " " . $re['practitionerLastName']; ?>"><?php echo $re['practitionerFirstName'] . " " . $re['practitionerLastName']; ?></option>
                
                <?php
            }
          
          ?>
            
        </select>
        
        <br>
                <h4>no prac</h4>

        
        
        <?php
    }


?>




<h1 id="title">title</h1>








<?php

// print_r($_SESSION['ownerArray']);








?>

<script>
    function serviceChange(val)
    {
        alert(val);
    }
    
    function practitionerChange(val)
    {
        console.log("value: " + val);
        document.getElementById("appointmentSchedulerP").innerHTML = "";
        
        for(var e = 0; e < newAppointment.length;e++)
        {
            if(val === newAppointment[e]['practitionerFirstName'] + " " + newAppointment[e]['practitionerLastName'])
            {
                document.getElementById("appointmentSchedulerP").innerHTML += "<b>" + newAppointment[e]['clientFirstName'] + " " + newAppointment[e]['clientLastName'] + "</b>";
                document.getElementById("appointmentSchedulerP").innerHTML += " has a <b>" + newAppointment[e]['serviceName'] + "</b> appointment ";
                document.getElementById("appointmentSchedulerP").innerHTML += " at <b>" + newAppointment[e]['time'] + "</b> on <b>" + newAppointment[e]['date'] + "</b>";
                document.getElementById("appointmentSchedulerP").innerHTML += " with employee <b>" + newAppointment[e]['practitionerFirstName'] + " " + newAppointment[e]['practitionerLastName'] + "</b>";
                    
                    
                document.getElementById("appointmentSchedulerP").innerHTML += "<br>";
            }
        }
    }
    
    // var appointmentsArray = <?php echo '["' . implode('", "', $appointment->readInnerJoinBusinessIDDate($_GET['businessID'], $dateThing)) . '"]' ?>;
    var newAppointment = <?php echo json_encode($appointment->readInnerJoinBusinessIDDate($_GET['businessID'], $dateThing)); ?>
    
    for(var i = 0; i < newAppointment.length; i++)
    {
        console.log(newAppointment[i]['clientFirstName'] + " " + newAppointment[i]['clientLastName']);
    }

</script>








































