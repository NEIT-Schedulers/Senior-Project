<?php

    $id = $_SESSION['ownerArray'][0]['ownerID'];

    include_once('db.php');
    include_once('Classes/Owners.php');
    
    $owner = new Owners($db);
    
    $result = $owner->pullName($id);
    
    
    $firstName = $result['firstName'];
    $_SESSION['ownerArray'][0]['ownerFirstName'] = $result['ownerFirstName'];
    $_SESSION['ownerArray'][0]['ownerLastName'] = $result['ownerLastName'];

?>


<div class="pageContainer">
    
    <h1>Owner Landing Page</h1>
    <p>Welcome, <?php echo $_SESSION['ownerArray'][0]['ownerFirstName'] . " " . $_SESSION['ownerArray'][0]['ownerLastName'] . "."; ?></p>
    
</div>

