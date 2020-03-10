<?php

    $pracID = $_POST['practitionerID'];
    
    include_once('db.php');
    include_once('Classes/Practitioners.php');
    include_once('Classes/Appointments.php');
    
    $prac = new Practitioners($db);
    $apt = new Appointments($db);
    
    // echo "<br><br><br><br><br><br><br>";
    // echo "<h1>SERVICE ID: " . $pracID . "</h1>";
    
    $apt->deleteByPractitionerID($pracID);
    $prac->deleteByID($pracID);

?>

<meta http-equiv="Refresh" content="0; url=index.php" />
