<?php

    $serviceID = $_POST['serviceID'];
    $serviceName = $_POST['serviceEditorName'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $lengthOfTime = $_POST['lengthOfTime'];
    // $id = $_SESSION['ownerArray'][0]['ownerID'];
    
    include_once('db.php');
    include_once('Classes/Services.php');
    $service = new Services($db);
    
    $service->update($serviceID, $serviceName, $description, $price, $lengthOfTime);


?>

<meta http-equiv="Refresh" content="0; url=index.php" />
