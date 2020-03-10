<?php

    include_once('db.php');
    include_once('Classes/Appointments.php');
    $apt = new Appointments($db);

    $apt->deleteByAptId($_GET['aptID']);


?>

<meta http-equiv="Refresh" content="0; url=index.php?businessID=<?php echo $_SESSION['ownerArray'][0]['ownerID']; ?>" />
