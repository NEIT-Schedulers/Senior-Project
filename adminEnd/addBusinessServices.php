<?php
    $pwordHash = hash('sha1',$_POST['passwordConfirm']);


    //checks if password is correct
    if($pwordHash == $_SESSION['ownerArray'][0]['password'])
    {
        $serviceName = $_POST['serviceName'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $time = $_POST['time'];
        $businessID = $_SESSION['ownerArray'][0]['ownerID'];

        
        include_once('db.php');
        include_once('Classes/Services.php');
        ?><p>test</p><?php
        
        $service = new Services($db);
                ?><p>test2</p><?php

        $service->submitNewService($serviceName, $description, $price, $time, $businessID);
        

        ?>
        <meta http-equiv="Refresh" content="0; url=index.php?action=businessSettings" />
        <?php
    }
    
    //if the password is wrong
    else
    {
        $_SESSION['errorMSGservices'] = "<b>ERROR: </b>Services not updated!";
        ?>
        <meta http-equiv="Refresh" content="0; url=index.php?action=businessSettings" />
        <?php
    }
    


?>