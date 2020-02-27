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
    
    $appointmentDateTime = $aptDate . " " . $aptTime;

    // Checks that the variables are coming through    
    echo "Client first name: " . $clientFirstName . "<br>";
    echo "Client last name: " . $clientLastName . "<br>";
    echo "Client email: " . $clientEmail . "<br>";
    echo "Client phone number: " . $clientPhone . "<br>";
    echo "Client appointment date: " . $aptDate . "<br>";
    echo "Client appointment time: " . $aptTime . "<br>";
    echo "Business ID: " . $id . "<br>";
    echo "Service ID: " . $serviceID . "<br>";
    echo "PractitionerID: " . $practitionerID . "<br>";
    echo "appointmentDateTime: " . $appointmentDateTime . "<br>";
    
    // Include dependencies
    include_once('db.php');
    include_once('Classes/Appointments.php');
    
    // Create appointment object
    $appointment = new Appointments($db);
    
    // Perform appointment object appointment submission method
    $appointment->submitAppointment($clientFirstName, $clientLastName, $clientEmail, $clientPhone, $appointmentDateTime, $id, $serviceID, $practitionerID);
    

    
    
?> 
    
    
    <meta http-equiv="Refresh" content="0; url=index.php?businessID=<?php echo $id; ?>" />
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    