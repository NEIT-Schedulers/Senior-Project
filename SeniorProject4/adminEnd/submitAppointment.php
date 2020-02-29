<?php

    // Pull variables that were entered into the form
    $clientFirstName = $_POST['clientFirstName'];
    $clientLastName = $_POST['clientLastName'];
    $clientEmail = $_POST['clientEmail'];
    $clientPhone = $_POST['clientPhone'];
    $aptDate = $_POST['appointmentDate'];
    $aptTime = $_POST['appointmentTime'];
    $id = $_POST['businessID'];
    $serviceID = $_POST['serviceID'];
    $practitionerID = $_POST['practitionerID'];
    
    
    // Checks that the variables are coming through    
    // echo "Client first name: " . $clientFirstName . "<br>";
    // echo "Client last name: " . $clientLastName . "<br>";
    // echo "Client email: " . $clientEmail . "<br>";
    // echo "Client phone number: " . $clientPhone . "<br>";
    // echo "Client appointment date: " . $aptDate . "<br>";
    // echo "Client appointment time: " . $aptTime . "<br>";
    // echo "Business ID: " . $id . "<br>";
    // echo "Service ID: " . $serviceID . "<br>";
    // echo "PractitionerID: " . $practitionerID . "<br>";
    // echo $aptDate . " " . $aptTime . "<br>";
    // echo "<hr>";
    
    // Include dependencies
    include_once('db.php');
    include_once('Classes/Appointments.php');
    
    // Create appointment object
    $appointment = new Appointments($db);
    
    // Perform appointment object appointment submission method
    $returnStatement = $appointment->submitAppointment($clientFirstName, $clientLastName, $clientEmail, $clientPhone, $aptDate, $aptTime, $id, $serviceID, $practitionerID);
    
    $_POST['testerTHING'] = "TEST!@";
    
    $setYearThing = date('Y', strtotime($aptDate));
    // echo "<br>" . $setYearThing . "<br>";
    
    $setMonthThing = date('n', strtotime($aptDate));
    // echo "<br>" . $setMonthThing . "<br>";
    
    $setDayThing = date('d', strtotime($aptDate));
    // echo "<br>" . $setDayThing . "<br>";

    
    
?> 
    
    
    <meta http-equiv="Refresh" content="0; url=index.php?businessID=<?php echo $id; ?>&setMonth=<?php echo $setMonthThing; ?>&setDay=<?php echo $setDayThing; ?>&setYear=<?php echo $setYearThing; ?>&returnStatement=<?php echo $returnStatement; ?>" />
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    