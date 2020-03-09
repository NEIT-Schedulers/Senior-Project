<!DOCTYPE>
<HTML>
    <link rel="stylesheet" type="text/css" href="style.css">
</HTML>
<BODY>
    <h1>Search Results</h1>
<?php

    // print_r($_POST);
    
    include_once('db.php');
    
    $sql = "SELECT * FROM owners WHERE businessName LIKE :businessName";
    $sql = $db->prepare($sql);
    $sql->bindParam(':businessName', $_POST['businessName']);
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($results as $re)
    {
        ?>
        
            <p><?php echo $re['businessName']; ?> <a class="businessSearchResultsLink" href="../calendarEnd/index.php?businessID=<?php echo $re['ownerID']; ?>">visit</a></p>
        
        
        
        
        
        <?php
    }


?>
</BODY>

