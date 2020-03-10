<?php

    $serviceID = $_POST['serviceID'];
    
    include_once('db.php');
    include_once('Classes/Services.php');
    include_once('Classes/Appointments.php');
    
    $service = new Services($db);
    $apt = new Appointments($db);
    
    // echo "<br><br><br><br><br><br><br>";
    // echo "<h1>SERVICE ID: " . $serviceID . "</h1>";
    
    $apt->deleteByServiceID($serviceID);
    $service->deleteByID($serviceID);

?>

<meta http-equiv="Refresh" content="0; url=index.php" />
