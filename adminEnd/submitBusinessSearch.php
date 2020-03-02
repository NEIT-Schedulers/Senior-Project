<!DOCTYPE>
<HTML>
    <link rel="stylesheet" type="text/css" href="style.css">
</HTML>
<BODY>
    <h1>Search Results</h1>
<?php

    // print_r($_POST);
    
    include_once('db.php');
    
    if(isset($_POST['businessName']))
    {
        $searchParam = $_POST['businessName'];
    }
    elseif(isset($_GET['searchParameters']))
    {
        $searchParam = $_GET['searchParameters'];
    }
    
    $sql = "SELECT * FROM owners WHERE businessName LIKE :businessName";
    $sql = $db->prepare($sql);
    $sql->bindParam(':businessName', $searchParam);
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($results as $re)
    {
        ?>
        
            <p><?php echo $re['businessName']; ?> <a class="businessSearchResultsLink" href="https://chrispeloso.com/SeniorProject4/index.php?businessID=<?php echo $re['ownerID']; ?>">visit</a></p>
        
        
        
        
        
        <?php
    }


?>
</BODY>

