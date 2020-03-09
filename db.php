<?php

	$serverName = "localhost";
    $dbName = "scheduling1";
    $userName = "root";
    $pword = "";
    
    $db = new mysqli($serverName, $userName, $pword, $dbName);

    if ($db->connect_error)
    {
    	die("Connection failed: " . $db->connect_error);
    }

?>