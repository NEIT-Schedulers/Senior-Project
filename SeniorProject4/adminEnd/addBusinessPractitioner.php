<?php
    $pwordHash = hash('sha1',$_POST['passwordConfirm']);


    //checks if password is correct
    if($pwordHash == $_SESSION['ownerArray'][0]['password'])
    {
        $firstName = $_POST['practitionerFirstName'];
        $lastName = $_POST['practitionerLastName'];
        $email = $_POST['practitionerEmail'];
        $phone = $_POST['practitionerPhone'];
        $businessID = $_SESSION['ownerArray'][0]['ownerID'];

        
        include_once('db.php');
        include_once('Classes/Practitioners.php');
        
        $practitioner = new Practitioners($db);

        $practitioner->submitNewPractitioner($firstName, $lastName, $email, $phone, $businessID);
        

        ?>
        <meta http-equiv="Refresh" content="0; url=index.php?action=businessSettings" />
        <?php
    }
    
    //if the password is wrong
    else
    {
        $_SESSION['errorMSGprac'] = "<b>ERROR: </b>Services not updated!";
        ?>
        <meta http-equiv="Refresh" content="0; url=index.php?action=businessSettings" />
        <?php
    }
    


?>