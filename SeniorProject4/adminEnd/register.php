<h1>register page</h1>

<?php

    $_SESSION['errorMSGRegister'] = "";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $pwordHash = hash('sha1', $password);

    $ownerFirstName = $_POST['ownerFirstName'];
    $ownerLastName = $_POST['ownerLastName'];
    $ownerPhone = $_POST['ownerPhone'];
    
    $opening = $_POST['openingHour'];
    $opening = date_create($opening);
    $opening = date_format($opening, "H:i:s");
    
    $closing = $_POST['closingHour'];
    $closing = date_create($closing);
    $closing = date_format($closing, "H:i:s");


    

    include_once('adminEnd/Classes/Owners.php');
    include_once('adminEnd/db.php');
    
    $owner = new Owners($db);
    
    
    // $ownerArray = $owner->createOwner( $ownerFirstName, $ownerLastName, $ownerEmail, $ownerPhone, $opening, $closing, $pwordHash);
    $ownerArray = $owner->createOwner($ownerFirstName, $ownerLastName, $email, $ownerPhone, $opening, $closing, $pwordHash);

    print_r($owner->read());

    ?>
    <!--<meta http-equiv="Refresh" content="0; url=indexAdmin.php?action=login" />-->
    <?php

?>