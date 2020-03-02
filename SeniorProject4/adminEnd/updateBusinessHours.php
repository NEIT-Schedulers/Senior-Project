<?php
    $pwordHash = hash('sha1',$_POST['passwordConfirm']);


    //checks if password is correct
    if($pwordHash == $_SESSION['ownerArray'][0]['password'])
    {
        $open = $_POST['openingHour'];
        $close = $_POST['closingHour'];
        $id = $_SESSION['ownerArray'][0]['ownerID'];

        include_once('db.php');
        include_once('Classes/Owners.php');
        
        $owner = new Owners($db);

        $owner->updateHours($open, $close, $id);

        ?>
        <meta http-equiv="Refresh" content="0; url=index.php?action=businessSettings" />
        <?php
    }
    
    //if the password is wrong
    else
    {
        $_SESSION['errorMSGhours'] = "<b>ERROR: </b>Business settings not updated!";
        ?>
        <meta http-equiv="Refresh" content="0; url=index.php?action=businessSettings" />
        <?php
    }
    


?>