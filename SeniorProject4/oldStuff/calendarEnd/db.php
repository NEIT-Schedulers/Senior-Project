<?php

    $dsn = "mysql:host=chrispeloso.com;dbname=chrispf0_SeniorProject";
    $userName = "chrispf0_cpeloso";
    $pword = "W#+TGv)^CGL1";
    
    try{
        $db = new PDO($dsn, $userName, $pword);
    }
    catch(PDOException $e){
        die("Can't connect to the database" . "<br>" . $e);
    }



?>