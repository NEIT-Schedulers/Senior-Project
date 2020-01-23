<?php

    $dsn = "mysql:host=localhost;dbname=scheduling";
    $userName = "root";
    $pword = "";
    
    $db = @mysqli_connect('localhost', 'root', '', 'scheduling')
    OR die('Could not connect to MySql ' . mysqli_connect_error());



?>