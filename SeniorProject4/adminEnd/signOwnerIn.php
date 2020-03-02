<?php

    $email = $_POST['email'];
    $password = $_POST['password'];
    $pwordHash = hash('sha1', $password);

    include_once('Classes/Owners.php');
    include_once('db.php');
    
    $owner = new Owners($db);
    $ownerArray = $owner->loginOwner($email, $pwordHash);
    
    

    if(count($ownerArray) == 1)
    {
        $_SESSION['ownerID'] = $ownerArray[0]['ownerID'];
        $_SESSION['ownerArray'] = $ownerArray;
        $_SESSION['ownerLogin'] = true;
        
        ?>
            <meta http-equiv="Refresh" content="0; url=?action=ownerLanding" /> 
        <?php
    }
    else
    {
        $_SESSION['errorMSG'] = "There was an error signing in.";
        ?>
            <meta http-equiv="Refresh" content="0; url=adminEnd/login.php" />
        <?php
    }


?>